<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trabajador>
 */
class TrabajadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::factory()->create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('1234'),
            'perfil' => 'trabajador',
        ]);

        return [
            'empresa_id' => 1, // O el id que corresponda
            'user_id' => $user->id,
            'nombre' => $user->name,
            'email' => $user->email,
            'nif' => strtoupper($this->faker->bothify('########?')),
            'pin' => '1234',
            'horas' => 40,
        ];
    }
}
