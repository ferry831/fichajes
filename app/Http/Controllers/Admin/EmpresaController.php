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
        $nombre = $request->input('nombre');
        $cif = $request->input('cif');
        $empresas = \App\Models\Empresa::when($nombre, function($query, $nombre) {
            return $query->where('nombre', 'like', "%{$nombre}%");
        })->when($cif, function($query, $cif) {
            return $query->where('cif', 'like', "%{$cif}%");
        })
        ->paginate(15);

     
        

        return view('admin.empresas.index', compact('empresas', 'nombre', 'cif'));
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
