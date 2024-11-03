<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Models\JobDate;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::with('jobdates')->get(); // Cargar las fechas relacionadas

        return response()->json([
            "jobs" => JobResource::collection($jobs),
            "job_dates" => $jobs->pluck('jobdates')
        ]);
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
    public function update(JobUpdateRequest $request, Job $job)
    {
        $data = $request->validated();

        // Actualiza el trabajo
        $job->update($data);

        // Elimina las fechas existentes (opcional)
        // JobDate::where('job_id', $job->id)->delete();

        // Guarda las nuevas fechas
        foreach ($request->fechas as $fecha) {
            JobDate::updateOrCreate(
                ['job_id' => $job->id, 'fecha' => $fecha],
                ['fecha' => $fecha]
            );
        }

        return response()->json(["job" => JobResource::make($job)]);
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
    public function updateConfirmation(request $request, $id)
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

        // Devolver una respuesta
        return response()->json(['message' => 'Confirmación actualizada correctamente', 'job' => $job]);
    }

}
