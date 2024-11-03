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
            'trabajo' => $this->faker->sentence,
            'hora_entrada' => '09:00',
            'hora_salida' => '17:00',
            'confirmacion_prevencionista' => false,
            'confirmacion_empresa' => true,
        ];
    }
}
