<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeownerController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('account/register', [AccountController::class, 'register'])->name('account.register');
Route::post('account/register', [AccountController::class, 'ProcessRegister'])->name('account.ProcessRegister');
Route::get('account/login', [AccountController::class, 'login'])->name('account.login');
Route::post('account/login', [AccountController::class, 'authenticate'])->name('account.authenticate');
Route::get('account/profile', [AccountController::class, 'profile'])->name('account.profile');
Route::get('tenant/dashboard', [AccountController::class, 'tenantDashboard'])->name('tenant.dashboard');
Route::get('tenant/profile', [AccountController::class, 'tenantProfile'])->name('tenant.profile');

Route::get('homeowner/dashboard', [AccountController::class, 'homeownerDashboard'])->name('homeowner.dashboard');
Route::get('homeowner/update-profile', [HomeownerController::class, 'edit'])->name('homeowner.editProfile');
Route::post('homeowner/update-profile', [HomeownerController::class, 'updateProfile'])->name('homeowner.updateProfile');
