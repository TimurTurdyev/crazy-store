<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('catalog/{id}', function () {
    return view('welcome');
})->name('catalog');

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('brand', \App\Http\Controllers\Admin\BrandController::class);
});


require __DIR__ . '/auth.php';
