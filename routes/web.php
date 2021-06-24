<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\VariantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('catalog.home.index');
});

Route::get('catalog/{category}', [App\Http\Controllers\Catalog\CategoryController::class, 'index'])->name('catalog');

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('category', CategoryController::class)->names('category');
    Route::resource('brand', BrandController::class)->names('brand');
    Route::resource('group', GroupController::class)->names('group');
    Route::resource('size', SizeController::class)->names('size');
    Route::resource('product', ProductController::class)->names('product');
    Route::resource('product/{product}/variant', VariantController::class)->names('variant');
});


require __DIR__ . '/auth.php';
