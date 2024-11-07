<?php

namespace Database\Seeders;

use App\Models\Enterprise;
use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $enterprises = Enterprise::all();

        foreach ($enterprises as $enterprise) {
            // Crear el trabajo usando el factory
            $job = Job::factory()->create([
                'enterprise_id' => $enterprise->id,
            ]);

            // Crear entre 3 y 5 fechas para cada trabajo
            $numberOfDates = rand(3, 5);
            \App\Models\JobDate::factory()->count($numberOfDates)->create([
                'job_id' => $job->id,
            ]);
        }
    }
}