<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\EnterpriseController as AdminEnterpriseController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [AuthController::class, "me"]);

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::apiResource("/enterprises", AdminEnterpriseController::class);
        Route::apiResource("/jobs", AdminJobController::class);
    });
});

Route::middleware(["guest"])->prefix("auth/")->group(function () {
    // solo se registran empresas
    Route::post("register/", [AuthController::class, "register"]);
    // se logea todo el mundo
    Route::post("login/", [AuthController::class, "login"]);
});
