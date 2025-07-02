<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         \App\Models\Empresa::create([
        'nombre' => 'Nombre de la empresa',
        'cif' => 'CIF123456',
        'direccion' => 'Dirección ejemplo',
        'telefono' => '123456789',
        'logo' => null,
    ]);
    }
}
