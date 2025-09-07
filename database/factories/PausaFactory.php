<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pausa>
 */
class PausaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
   
        $fecha = $this->faker->date();

        // Inicio de la pausa entre 10:00 y 12:00
        $inicio = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $fecha . ' ' . $this->faker->time('H:i', '12:00'))
            ->setTime(rand(10, 12), rand(0, 59));

        // Fin de la pausa entre 10 y 30 minutos después del inicio
        $fin = (clone $inicio)->addMinutes(rand(10, 30));

        return [
            'fichaje_id' => $this->faker->numberBetween(1, 100), // Ajusta según tus fichajes existentes
            'inicio' => $inicio->format('Y-m-d H:i:s'),
            'fin' => $fin->format('Y-m-d H:i:s'),
        ];
        


    }
}
