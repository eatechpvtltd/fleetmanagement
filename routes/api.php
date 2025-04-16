<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [UserController::class, 'login']);

// Route::middleware('auth:sanctum')->group( function () {
//     // Route::resource('products', ProductController::class);
//     Route::get('drivers', [UserController::class, 'driver']);
// });

Route::get('drivers', [UserController::class, 'driver']);
Route::post('vehicle-count', [UserController::class, 'vehicleCount']);
Route::get('vehicles', [UserController::class, 'vehicle']);
Route::get('sites', [UserController::class, 'site']);
Route::post('trip-summary', [UserController::class, 'getTripSummary']);