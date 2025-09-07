<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Trabajador;


class TrabajadorAccessTest extends TestCase
{
    use RefreshDatabase;


    public function test_trabajador_no_puede_ver_info_empresa(): void
    {
        //Crear empresa
        $empresa = Empresa::factory()->create();

        //Crear trabajador
        $trabajador = Trabajador::factory()->create(['empresa_id'=>$empresa->id]);

        
        
        $this->actingAs($trabajador->user);

        $response = $this->get('/empresa/info');
        $response->assertForbidden(); // O assertStatus(403)
    }

}
