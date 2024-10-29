<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\EnterprisesCollection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los usuarios
        $users = User::all();

        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        // Validar la solicitud
        $data = $request->validated();

        // Encriptar la contraseña
        $data['password'] = Hash::make($data['password']);

        // Crear un nuevo usuario
        $user = User::create($data);

        return response()->json(["user" => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Devolver el usuario junto con su empresa relacionada
        return response()->json([
            "user" => UserResource::make($user),
            "enterprise" => new EnterprisesCollection($user->enterprises()->get())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        // Validar la solicitud
        $data = $request->validated();

        // Verificar si la contraseña ha sido actualizada
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Actualizar el usuario
        $user->update($data);

        return response()->json(["user" => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Desactivar el usuario en lugar de eliminarlo
        $user->update(["is_valid" => false]);

        return response()->json(null, 204);
    }
}
