<?php

namespace App\Http\Controllers\v1;

use App\Events\JobUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Http\Resources\JobResource;
use App\Events\JobUpdateEvent;
use App\Models\Job;
use App\Models\JobDate;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $jobs = Job::with('jobdates')->get(); // Cargar las fechas relacionadas

        // Transformar los jobdates para incluir hora_entrada y hora_salida
        $job_dates = $jobs->flatMap(function ($job) {
            return $job->jobdates->map(function ($jobDate) {
                return [
                    'job_id'=> $jobDate->job_id,
                    'fecha' => $jobDate->fecha,
                    'hora_entrada' => $jobDate->hora_entrada,
                    'hora_salida' => $jobDate->hora_salida,
                ];
            });
        });

        return response()->json([
            "jobs" => JobResource::collection($jobs),
            "job_dates" => $job_dates // Ahora incluye hora_entrada y hora_salida
        ]);
    }

    public function show($id)
    {
        // Busca el trabajo por ID y carga relaciones necesarias
        $trabajo = Job::with(['fechas', 'documentos'])->find($id);

        // Si no se encuentra el trabajo, devolver un error 404
        if (!$trabajo) {
            return response()->json(['error' => 'Trabajo no encontrado'], 404);
        }

        // Devuelve el trabajo como JSON
        return response()->json($trabajo);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(JobStoreRequest $request)
    {
        $data = $request->validated();

        // Crea el trabajo
        $job = Job::create($data);

        // Guarda las fechas
        foreach ($request->fechas as $fecha) {
            JobDate::create([
                'job_id' => $job->id,
                'fecha' => $fecha,
            ]);
        }

        return response()->json(["job" => JobResource::make($job)], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $job = Job::findOrFail($id);
    $job->confirmacion_prevencionista = $request->input('confirmacion_prevencionista');
    $job->save();

    // Despachar el evento
    event(new JobUpdated($job));

    return response()->json(['message' => 'Job updated successfully!']);
}
    public function updateJob(Request $request)
    {
        // Suponiendo que recibes los datos del trabajo y las fechas desde la solicitud
        $job = $request->input('job'); // Puedes usar un modelo de trabajo aquí
        $job_dates = $request->input('job_dates'); // Array de fechas

        // Disparar el evento
        broadcast(new JobUpdated($job, $job_dates));

        return response()->json(['status' => 'Job updated and event broadcasted!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        // Elimina las fechas asociadas
        JobDate::where('job_id', $job->id)->delete();

        $job->delete();

        return response()->json();
    }
    public function updateConfirmation(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'confirmacion_prevencionista' => 'required|boolean',
        ]);

        // Buscar el trabajo por ID
        $job = Job::find($id);

        // Verificar si el trabajo existe
        if (!$job) {
            return response()->json(['message' => 'Trabajo no encontrado'], 404);
        }

        // Actualizar la confirmación del prevencionista
        $job->confirmacion_prevencionista = $request->input('confirmacion_prevencionista');
        $job->save();
        event(new JobUpdateEvent($job));
        // Devolver una respuesta
        return response()->json(['message' => 'Confirmación actualizada correctamente', 'job' => $job]);
    }
    public function updateConfirmationJob(Request $request, $id)
    {
        // Encuentra el trabajo por ID
        $job = Job::find($id);
    
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }
    
        // Actualiza los campos del trabajo según la solicitud
        $job->nombre = $request->input('nombre');
        $job->trabajo = $request->input('trabajo');
        // Actualiza otros campos según sea necesario
    
        // Guarda el trabajo actualizado
        $job->save();
    
        // Ahora que tienes el trabajo actualizado, puedes asignarlo a $updatedJob
        $updatedJob = $job; // Asigna el trabajo actualizado a la variable
    
        // Dispara el evento JobUpdated
        event(new JobUpdated($updatedJob));
    
        return response()->json(['message' => 'Job updated successfully', 'job' => $updatedJob]);
    }
}
