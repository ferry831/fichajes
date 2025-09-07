<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;


class TrabajadorController extends Controller
{
    public function dashboard()
    {   
        

        $trabajador = Trabajador::where('user_id', auth()->id())->first();
        $fichaje = $trabajador ? $trabajador->fichajes()->latest()->first() : null; // Obtiene el último fichaje del trabajador
        $pausas = $fichaje ? $fichaje->pausas()->get() : collect(); // Obtiene las pausas del último fichaje
        
        return view('trabajador.dashboard', compact(
                'trabajador',
                'fichaje',
                'pausas',
               
            ));

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresa = auth()->user()->empresaAdministrada; // Obtiene la empresa del usuario autenticado
        $trabajadores = $empresa ? $empresa->trabajadores : collect(); // Si no hay empresa, devuelve una colección vacía
        return view('empresa.trabajadores.index', compact('trabajadores'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('empresa.trabajadores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'nif' => 'required|string|max:9|regex:/^[0-9]{8}[A-Za-z]$/',
            'trabajador_email' => 'required|email|max:255|unique:users,email',
            'pin' => 'required|string|min:4|max:4|confirmed',
            'horas' => 'required|integer|min:0|max:168',
        ]);

        try {
            
            DB::beginTransaction();
            // Crear el usuario con perfil "trabajador"
            $user = \App\Models\User::create([
                'name' => $request->nombre,
                'email' => $data['trabajador_email'],
                'password' => bcrypt($data['pin']),
                'perfil' => 'trabajador', // O el campo/rol que uses para distinguirlo
            ]);

            // Crear el trabajador
            $trabajador = Trabajador::create([
                'empresa_id' => auth()->user()->empresaAdministrada->id, // Asocia el trabajador a la empresa del usuario autenticado
                'nombre' => $data['nombre'],
                'email' => $data['trabajador_email'],
                'nif' => $data['nif'],
                'pin' => $data['pin'],
                'horas' => $data['horas'], // Puedes ajustar esto según tus necesidades
                'user_id' => $user->id,
            ]);

            DB::commit();
        }

            
        catch (\Throwable $e) {
            DB::rollBack();
            // Si es un error de clave única (NIF duplicado)
            if ($e->getCode() == 23000) {
                // Elimina el usuario creado para no dejarlo huérfano
                if (isset($user)) {
                    $user->delete();

                }
                throw ValidationException::withMessages([
                    'nif' => 'Ya existe o ha existido un trabajador con ese NIF en esta empresa.',
                ]);
            }
            throw $e; // Otros errores, lánzalos normalmente
        }

            return redirect()->route('empresa.trabajadores.index')->with('success', 'Trabajador creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trabajador = Trabajador::findOrFail($id);
        return view('empresa.trabajadores.show', compact('trabajador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('empresa.trabajadores.edit', [
            'trabajador' => Trabajador::findOrFail($id) // Obtiene el trabajador por ID
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $trabajador = Trabajador::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:trabajadores,email,' . $trabajador->id,
            'nif' => 'required|string|min:9|max:9|unique:trabajadores,nif,' . $trabajador->id,
            'pin' => 'nullable|string|min:4|max:4',
            'horas' => 'required|integer|min:0|max:168', // Horas semanales
        ]);
        $trabajador->update($validated);
        return redirect()->route('empresa.trabajadores.index')->with('success', 'Información actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        // Elimina el trabajador
        $trabajador = Trabajador::findOrFail($id);

        // Elimina el usuario asociado si existe
        if ($trabajador->user_id) {
            \App\Models\User::find($trabajador->user_id)?->delete();
        }

        $trabajador->delete();
        return redirect()->route('empresa.trabajadores.index')->with('success', 'Trabajador eliminado correctamente.');
    }
}
