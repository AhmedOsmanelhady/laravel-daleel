<?php

use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StudentController;

Route::post("auth/register", [AuthController::class, "register"]);
Route::post("auth/login", [AuthController::class, "login"]);

Route::apiResource("student", StudentController::class);

Route::apiResource("doctor", DoctorController::class);

Route::apiResource("{doctor}/reviews", ReviewController::class);

// Route::group(["Middleware" => "auth:sanctum"], function () {
// });
