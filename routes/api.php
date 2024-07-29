<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EnterpriseController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get("/enterprises", [EnterpriseController::class, "index"])->name("get-enterprises");
    })->name("dashboard-admin.");

});

Route::get("/test", function () {
    return "hola";
});

Route::middleware(["guest"])->group(function () {
    Route::post("register/", [AuthController::class, "register"]);
    Route::post("login/", [AuthController::class, "login"]);
});
