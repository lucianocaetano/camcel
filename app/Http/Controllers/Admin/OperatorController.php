<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorStoreRequest;
use App\Http\Requests\OperatorUpdateRequest;
use App\Http\Resources\OperatorResource;
use App\Models\Enterprise;
use App\Models\Operator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OperatorController extends Controller
{
    public function index(Enterprise $enterprise)
    {
        Gate::authorize('viewAny', Operator::class);
        Gate::authorize('view', $enterprise);

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
        Gate::authorize('create', Operator::class);
        Gate::authorize('view', $enterprise);

        $data = $request->validated();

        $operator = $enterprise->operators()->create($data);

        $user = Auth::user();

        $operator = null;

        if ($user->rol === "Admin") {
            $operator = Operator::create($data);
        }

        if ($user->rol === "Enterprise") {
            $operator = $user->operators()->create($data);
        }

        return response()->json([
            "operator" => OperatorResource::make($operator)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enterprise $enterprise, Operator $operator)
    {
        Gate::authorize('view', $operator);
        Gate::authorize('view', $enterprise);

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
        Gate::authorize('view', $operator);
        Gate::authorize('view', $enterprise);

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
        Gate::authorize('delete', $operator);
        Gate::authorize('view', $enterprise);

        if ($operator->enterprise_id !== $enterprise->id) {
            abort(404);
        }

        $operator->delete();

        return response()->json();
    }
}
