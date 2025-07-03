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
            'nombre' => $this->faker->company,
            'cif' => strtoupper($this->faker->bothify('??########')),
            'direccion' => $this->faker->streetAddress,
            'telefono' => $this->faker->numerify($this->faker->randomElement(['6########', '7########', '9########'])),
            'logo' => null,
        ];
    }
}
