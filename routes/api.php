<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\EnterpriseController as AdminEnterpriseController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, "me"]);

    Route::middleware([AdminMiddleware::class])->prefix("/admin")->group(function () {
        Route::apiResource("/enterprises", AdminEnterpriseController::class);

        // esta ruta es para devolver todos los usuarios con rol empresa que no esten asosiadas a una
        Route::get("/users_enterprise", function () {
            $users = User::whereDoesntHave('enterprises')->where('rol', '!=', 'Admin')->get();

            return response()->json([
                "users" => $users
            ]);
        });
    })->name("dashboard-admin.");
});

Route::middleware(["guest"])->prefix("auth/")->group(function () {
    // solo se registran empresas
    Route::post("register/", [AuthController::class, "register"]);
    // se logea todo el mundo
    Route::post("login/", [AuthController::class, "login"]);
});
