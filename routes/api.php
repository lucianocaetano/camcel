<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\EnterpriseController as AdminEnterpriseController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, "me"]);

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get("/enterprises", [AdminEnterpriseController::class, "index"])->name("get-enterprises");
        Route::get("/enterprises/{enterprise}", [AdminEnterpriseController::class, "show"])->name("get-enterprise");
        Route::post("/enterprises", [AdminEnterpriseController::class, "store"])->name("store-enterprise");
    })->name("dashboard-admin.");
});

Route::middleware(["guest"])->prefix("auth/")->group(function () {
    // solo se registran empresas
    Route::post("register/", [AuthController::class, "register"]);
    // se logea todo el mundo
    Route::post("login/", [AuthController::class, "login"]);
});
