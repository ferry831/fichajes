<?php

namespace Tests\Feature;

use App\Models\Empresa;
use App\Models\Fichaje;
use App\Models\Pausa;
use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class FichajesTest extends TestCase
{
    use RefreshDatabase;
    public function test_realizar_entrada_fichaje(): void
    {
         //Crear empresa
        $empresa = Empresa::factory()->create();

        //Crear trabajador
        $trabajador = Trabajador::factory()->create(['empresa_id'=>$empresa->id]);

        $this->actingAs($trabajador->user);

        $response = $this->post('/fichajes/entrada');
        $response->assertRedirect('/trabajador');

    }
    public function test_realizar_pausa_fichaje(): void
    {
        $empresa = Empresa::factory()->create();
        $trabajador = Trabajador::factory()->create(['empresa_id' => $empresa->id]);
        $fichaje = Fichaje::factory()->create([
            'trabajador_id' => $trabajador->id,
            'empresa_id' => $empresa->id,
            'fecha' => now()->toDateString(),
            'hora_entrada' => now(),
            'hora_salida' => null, // Fichaje abierto
        ]);

        $this->actingAs($trabajador->user);
        $response = $this->post('/fichajes/pausa/' . $fichaje->id);
        $response->assertRedirect('/trabajador'); // O la ruta que corresponda
        $this->assertDatabaseHas('pausas', [
            'fichaje_id' => $fichaje->id,
            'fin' => null,
        ]);

    }

    public function test_realizar_reanudación_fichaje()
    {
        $empresa = Empresa::factory()->create();
        $trabajador = Trabajador::factory()->create(['empresa_id' => $empresa->id]);
        $fichaje = Fichaje::factory()->create([
            'trabajador_id' => $trabajador->id,
            'empresa_id' => $empresa->id,
            'fecha' => now()->toDateString(),
            'hora_entrada' => now(),
            'hora_salida' => null, // Fichaje abierto
        ]);

        $this->actingAs($trabajador->user);
        $response = $this->post('/fichajes/pausa/' . $fichaje->id);
        $response->assertRedirect('/trabajador'); // O la ruta que corresponda
        $this->assertDatabaseHas('pausas', [
            'fichaje_id' => $fichaje->id,
            'fin' => null,
        ]);

        $response = $this->post('/fichajes/reanudar/' . $fichaje->id);
        $response->assertRedirect('/trabajador');
        $this->assertDatabaseMissing('pausas', [
            'fichaje_id' => $fichaje->id,
            'fin' => null,
        ]);
    }

    public function test_realizar_salida_fichaje(): void
    {
        $empresa = Empresa::factory()->create();
        $trabajador = Trabajador::factory()->create(['empresa_id' => $empresa->id]);
        $fichaje = Fichaje::factory()->create([
            'trabajador_id' => $trabajador->id,
            'empresa_id' => $empresa->id,
            'fecha' => now()->toDateString(),
            'hora_entrada' => now()->subHours(2),
            'hora_salida' => null, // Fichaje abierto
        ]);

        $this->actingAs($trabajador->user);
        $response = $this->post('/fichajes/salida/' . $fichaje->id);
        $response->assertRedirect('/trabajador');

        $this->assertDatabaseMissing('fichajes', [
            'id' => $fichaje->id,
            'hora_salida' => null,
        ]);
        $this->assertDatabaseHas('fichajes', [
            'id' => $fichaje->id,
        ]);
    }

}
