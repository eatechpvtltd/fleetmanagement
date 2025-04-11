<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/drivers', DashboardDataController::class . '@index');
    Route::post('/login', [AuthController::class, 'login']);
   
    Route::get('/vehicles', function () {
        return \App\Models\Vehicle::all();
    });
    Route::get('/sites', function () {
        try {
            $sites = \App\Models\Site::all();
            return response()->json([
                'success' => true,
                'message' => 'Drivers retrieved successfully',
                'data' => $sites
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve sites: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    });

});




Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::get('/confirm-password', [ForgotPasswordController::class, 'showConfirmForm'])->name('confirm.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::post('/reset-password/{hashed_id}', [ForgotPasswordController::class, 'resetPassword'])->name('auth.reset-password');
