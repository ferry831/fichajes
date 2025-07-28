<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;
use App\Models\Fichaje;
use App\Models\Pausa;

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

    public function entrada(Request $request)
    {
        $trabajador = Trabajador::where('user_id', auth()->id())->first();

        $fichaje = Fichaje::create([
            'trabajador_id' => $trabajador->id,
            'empresa_id' => $trabajador->empresa_id,
            'fecha' => now()->toDateString(),
            'hora_entrada' => now(),
        ]);
        return redirect()->route('trabajador.dashboard')->with('success', 'Entrada registrada correctamente.');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
