<?php

use App\Http\Controllers\{ProfileController, CustomerController, ProductController, SaleController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/registerCustomer', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/registerCustomer', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/editCustomer/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/editCustomer/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/deleteCustomer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/registerProduct', [ProductController::class, 'create'])->name('product.create');
    Route::post('/registerProduct', [ProductController::class, 'store'])->name('product.store');
    Route::get('/editProduct/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/editProduct/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/deleteProduct/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/dashboard', [SaleController::class, 'index'])->name('dashboard');
    Route::post('/sales', [SaleController::class, 'store'])->name('sale.store');
    Route::get('/editSale/{sale}', [SaleController::class, 'edit'])->name('sale.edit');
    Route::put('/editSale/{sale}', [SaleController::class, 'update'])->name('sale.update');
    Route::delete('/sale/{id}', [SaleController::class, 'destroy'])->name('sale.destroy');
});

require __DIR__.'/auth.php';
