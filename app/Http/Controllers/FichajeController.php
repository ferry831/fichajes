<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;
use App\Models\Fichaje;
use App\Models\Pausa;
use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FichajesExport;

class FichajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trabajador = Trabajador::where('user_id', auth()->id())->first(); // Obtiene el trabajador asociado al usuario autenticado
        $fichajes = $trabajador ? $trabajador->fichajes()->latest()->get() : collect(); // Si no hay trabajador, devuelve una colección vacía
        return view('trabajador.fichajes.index', compact('fichajes', 'trabajador'));

    }

    public function indexEmpresa()
    {
        $empresa = Empresa::where('user_id', auth()->id())->first(); // Obtiene la empresa asociada al usuario autenticado
        $empleadosSemana = $empresa->trabajadores()->with(['fichajes' => function($q) {
            $q->whereBetween('fecha', [now()->startOfWeek(), now()->endOfWeek()]);
        }])->get();

        $empleadosMes = $empresa->trabajadores()->with(['fichajes' => function($q) {
            $q->whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year);
        }])->get();


        return view('empresa.fichajes.index', compact('empleadosSemana', 'empleadosMes', 'empresa'));

    }

    public function entrada(Request $request)
    {
        $trabajador = Trabajador::where('user_id', auth()->id())->first();

        $existe_fichaje = Fichaje::where('trabajador_id', $trabajador->id)
            ->whereDate('hora_entrada', \Carbon\Carbon::parse($request->hora_entrada)->toDateString())
            ->first();


        if ($existe_fichaje) {
            return back()->with(['error' => 'Ya has fichado hoy.']);
        }

        $trabajador = Trabajador::where('user_id', auth()->id())->first();

        $fichaje = Fichaje::create([
            'trabajador_id' => $trabajador->id,
            'empresa_id' => $trabajador->empresa_id,
            'fecha' => now()->toDateString(),
            'hora_entrada' => now(),
        ]);
        return redirect()->route('trabajador.dashboard')->with('success', 'Entrada registrada correctamente.');

        if ($fichaje) {
            return redirect()->route('trabajador.dashboard')->with('success', 'Fichaje confirmado correctamente.');
        } else {
            return redirect()->route('trabajador.dashboard')->with('error', 'Error al guardar el fichaje.');
        }
    }


    public function salida(Request $request, $id)
    {
        $trabajador = Trabajador::where('user_id', auth()->id())->first();

        $fichaje = Fichaje::where('id', $id)->where('trabajador_id', $trabajador->id)->first();

        if ($fichaje && !$fichaje->hora_salida) {
            $fichaje->update([
                'hora_salida' => now(),
            ]);
            return redirect()->route('trabajador.dashboard')->with('success', 'Salida registrada correctamente.');
        } else {
            return redirect()->route('trabajador.dashboard')->with('error', 'No se encontró un registro de entrada para hoy.');
        }
    }


    public function pausa(Request $request, $id)
    {
        $trabajador = Trabajador::where('user_id', auth()->id())->first();
        $fichaje = Fichaje::where('id', $id)->where('trabajador_id', $trabajador->id)->first();
        if ($fichaje && $fichaje->hora_entrada) {
            $pausa = Pausa::create([
                'fichaje_id' => $fichaje->id,
                'inicio' => now(),
            ]);
            return redirect()->route('trabajador.dashboard')->with('success', 'Pausa registrada correctamente.');
        } else {
            return redirect()->route('trabajador.dashboard')->with('error', 'No se encontró un registro de entrada para hoy.');
        }

    }

    public function reanudar (Request $request, $id)
    {
        $trabajador = Trabajador::where('user_id', auth()->id())->first();
        $fichaje = Fichaje::where('id', $id)->where('trabajador_id', $trabajador->id)->first();
        $pausa = $fichaje ? $fichaje->pausas()->whereNull('fin')->latest('inicio')->first() : null;
        
        if ($fichaje && $pausa) {
            $pausa->update([
                'fin' => now(),
            ]);
            return redirect()->route('trabajador.dashboard')->with('success', 'Reanudación registrada correctamente.');
        } else {
            return redirect()->route('trabajador.dashboard')->with('error', 'No hay pausa pendiente de reanudar.');
        }

        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $trabajador = Trabajador::find($id);
        $empresa = Empresa::where('user_id', auth()->id())->first();

        if ($trabajador->empresa_id !== $empresa->id) {
            abort(403);
        }
        
        $query = $trabajador->fichajes()->orderBy('fecha', 'desc');

        if ($request->filled('fecha_inicio')) {
            $query->where('fecha', '>=', $request->input('fecha_inicio'));
        }
        if ($request->filled('fecha_fin')) {
            $query->where('fecha', '<=', $request->input('fecha_fin'));
        }
        
        $fichajes = $query->paginate(10);
        return view('empresa.fichajes.show', compact('fichajes', 'trabajador'));

    }


    public function exportPdf(Trabajador $trabajador, Request $request){
        $empresa = Empresa::where('user_id', auth()->id())->first();
        if (!$empresa || $trabajador->empresa_id !== $empresa->id) {
            abort(403);
        }

        $query = $trabajador->fichajes()->orderBy('fecha', 'desc');
        if ($request->filled('fecha_inicio')) {
            $query->where('fecha', '>=', $request->input('fecha_inicio'));
        }
        if ($request->filled('fecha_fin')) {
            $query->where('fecha', '<=', $request->input('fecha_fin'));
        }
        $fichajes = $query->get();

        $pdf = Pdf::loadView('empresa.fichajes.pdf', compact('trabajador', 'fichajes'));
        return $pdf->download('fichajes_'.$trabajador->nombre.'.pdf');
    }

    public function exportExcel(Trabajador $trabajador, Request $request)
    {
        $empresa = Empresa::where('user_id', auth()->id())->first();
        if (!$empresa || $trabajador->empresa_id !== $empresa->id) {
            abort(403);
        }
        return Excel::download(new FichajesExport($trabajador, $request), 'fichajes_'.$trabajador->nombre.'.xlsx');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
