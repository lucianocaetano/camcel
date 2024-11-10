<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\JobController;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\v1\EnterpriseController as V1EnterpriseController;
use App\Http\Controllers\v1\JobController as V1JobController;
use App\Http\Controllers\v1\OperatorController as V1OperatorController;
use App\Http\Controllers\v1\UserController as V1UserController;
use App\Http\Controllers\v1\EnterpriseDocumentController as V1EnterpriseDocumentController;
use App\Http\Controllers\v1\OperatorDocumentController as V1OperatorDocumentController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, "me"]);

    Route::apiResource("/enterprises", V1EnterpriseController::class);
    Route::prefix("/enterprises/{enterprise:slug}")->group(function () {
        Route::apiResource("/documents", V1EnterpriseDocumentController::class);
        Route::apiResource("/operators", V1OperatorController::class);
        Route::prefix("/operators/{operator:id}")->group(function () {
            Route::apiResource("/documents", V1OperatorDocumentController::class)->names("operators.documents");
        });
    });

    Route::apiResource("/users", V1UserController::class)->except(["show"]);

    // IMPORTANTE LEER:

    // juan, estas son tus rutas:

    // puse tus rutas con el grupo con el prefixo /admin para que te siga funcionando el frontend
    // yo decidi sacarlas de ese middleware por que tengo pensado usar politicas de acceso de laravel
    // en mes de middleware
    Route::prefix("/admin")->group(function () {
        Route::apiResource("/jobs", V1JobController::class)->except(["show"]);
        Route::patch('/jobs/{id}/updateConfirmation', [V1JobController::class, 'updateConfirmation']);
        Route::patch('/jobs/{id}/updateConfirmationEvent', [V1JobController::class, 'updateConfirmationEvent']);
    });
});

Route::middleware(["guest"])->prefix("auth/")->group(function () {
    Route::post("register/", [AuthController::class, "register"]);
    Route::post("login/", [AuthController::class, "login"]);
});
