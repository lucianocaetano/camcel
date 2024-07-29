<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EnterpriseController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, "me"]);

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get("/enterprises", [EnterpriseController::class, "index"])->name("get-enterprises");
    })->name("dashboard-admin.");

});

Route::middleware(["guest"])->prefix("auth/")->group(function () {
    Route::post("register/", [AuthController::class, "register"]);
    Route::post("login/", [AuthController::class, "login"]);
});
