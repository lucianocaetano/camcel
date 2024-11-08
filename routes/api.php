<?php

use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\EnterpriseController as AdminEnterpriseController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\OperatorController as AdminOperatorController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EnterpriseDocumentController as AdminEnterpriseDocumentController;
use App\Http\Controllers\Admin\OperatorDocumentController as AdminOperatorDocumentController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, "me"]);

    Route::middleware([AdminMiddleware::class])->prefix("/admin")->group(function () {

        Route::apiResource("/enterprises", AdminEnterpriseController::class);
        Route::prefix("/enterprises/{enterprise:slug}")->group(function () {
            Route::apiResource("/documents", AdminEnterpriseDocumentController::class);

            Route::apiResource("/operators", AdminOperatorController::class);
            Route::prefix("/operators/{operator:id}")->group(function () {
                Route::apiResource("/documents", AdminOperatorDocumentController::class)->names("operator.documents");
            });
        });

        Route::apiResource("/jobs", AdminJobController::class)->except(["show"]);
        Route::patch('/jobs/{id}/updateConfirmation', [AdminJobController::class, 'updateConfirmation']);
        Route::patch('/jobs/{id}/updateConfirmationEvent', [AdminJobController::class, 'updateConfirmationEvent']);
        Route::apiResource("/users", AdminUserController::class)->except(["show"]);
    })->name("dashboard-admin.");
});

Route::middleware(["guest"])->prefix("auth/")->group(function () {
    Route::post("register/", [AuthController::class, "register"]);
    Route::post("login/", [AuthController::class, "login"]);
});
