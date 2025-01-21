<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeownerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PropertyController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('account/register', [AccountController::class, 'register'])->name('account.register');
Route::post('account/register', [AccountController::class, 'ProcessRegister'])->name('account.ProcessRegister');
Route::get('account/login', [AccountController::class, 'login'])->name('account.login');
Route::post('account/login', [AccountController::class, 'authenticate'])->name('account.authenticate');
Route::get('account/profile', [AccountController::class, 'profile'])->name('account.profile');

Route::get('tenant/dashboard', [TenantController::class, 'tenantDashboard'])->name('tenant.dashboard');
Route::post('tenant/update-profile', [TenantController::class, 'updateProfile'])->name('tenant.updateProfile');
Route::get('tenant/edit-profile', [TenantController::class, 'edit'])->name('tenant.editProfile');


Route::get('homeowner/dashboard', [AccountController::class, 'homeownerDashboard'])->name('homeowner.dashboard');
Route::get('homeowner/edit-profile', [HomeownerController::class, 'edit'])->name('homeowner.editProfile');
Route::post('homeowner/update-profile', [HomeownerController::class, 'updateProfile'])->name('homeowner.updateProfile');
Route::get('/homeowner/profile', [HomeownerController::class, 'viewFullProfile'])->name('homeowner.view');


Route::resource('property', PropertyController::class);
