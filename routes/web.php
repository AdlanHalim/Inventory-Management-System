<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\AlertsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Registration Routes
Route::get('/register', function () {
    return view('auth.register'); // Path to your registration view
})->name('register');
Route::post('/register', [Controller::class, 'register'])->name('register.store');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Dashboard (Protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Product Management
    Route::resource('products', ProductController::class);

    // Other Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/purchases', [PurchasesController::class, 'index'])->name('purchases.index');
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('/alerts', [AlertsController::class, 'index'])->name('alerts.index');

    Route::resource('sales', SalesController::class)->except(['show']);
    Route::delete('/sales/{sale}', [SalesController::class, 'destroy'])->name('sales.destroy');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');

});



Route::middleware(['auth'])->group(function () {
    // Admin can access all routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class); // Admin and suppliers can access this
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
});


