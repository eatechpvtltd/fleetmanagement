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
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('forgot-password-post', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('forgot-password-success', function () {
    return view('common.success-pw-mail');
})->name('forgot-password-success');
Route::get('confirm-password/{hashed_id}', [ForgotPasswordController::class, 'showConfirmForm'])->name('confirm.request');
Route::post('reset-password/{hashed_id}', [ForgotPasswordController::class, 'resetPassword'])->name('auth.reset-password');
Route::get('password-changed-success', function () {
    return view('common.password-changed-success');
})->name('password-changed-success');




Route::get('admin/login', [AdminController::class, 'login']);
Route::get('admin', [AdminController::class, 'index']);

Route::get('organization', [OrganizationController::class, 'index']);
Route::get('vehicle', [VehicleController::class, 'index']);
Route::get('group', [GroupController::class, 'index']);
Route::get('sites', [SitesController::class, 'index']);
Route::get('device', [DeviceController::class, 'index']);


Route::get('trip-report', [UserController::class, 'allTripReport'])->name('trip-report');

