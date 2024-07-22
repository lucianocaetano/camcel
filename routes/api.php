<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});

Route::middleware(["guest"])->group(function () {
    Route::post("register/", [AuthController::class, "register"]);
    Route::post("login/", [AuthController::class, "login"]);
});
