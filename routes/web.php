<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\AlertsController;
use App\Http\Controllers\Controller;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/register', function () {
    return view('auth.register'); // Path to your registration view
})->name('register');

Route::post('/register', [Controller::class, 'register'])->name('register.store');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::resource('products', ProductController::class);
    });
    
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
        Route::get('/purchases', [PurchasesController::class, 'index'])->name('purchases.index');
        Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('/alerts', [AlertsController::class, 'index'])->name('alerts.index');
    });
    
    
    
    Route::resource('sales', SalesController::class)->except(['show']);
    Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('/reports', [SalesController::class, 'report'])->name('reports.index');
    Route::delete('/sales/{sale}', [SalesController::class, 'destroy'])->name('sales.destroy');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');  
});
