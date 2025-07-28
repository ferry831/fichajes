<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fichaje;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fichaje>
 */
class FichajeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fecha = $this->faker->date();

        // Hora de entrada entre 6:00 y 10:00
        $horaEntrada = Carbon::createFromFormat('Y-m-d H:i', $fecha . ' ' . $this->faker->time('H:i', '10:00'))
            ->setTime(rand(6, 10), rand(0, 59));

        // Pausa inicio entre 2 y 4 horas después de la entrada
        $pausaInicio = (clone $horaEntrada)->addHours(rand(2, 4))->addMinutes(rand(0, 30));

        // Pausa fin entre 20 y 60 minutos después de la pausa inicio
        $pausaFin = (clone $pausaInicio)->addMinutes(rand(20, 60));
        
        // Salida entre 2 y 5 horas después de la pausa fin
        $horaSalida = (clone $pausaFin)->addHours(rand(2, 5))->addMinutes(rand(0, 30));

        return [
            'trabajador_id' => 35, // Seria el ID del trabajador Ferran
            'empresa_id' => 51, // Seria el ID de la empresa correspondiente
            'fecha' => $fecha,
            'hora_entrada' => $horaEntrada,
            'hora_salida' => $horaSalida,
            'pausa_inicio' => $pausaInicio,
            'pausa_fin' => $pausaFin,
        ];
    }
}
