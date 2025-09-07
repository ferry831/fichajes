<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Empresa;
use App\Models\User;
use App\Models\Trabajador;

class ValidacionFormulariosTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_trabajador_falla_si_falta_nombre()
    {
        $empresa = Empresa::factory()->create();
        $user = User::factory()->create(['perfil' => 'empresa']);
        $this->actingAs($user);

        $response = $this->post('/empresa/trabajadores', [
            // 'nombre' => 'Juan', // Falta el nombre
            'email' => 'juan@example.com',
            'empresa_id' => $empresa->id,
        ]);

        $response->assertSessionHasErrors('nombre');
    }

    public function test_crear_trabajador_falla_si_email_no_es_valido()
    {
        $empresa = Empresa::factory()->create();
        $user = User::factory()->create(['perfil' => 'empresa']);
        $this->actingAs($user);

        $response = $this->post('/empresa/trabajadores', [
            'nombre' => 'Juan',
            'email' => 'no-es-email',
            'empresa_id' => $empresa->id,
            'nif' => '12345678A',
            'pin' => '1234',
            'pin_confirmation' =>'1234',
            'horas' => 40,
        ]);

        $response->assertSessionHasErrors('trabajador_email');
    }

    public function test_crear_trabajador_falla_si_email_ya_existe()
    {
        $empresa = Empresa::factory()->create();
        $user = User::factory()->create(['perfil' => 'empresa']);
        $this->actingAs($user);

        // Crear trabajador con email
        $this->post('/empresa/trabajadores', [
            'nombre' => 'Juan',
            'email' => 'juan@example.com',
            'empresa_id' => $empresa->id,
            'nif' => '12345678A',
            'pin' => '1234',
            'pin_confirmation' =>'1234',
            'horas' => 40,
        ]);

        // Intentar crear otro con el mismo email
        $response = $this->post('/empresa/trabajadores', [
            'nombre' => 'Manuel',
            'email' => 'juan@example.com',
            'empresa_id' => $empresa->id,
            'nif' => '87654321M',
            'pin' => '1234',
            'pin_confirmation' =>'1234',
            'horas' => 40,
        ]);

        

        $response->assertSessionHasErrors('trabajador_email');
    }

    public function test_crear_incidencia_falla_si_no_hay_fecha()
    {
        $empresa = Empresa::factory()->create();
        $trabajador = Trabajador::factory()->create(['empresa_id'=>$empresa->id]);
        $this->actingAs($trabajador->user);

        $response = $this->post('/trabajador/incidencias', [
            // 'fecha_inicio' => '2025-09-05', // Falta este campo requerido
            'fecha_fin' => '2025-09-06',
            'tipo_principal' => 'ausencia',
            'subtipo_ausencia' => 'enfermedad',
        ]);

        $response->assertSessionHasErrors('fecha_inicio');
    }
    public function test_exportacion_fichajes_solo_autorizados()
    {
        // Crear un trabajador y autenticarse como él
        $empresa = Empresa::factory()->create();
        $trabajador = Trabajador::factory()->create(['empresa_id' => $empresa->id]);
        $this->actingAs($trabajador->user);

        // Intentar exportar fichajes (ruta de ejemplo, ajusta el ID y la ruta según tu app)
        $response = $this->get('/empresa/fichajes/' . $trabajador->id . '/export/pdf');

        // Debe estar prohibido para trabajadores
        $response->assertForbidden(); // O assertStatus(403)
    }

}
