<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\VariantController;
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

    Route::resource('category', CategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('group', GroupController::class);
    Route::resource('size', SizeController::class);
    Route::resource('product', ProductController::class);
    Route::get('product/{product}/variant/create', [VariantController::class, 'create'])->name('variant.create');
    Route::post('product/{product}/variant/store', [VariantController::class, 'store'])->name('variant.store');
    Route::get('product/{product}/variant/{variant}/edit', [VariantController::class, 'edit'])->name('variant.edit');
    Route::put('product/{product}/variant/{variant}/update', [VariantController::class, 'update'])->name('variant.update');
});


require __DIR__ . '/auth.php';
