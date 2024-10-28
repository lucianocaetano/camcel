<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enterprise;
use App\Http\Requests\EnterpriseStoreRequest;
use App\Http\Requests\EnterpriseUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\EnterpriseResource;
use App\Http\Resources\OperatorsCollection;

class EnterpriseController extends Controller
{
/**
 * Display a listing of the resource.
 */
    public function index()
    {
        $enterprises = Enterprise::orderBy('created_at', 'desc')->get();

        return response()->json(EnterpriseResource::collection($enterprises));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnterpriseStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = "storage/" . $request->file('image')->store('enterprises', 'public');
        }

        $enterprise = Enterprise::create($data);

        return response(["enterprise" => $enterprise]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enterprise $enterprise)
    {
        return response()->json(
            [
                "enterprise" => EnterpriseResource::make($enterprise),
                "operators" => new OperatorsCollection($enterprise->operators()->get())
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnterpriseUpdateRequest $request, Enterprise $enterprise)
    {
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
        $enterprise->update(["is_valid" => false]);

        return response()->json([
            "message" => "OK"
        ]);
    }
}
