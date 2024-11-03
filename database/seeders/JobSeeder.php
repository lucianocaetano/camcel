<?php

namespace Database\Seeders;

use App\Models\Enterprise;
use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enterprises = Enterprise::all();

        foreach ($enterprises as $enterprise) {
            // Definir un rango de fechas para cada trabajo (puedes ajustar esto según tus necesidades)
            $startDate = now();
            $endDate = now()->addDays(7); // Por ejemplo, una semana de trabajos

            // Generar fechas dentro del rango
            $dates = [];
            for ($date = $startDate; $date->lessThanOrEqualTo($endDate); $date->addDay()) {
                $dates[] = $date->format('Y-m-d');
            }

            // Crear el trabajo con las fechas
            Job::factory()->create([
                "empresa_id" => $enterprise->id,
                "trabajo" => 'Trabajo de Ejemplo', // Define el trabajo
                "hora_entrada" => '09:00', // Ejemplo de hora de entrada
                "hora_salida" => '17:00', // Ejemplo de hora de salida
                "confirmacion_prevencionista" => false, // Ajusta según sea necesario
                "confirmacion_empresa" => true, // Ajusta según sea necesario
            ]);
        }
    }
}
