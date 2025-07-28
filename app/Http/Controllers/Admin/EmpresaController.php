<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $razon_social = $request->input('razon_social');
        $cif = $request->input('cif');
        $empresas = \App\Models\Empresa::when($razon_social, function($query, $razon_social) {
            return $query->where('razon_social', 'like', "%{$razon_social}%");
        })->when($cif, function($query, $cif) {
            return $query->where('cif', 'like', "%{$cif}%");
        })->paginate(15);

        return view ('admin.empresas.index', compact('empresas', 'razon_social', 'cif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'razon_social' => 'required|string|max:255',
            'cif' => 'required|string|max:9|unique:empresas,cif',
            'ccc' => 'nullable|string|max:11|unique:empresas,ccc',
            'direccion' => 'nullable|string|max:255',
            // Validación para el email y password del administrador de la empresa
            'empresa_email' => 'required|email|max:255|unique:users,email',
            'empresa_password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el usuario con perfil "empresa"
        $user = \App\Models\User::create([
            'name' => $request->razon_social,
            'email' => $data['empresa_email'],
            'password' => bcrypt($data['empresa_password']),
            'perfil' => 'empresa', // O el campo/rol que uses para distinguirlo
        ]);


            // Crear la empresa
        $empresa = \App\Models\Empresa::create([
            'razon_social' => $data['razon_social'],
            'cif' => $data['cif'],
            'ccc' => $data['ccc'] ?? null,
            'direccion' => $data['direccion'] ?? null,
            'activa' => true, // Por defecto, la empresa está activa
            'user_id' => $user->id, // Asociar el usuario creado a la empresa
        ]);

        
      
        return redirect()->route('admin.empresas.show', $empresa)
            ->with('status', 'Empresa creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.empresas.show', [
            'empresa' => \App\Models\Empresa::findOrFail($id)
        ]);
    }

    public function cambiarEstado(\App\Models\Empresa $empresa)
    {
        $empresa->activa = !$empresa->activa;
        $empresa->save();

        return redirect()->route('admin.empresas.show', $empresa)
            ->with('status', 'El estado de la empresa ha sido actualizado.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.empresas.edit', [
            'empresa' => \App\Models\Empresa::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $empresa = \App\Models\Empresa::findOrFail($id);
        $data = $request->validate([
            'razon_social' => 'required|string|max:255',
            'cif' => 'required|string|max:9',
            'ccc' => 'nullable|string|max:11',
            'direccion' => 'nullable|string|max:255',
            
        ]);

        $empresa->update($data);

        return redirect()->route('admin.empresas.show', $empresa)
            ->with('status', 'Empresa actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
