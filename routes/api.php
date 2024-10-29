<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\EnterpriseController as AdminEnterpriseController;
use App\Http\Controllers\EmpresaController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::post('/admin/users', [UserController::class, 'store']);
    Route::get('/admin/users/{user}', [UserController::class, 'show']);
    Route::put('/admin/users/{user}', [UserController::class, 'update']);
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, "me"]);
    Route::get('/verificar-empresa', [EmpresaController::class, 'verificar']);
    Route::post('/crear-empresa', [EmpresaController::class, 'crear']);

    Route::middleware([AdminMiddleware::class])->prefix("/admin")->group(function () {
        Route::apiResource("/enterprises", AdminEnterpriseController::class);

        // esta ruta es para devolver todos los usuarios con rol empresa que no esten asosiadas a una
        Route::get("/users_enterprise", function () {
            $users = User::whereDoesntHave('enterprises')->where('rol', '=', 'Enterprise')->get();

            return response()->json([
                "users" => new UsersCollection($users)
            ]);
        });
        Route::apiResource("/jobs", AdminJobController::class)->except(["show"]);

        Route::get("/businessmen", function () {
            $user = User::whereDoesntHave('enterprises')->where('rol', '!=', 'Admin')->get();

            return response()->json($user);
        });
    })->name("dashboard-admin.");
});

Route::middleware(["guest"])->prefix("auth/")->group(function () {
    // solo se registran empresas
    Route::post("register/", [AuthController::class, "register"]);
    // se logea todo el mundo
    Route::post("login/", [AuthController::class, "login"]);
});
