<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\EnterpriseResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller 
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            "rol" => "Enterprise"
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        
        $enterprise = $user->enterprise;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            "user" => [
                "name" => $user->name,
                "email" => $user->email,
                "rol" => $user->rol
            ],
            "enterprise" => $enterprise? EnterpriseResource::make($enterprise): null
        ]);
    }

    public function me(Request $request)
    {
        $enterprise = $request->user()->enterprise;

        return response()->json([
            "user" => [
                "name" => $request->user()->name,
                "email" => $request->user()->email,
                "rol" => $request->user()->rol
            ],
            "enterprise" => $enterprise? EnterpriseResource::make($enterprise): null
        ], 201);
    }
}
