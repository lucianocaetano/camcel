<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        return [
        'trabajo' => $this->faker->jobTitle, // Genera un título de trabajo aleatorio
        'confirmacion_prevencionista' => $this->faker->randomElement([true, false, null]), // Genera un valor booleano aleatorio o null
'confirmacion_empresa' => $this->faker->randomElement([true, false, null]), // Genera un valor booleano aleatorio o null
        ];
    }
}
