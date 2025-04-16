<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group( function () {
//     // Route::resource('products', ProductController::class);
//     Route::get('drivers', [UserController::class, 'driver']);
// });

Route::get('drivers', [UserController::class, 'driver']);
Route::post('vehicle-count', [UserController::class, 'vehicleCount']);
Route::post('vehicles', [UserController::class, 'vehicle']);
Route::post('sites', [UserController::class, 'site']);
Route::post('trip-summary', [UserController::class, 'getTripSummary']);