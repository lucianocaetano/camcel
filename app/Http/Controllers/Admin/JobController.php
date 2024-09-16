<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jobs = Job::all();

        return response()->json([
            "jobs" => JobResource::collection($jobs)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobStoreRequest $request)
    {
        $data = $request->validated();

        $job = Job::create($data);

        return response()->json(["job" => JobResource::make($job)], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobUpdateRequest $request, Job $job)
    {
        $data = $request->validated();

        $job->update($data);

        return response()->json(["job" => JobResource::make($job)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return response()->json();
    }
}
