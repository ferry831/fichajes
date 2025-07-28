<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource (empresa del usuario autenticado).
     */
    public function show()
    {
        $empresa = auth()->user()->empresaAdministrada;//devuelve la empresa del usuario autenticado
        return view('empresa.info.show', [
            'empresa' => $empresa
        ]);
    }


    /**
     * Show the form for editing the empresa del usuario autenticado.
     */
    public function edit()
    {
        $empresa = auth()->user()->empresaAdministrada;
        //$tiempo_actual = time() + 3600*2;
        return view('empresa.info.edit', [
            'empresa' => $empresa,
        // 'tiempo_actual' => $tiempo_actual
        ]);
    }


    /**
     * Update the empresa del usuario autenticado.
     */
    public function update(Request $request)
    {
        $empresa = auth()->user()->empresaAdministrada; 
        $validated = $request->validate([
            'razon_social' => 'required|string|max:255',
            'cif' => 'required|string|min:9|max:9',
            'ccc' => 'required|string|min:11|max:11',
            'direccion' => 'nullable|string|max:255',
        ]);
        $empresa->update($validated);
        return redirect()->route('empresa.info.show')->with('success', 'Información actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
