<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TechicianController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(AuthMiddleware::class);

// If need a middleware for role
Route::middleware(['Role:super_admin,admin'])->group(function () {
    Route::get('/add-employee', [EmployeeController::class, 'index'])->name('add-employee');
    Route::get('/list-employee', [EmployeeController::class, 'showEmployee'])->name('list-employee');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/add-customer', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/add-customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customer/{id}', [CustomerController::class, 'updateTech'])->name('customer.updateTech');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('/technicians', [TechicianController::class, 'index'])->name('technicians.index');
    Route::get('/add-technician', [TechicianController::class, 'create'])->name('technicians.create');
    Route::post('/add-techtechnician', [TechicianController::class, 'store'])->name('technicians.store');
    Route::delete('/technician/{id}', [TechicianController::class, 'destroy'])->name('technicians.destroy');
});

Route::post('/employee/create', [EmployeeController::class, 'createEmployee'])->name('create-employee');
Route::delete('/employee/delete/{id}', [EmployeeController::class, 'deleteEmployee'])->name('delete-employee');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
