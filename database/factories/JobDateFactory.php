<?php

namespace Database\Factories;

use App\Models\JobDate;
use App\Models\Job; 
use Illuminate\Database\Eloquent\Factories\Factory;

class JobDateFactory extends Factory
{
    protected $model = JobDate::class;

    public function definition()
    {
         // Genera una fecha aleatoria
         $date = $this->faker->dateTime;

         // Formatea la fecha según tus necesidades
         $formattedDate = $date->format('Y-m-d'); // Cambia el formato según lo que necesites
        return [
            'job_id' => Job::factory(),
           'fecha' => $this->faker->date($format = 'Y-m-d'),
            'hora_entrada' => $this->faker->time($format = 'H:i', $max = 'now'),
            'hora_salida' => $this->faker->time($format = 'H:i', $max = 'now'),
           
        ];
    }
}