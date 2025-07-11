<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'razon_social' => $this->faker->company,
            'cif' => strtoupper($this->faker->bothify('?#######')),
            'direccion' => $this->faker->streetAddress,
            'ccc' => $this->faker->numerify('###########'),
            'activa' => false, // 80% chance of being true
            'user_id' => \App\Models\User::factory(), 
        ];

        
    }
}
