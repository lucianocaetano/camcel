<?php

namespace App\Http\Controllers\v1;

use App\Models\Enterprise;
use App\Http\Requests\EnterpriseStoreRequest;
use App\Http\Requests\EnterpriseUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\EnterpriseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Enterprise::class);

        $query = Enterprise::query();

        $filter = $request->input('filter', 'all');
   
        if ($filter === 'true') {
            $query->where('is_valid', 1);
        } else if ($filter === 'false'){
            $query->where('is_valid', 0);
        }

        $enterprises = $query->orderBy('created_at', 'desc')->get();

        return response()->json(EnterpriseResource::collection($enterprises));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnterpriseStoreRequest $request)
    {
        Gate::authorize('create', Enterprise::class);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = "storage/" . $request->file('image')->store('enterprises', 'public');
        }

        $user = Auth::user();
        $enterprise = null;

        if ($user->rol === "Admin") {
            $enterprise = Enterprise::create($data);
        }

        if ($user->rol === "Enterprise") {
            $enterprise = $user->enterprises()->create($data);
        }

        return response(["enterprise" => EnterpriseResource::make($enterprise)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enterprise $enterprise)
    {
        Gate::authorize('view', $enterprise);

        return response()->json(
            ["enterprise" => EnterpriseResource::make($enterprise)]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnterpriseUpdateRequest $request, Enterprise $enterprise)
    {
        Gate::authorize('update', $enterprise);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = "storage/" . $request->file('image')->store('enterprises', 'public');
        }

        $enterprise->update($data);

        return response(["enterprise" => EnterpriseResource::make($enterprise)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enterprise $enterprise)
    {
        Gate::authorize('delete', $enterprise);

        $enterprise->delete();

        return response()->json();
    }
}
