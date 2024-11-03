<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\EnterpriseController as AdminEnterpriseController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Middleware\AdminMiddleware;
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

    Route::middleware([AdminMiddleware::class])->prefix("/admin")->group(function () {
        Route::apiResource("/enterprises", AdminEnterpriseController::class);
        Route::apiResource("/jobs", AdminJobController::class)->except(["show"]);
        Route::apiResource("/users", AdminUserController::class)->except(["show"]);
    })->name("dashboard-admin.");
});

Route::middleware(["guest"])->prefix("auth/")->group(function () {
    // solo se registran empresas
    Route::post("register/", [AuthController::class, "register"]);
    // se logea todo el mundo
    Route::post("login/", [AuthController::class, "login"]);
});
