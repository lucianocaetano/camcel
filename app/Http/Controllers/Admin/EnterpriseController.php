<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enterprise;
use App\Http\Requests\EnterpriseStoreRequest;
use App\Http\Requests\EnterpriseUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\EnterpriseResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Enterprise::class);

        $enterprises = Enterprise::orderBy('created_at', 'desc')->get();

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
            $enterprise = $user->enterprise()->create($data);
        }

        return response(["enterprise" => $enterprise], 201);
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

        return response(["enterprise" => $enterprise]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enterprise $enterprise)
    {
        Gate::authorize('delete', $enterprise);

        $enterprise->update(["is_valid" => false]);

        return response()->json();
    }
}
