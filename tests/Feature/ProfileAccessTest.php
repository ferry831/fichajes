<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Empresa;
use App\Models\Trabajador;
use App\Models\User;


class ProfileAccessTest extends TestCase
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
    public function test_empresa_no_puede_acceder_a_vistas_del_admin(): void
    {
        //Crear empresa
        $user = User::factory()->create(['perfil'=>'empresa']);
        $empresa = Empresa::factory()->create(['user_id'=>$user->id]);

       
        $this->actingAs($empresa->administrador);

        $response = $this->get('/admin/empresas/1');
        $response->assertForbidden(); // O assertStatus(403)
    }    

    public function test_admin_no_puede_acceder_a_vistas_de_otros_perfiles(): void
    {
        //Crear empresa
        $admin = User::factory()->create(['perfil'=>'admin']);

        $this->actingAs(($admin));
        //Crear trabajador
        

        
        
        $this->actingAs($admin);

        $response1 = $this->get('/trabajador');
        $response1->assertForbidden(); // O assertStatus(403)

        $response2 = $this->get('/empresa/info');
        $response2 ->assertForbidden();
        
    }    


}
