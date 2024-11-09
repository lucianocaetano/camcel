<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorStoreRequest;
use App\Http\Requests\OperatorUpdateRequest;
use App\Http\Resources\OperatorResource;
use App\Models\Enterprise;
use App\Models\Operator;

class OperatorController extends Controller
{
    public function index(Enterprise $enterprise)
    {
        $operators = $enterprise->operators()->orderBy("created_at", "desc")->get();

        return response()->json([
            "operators" => OperatorResource::collection($operators)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Enterprise $enterprise, OperatorStoreRequest $request)
    {
        $data = $request->validated();

        $operator = $enterprise->operators()->create($data);

        return response()->json([
            "operator" => OperatorResource::make($operator)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enterprise $enterprise, Operator $operator)
    {
        if ($operator->enterprise_id !== $enterprise->id) {
            abort(404);
        }

        return response()->json([
            "operator" => OperatorResource::make($operator)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Enterprise $enterprise, OperatorUpdateRequest $request, Operator $operator)
    {
        $data = $request->validated();

        if ($operator->enterprise_id !== $enterprise->id) {
            abort(404);
        }

        $operator->update($data);

        return response()->json([
            "operator" => OperatorResource::make($operator)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enterprise $enterprise, Operator $operator)
    {
        if ($operator->enterprise_id !== $enterprise->id) {
            abort(404);
        }

        $operator->delete();

        return response()->json();
    }
}
