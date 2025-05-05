<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReportController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/getAllRoles', [RoleController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    // Authenticated User Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Role Routes
    Route::post('/role', [RoleController::class, 'createRole']);
    Route::get('/role', [RoleController::class, 'getRole']);
    Route::get('/role/{id}', [RoleController::class, 'getRole']);
    Route::put('/role/{id}', [RoleController::class, 'updateRole']);
    Route::delete('/role/{id}', [RoleController::class, 'deleteRole']);

    // Doctor & Pharmacist Routes
    Route::get('/doctors', [DoctorController::class, 'search']);
    Route::get('/pharmacists', [PharmacistController::class, 'search']);

    // Rating Routes
    Route::post('/rate-doctor', [RatingController::class, 'rateDoctor']);
    Route::post('/rate-pharmacist', [RatingController::class, 'ratePharmacist']);

    // Report Routes
    Route::post('/report-doctor', [ReportController::class, 'reportDoctor']);
    Route::post('/report-pharmacist', [ReportController::class, 'reportPharmacist']);
});
