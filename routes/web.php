<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\API\DashboardDataController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/drivers', function (){
        try {
            $drivers = \App\Models\Driver::all();
            return response()->json([
                'success' => true,
                'message' => 'Drivers retrieved successfully',
                'data' => $drivers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve drivers: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    });
    Route::post('/login', [AuthController::class, 'login']);

    Route::post('vehicle-count', function () {
        // Static data for vehicle status counts
        $vehicleCounts = [
            'running' => 12,
            'idle' => 8,
            'not_reachable' => 5,
            'all' => 25, // or you could do running + idle + not_reachable
        ];

        return response()->json([
            'success' => true,
            'data' => $vehicleCounts
        ]);
    });
    Route::get('/vehicles', function () {
        // return \App\Models\Vehicle::all();
        try {
            $sites = \App\Models\Vehicle::all();
            return response()->json([
                'success' => true,
                'message' => 'Vehicles retrieved successfully',
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
    Route::get('/sites', function () {
        try {
            $sites = \App\Models\Site::all();
            return response()->json([
                'success' => true,
                'message' => 'Sites retrieved successfully',
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
Route::post('/forgot-password-post', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/forgot-password-success', function () {
    return view('common.success-pw-mail');
})->name('forgot-password-success');
Route::get('/confirm-password/{hashed_id}', [ForgotPasswordController::class, 'showConfirmForm'])->name('confirm.request');
Route::post('/reset-password/{hashed_id}', [ForgotPasswordController::class, 'resetPassword'])->name('auth.reset-password');
Route::get('/password-changed-success', function () {
    return view('common.password-changed-success');
})->name('password-changed-success');




Route::get('/admin', [AdminController::class, 'index']);
Route::get('/adminproduct', [AdminController::class, 'products']);
Route::post('/AddNewVehicle', [AdminController::class, 'AddNewVehicle']);
Route::post('/UpdateProduct', [AdminController::class, 'UpdateProduct']);
Route::get('/deleteProduct/{id}', [AdminController::class, 'deleteProduct']);
Route::get('/adminvehicle', [AdminController::class, 'vehicle']);


Route::post('/AddNewOrg', [VehicleController::class, 'Organization']);


Route::get('/Organization', [OrganizationController::class, 'index']);
Route::get('/Vehicle', [VehicleController::class, 'index']);
Route::get('/Group', [GroupController::class, 'index']);
Route::get('/Sites', [SitesController::class, 'index']);
Route::get('/Device', [DeviceController::class, 'index']);


Route::get('trip-report', [UserController::class, 'allTripReport'])->name('trip-report');
