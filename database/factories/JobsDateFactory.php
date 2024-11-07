<?php

namespace Database\Factories;

use App\Models\Jobs_dates;
use App\Models\Job; 
use Illuminate\Database\Eloquent\Factories\Factory;

class JobsDateFactory extends Factory
{
    protected $model = Jobs_dates::class;

    public function definition()
    {
        return [
            'job_id' => Job::factory(),
            'fecha' => $this->faker->date($format = 'Y-m-d', $max = 'now'), // Genera una fecha aleatoria hasta hoy
            'hora_entrada' => $this->faker->time($format = 'H:i', $max = 'now'), // Genera una hora de entrada aleatoria
            'hora_salida' => $this->faker->time($format = 'H:i', $max = 'now'), // Genera una hora de salida aleatoria
            'confirmacion_prevencionista' => $this->faker->boolean, // Genera un valor booleano aleatorio
            'confirmacion_empresa' => $this->faker->boolean, // Genera un valor booleano aleatorio
        ];
    }
}