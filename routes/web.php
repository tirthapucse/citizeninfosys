<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeownerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SecurityAdmin;
use App\Http\Controllers\SuperAdmin;

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
Route::get('/tenant/profile', [TenantController::class, 'viewFullProfile'])->name('tenant.view');
Route::get('/tenant/requests', [TenantController::class, 'rentalRequests'])->name('tenant.requests');
Route::post('/tenant/accept-request', [TenantController::class, 'acceptRequest'])->name('tenant.acceptRequest');



Route::get('homeowner/dashboard', [AccountController::class, 'homeownerDashboard'])->name('homeowner.dashboard');
Route::get('homeowner/edit-profile', [HomeownerController::class, 'edit'])->name('homeowner.editProfile');
Route::post('homeowner/update-profile', [HomeownerController::class, 'updateProfile'])->name('homeowner.updateProfile');
Route::get('/homeowner/profile', [HomeownerController::class, 'viewFullProfile'])->name('homeowner.view');
// Load the rental page where homeowners can search and send requests
Route::get('/homeowner/rental', [HomeownerController::class, 'rental'])->name('homeowner.rental');

// Handle searching for tenants
Route::get('/homeowner/search-tenant', [HomeownerController::class, 'searchTenant'])->name('homeowner.searchTenant');
Route::post('/homeowner/send-request', [HomeownerController::class, 'sentRequest'])->name('homeowner.sendRequest');




Route::resource('property', PropertyController::class);



Route::get('security/dashboard', [SecurityAdmin::class, 'dashboard'])->name('security_admin.dashboard');
// In routes/web.php
Route::get('/security-admin/search', [SecurityAdmin::class, 'searchUsers'])->name('security_admin.search');


Route::get('super/dashboard', [SuperAdmin::class, 'dashboard'])->name('super_admin.dashboard');
Route::get('/super/users', [SuperAdmin::class, 'listUsers'])->name('superadmin.users');
Route::delete('/superadmin/users/{id}', [SuperAdmin::class, 'deleteUser'])->name('superadmin.users.delete');
Route::get('/users/edit/{id}', [SuperAdmin::class, 'editUser'])->name('superadmin.users.edit');
Route::put('/users/update/{id}', [SuperAdmin::class, 'updateUser'])->name('superadmin.users.update');
Route::get('/tenants/edit/{id}', [SuperAdmin::class, 'editTenant'])->name('superadmin.tenants.edit');
Route::put('/tenants/update/{id}', [SuperAdmin::class, 'updateTenant'])->name('superadmin.tenants.update');
Route::get('/homeowners/edit/{id}', [SuperAdmin::class, 'editHomeowner'])->name('superadmin.homeowners.edit');
Route::put('/homeowners/update/{id}', [SuperAdmin::class, 'updateHomeowner'])->name('superadmin.homeowners.update');
Route::patch('/superadmin/users/verify/{id}', [AccountController::class, 'verifyUser'])
    ->name('superadmin.users.verify');



Route::get('logout', [AccountController::class, 'logout'])->name('account.logout');



Route::get('search/tenant', [TenantController::class, 'searchTenant'])->name('tenant.search');
