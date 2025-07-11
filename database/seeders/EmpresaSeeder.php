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
        $user = \App\Models\User::factory()->create();
        \App\Models\Empresa::create([
            'razon_social' => 'Nombre de la empresa',
            'cif' => 'CIF123456',
            'direccion' => 'Dirección ejemplo',
            'ccc' => '12345678901', // o el campo correcto
            'activa' => true,
            'user_id' => $user->id,
        ]);
    }
}
