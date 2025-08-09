<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;
use App\Models\Incidencia;
use App\Models\Fichaje;
use App\Models\Empresa;

class IncidenciaController extends Controller
{
    public function create()
    {
        return view('trabajador.incidencias.create');
    }

    public function store(Request $request)
    {
        
        $trabajador = Trabajador::where('user_id', auth()->id())->first();
        $empresa_id = $trabajador->empresa_id;

        $tipo = $request->input('tipo_principal');
        $incidencia = new Incidencia();


        switch ($tipo) {
        
            case('fichaje'):
                $subtipo = $request->input('subtipo_fichaje');
                if ($subtipo === 'fichaje_olvidado') {
                    $request->validate([
                        'fecha_inicio' => 'required|date',
                        'fecha_fin' => 'required|date|after:fecha_inicio',
                    ]);

                    
                    $incidencia = new Incidencia();
                    $incidencia->trabajador_id = $trabajador->id;
                    $incidencia->empresa_id = $empresa_id;
                    $incidencia->tipo = $tipo;
                    $incidencia->subtipo = $subtipo;
                    $incidencia->fecha_inicio = $request->input('fecha_inicio');
                    $incidencia->fecha_fin = $request->input('fecha_fin');
                    $incidencia->observacion = $request->input('observaciones') ?? null;
                    $incidencia->estado = 'pendiente';
                    $incidencia->save();
                } 
                elseif ($subtipo === 'correccion_fichaje') {
                    $request->validate([
                        'fecha_inicio' => 'required|date',
                        'fecha_fin' => 'required|date|after:fecha_inicio',
                    ]);

                    // Buscar fichaje en el día de fecha_inicio
                    $fichaje = Fichaje::where('trabajador_id', $trabajador->id)
                        ->whereDate('hora_entrada', \Carbon\Carbon::parse($request->fecha_inicio)->toDateString())
                        ->first();

                    if (!$fichaje) {
                        return back()->withErrors(['fecha_inicio' => 'No existe un fichaje en esa fecha.']);
                    }

                    $incidencia = new Incidencia();
                    $incidencia->trabajador_id = $trabajador->id;
                    $incidencia->empresa_id = $empresa_id;
                    $incidencia->tipo = $tipo;
                    $incidencia->subtipo = $subtipo;
                    $incidencia->fichaje_id = $fichaje->id;
                    $incidencia->fecha_inicio = $request->input('fecha_inicio');
                    $incidencia->fecha_fin = $request->input('fecha_fin');
                    $incidencia->observacion = $request->input('observaciones') ?? null;
                    $incidencia->estado = 'pendiente';
                    $incidencia->save();
                } 
                else {
                    return back()->withErrors(['subtipo_fichaje' => 'Subtipo de fichaje no válido.']);
                }
            break;

            case ('ausencia'):
                $request->validate([
                    'fecha_inicio' => 'required|date',
                    'fecha_fin' => 'required|date|after:fecha_inicio',
                ]);

                $incidencia = new Incidencia();
                $incidencia->trabajador_id = $trabajador->id;
                $incidencia->empresa_id = $empresa_id;
                $incidencia->tipo = $tipo;
                $incidencia->subtipo = $request->input('subtipo_ausencia');
                $incidencia->fecha_inicio = $request->input('fecha_inicio');
                $incidencia->fecha_fin = $request->input('fecha_fin');
                $incidencia->observacion = $request->input('observaciones') ?? null;
                $incidencia->estado = 'pendiente';
                $incidencia->save();
            break;

            case ('vacaciones'): 
                $request->validate([
                    'fecha_inicio' => 'required|date',
                    'fecha_fin' => 'required|date|after:fecha_inicio',
                ]);

                $incidencia = new Incidencia();
                $incidencia->trabajador_id = $trabajador->id;
                $incidencia->empresa_id = $empresa_id;
                $incidencia->tipo = $tipo;
                $incidencia->subtipo = $request->input('subtipo_vacaciones');
                $incidencia->fecha_inicio = $request->input('fecha_inicio');
                $incidencia->fecha_fin = $request->input('fecha_fin');
                $incidencia->observacion = $request->input('observaciones') ?? null;
                $incidencia->estado = 'pendiente';
                $incidencia->save();
            break;



        }
        if ($incidencia){
            return redirect()->route('trabajador.incidencias.create')->with('success', 'Incidencia registrada correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al registrar la incidencia.']);
        }
        
    }


    public function index(){
    // 1. Carga la empresa del usuario
        $user = auth()->user();
        if ($user->perfil !== 'empresa') {
            abort(403, 'No tienes permisos para ver esta página.');
        }

            // 2. Busca la empresa asociada al usuario
        $empresa = Empresa::where('user_id', $user->id)->first();
        

        // 3. Carga los trabajadores de la empresa
        $trabajadores = $empresa ? $empresa->trabajadores()->get() : collect();
        

        // 4. Junta todas las incidencias pendientes
        $incidencias = $trabajadores->flatMap(function ($trabajador) {
            return $trabajador->incidencias()->where('estado', 'pendiente')->get();
        });
        
        $incidencias = $incidencias->sortBy('fecha_inicio')->values();
        // 5. Muestra la vista
        return view('empresa.incidencias.index', compact('trabajadores', 'incidencias'));
    }

    public function update(Request $request, Incidencia $incidencia)
    {
        $request->validate([
            'accion' => 'required|in:aprobar,rechazar',
        ]);

        // Cambia el estado según el botón pulsado
        if ($request->accion === 'aprobar') {
            if ($incidencia->tipo === 'fichaje'){
                
                if ($incidencia->subtipo === 'fichaje_olvidado') {
                    $fichaje = new Fichaje();
                    $fichaje->empresa_id = $incidencia->empresa_id;
                    $fichaje->trabajador_id = $incidencia->trabajador_id;
                    $fichaje->hora_entrada = $incidencia->fecha_inicio;
                    $fichaje->hora_salida = $incidencia->fecha_fin;
                    $fichaje->fecha = \Carbon\Carbon::parse($incidencia->fecha_inicio)->toDateString(); // <-- Añade esta línea
                    $fichaje->save();
                } elseif ($incidencia->subtipo === 'correccion_fichaje') {
                    $fichaje = Fichaje::find($incidencia->fichaje_id);
                    $fichaje->hora_entrada = $incidencia->fecha_inicio;
                    $fichaje->hora_salida = $incidencia->fecha_fin;
                    $fichaje->fecha = \Carbon\Carbon::parse($incidencia->fecha_inicio)->toDateString(); // <-- Añade esta línea
                    $fichaje->save();
                }
            }
            $incidencia->estado = 'aprobada';
        } elseif ($request->accion === 'rechazar') {
            $incidencia->estado = 'rechazada';
        }

        $incidencia->save();

        return redirect()->route('empresa.incidencias.index')->with('success', 'Incidencia actualizada correctamente.');
    }
}