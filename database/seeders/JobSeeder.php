<?php

namespace Database\Seeders;

use App\Models\Enterprise;
use App\Models\Job;
use Illuminate\Support\Arr;
use App\Models\JobDate; // Importar el modelo de JobDate
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

            // Crear el trabajo
            $job = Job::factory()->create([
                "enterprise_id" => $enterprise->id,
                "trabajo" => 'Trabajo de Ejemplo', // Define el trabajo
                "hora_entrada" => '09:00', // Ejemplo de hora de entrada
                "hora_salida" => '17:00', // Ejemplo de hora de salida
                "confirmacion_prevencionista" => Arr::random([null, true, false]), // Valor aleatorio
                "confirmacion_empresa" => Arr::random([null, true, false]), // Valor aleatorio
            ]);

            // Generar las fechas asociadas para el trabajo
            $dates = [];
$uniqueDates = []; // Array para almacenar fechas únicas
$numberOfDates = rand(3, 5); // Genera un número aleatorio entre 3 y 5

while (count($dates) < $numberOfDates) {
    // Calcular una fecha aleatoria dentro de un rango de días
    $randomDays = rand(0, 7); // Cambia el rango según tus necesidades
    $date = $startDate->copy()->addDays($randomDays); // Copia la fecha de inicio y añade días aleatorios

    // Formatear la fecha y verificar si ya existe
    $formattedDate = $date->format('Y-m-d');
    if (!in_array($formattedDate, $uniqueDates)) {
        $uniqueDates[] = $formattedDate; // Agregar la fecha única al array
        $dates[] = [
            'job_id' => $job->id,
            'fecha' => json_encode($formattedDate),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

            // Insertar las fechas en la tabla jobs_date
            JobDate::insert($dates);
        }
    }
}
