<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnterpriseStoreRequest;
use App\Http\Requests\EnterpriseUpdateRequest;
use App\Http\Resources\EnterpriseResource;
use App\Models\Enterprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnterpriseController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnterpriseStoreRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $data['image'] = "storage/" . $request->file('image')->store('enterprises', 'public');
        }

        $enterprise = $user->enterprise()->create($data);

        return response(["enterprise" => $enterprise], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        $user = Auth::user();

        if (!$user || !$user->enterprise) {
            return response()->json([
                "message" => "You don't have a company"
            ], 403);
        }

        $enterprise = $user->enterprise;

        return response()->json(
            ["enterprise" => EnterpriseResource::make($enterprise)]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnterpriseUpdateRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        if (!$user || !$user->enterprise) {
            return response()->json([
                "message" => "You don't have a company"
            ], 403);
        }

        $enterprise = $user->enterprise;

        if ($request->hasFile('image')) {
            $data['image'] = "storage/" . $request->file('image')->store('enterprises', 'public');
        }

        $enterprise->update($data);

        return response(["enterprise" => $enterprise]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $user = Auth::user();

        if (!$user || !$user->enterprise) {
            return response()->json([
                "message" => "You don't have a company"
            ], 403);
        }

        $enterprise = $user->enterprise;

        $enterprise->update(["is_valid" => false]);

        return response()->json([
            "message" => "OK"
        ]);
    }
}
