<?php
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\VariantController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'  =>  'admin', 'middleware' => ['auth', 'admin'], 'as' => 'admin.'], function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('category', CategoryController::class)->names('category');
    Route::resource('brand', BrandController::class)->names('brand');
    Route::resource('group', GroupController::class)->names('group');
    Route::resource('size', SizeController::class)->names('size');
    Route::resource('product', ProductController::class)->names('product');
    Route::resource('product/{product}/variant', VariantController::class)->names('variant');
    Route::resource('order', OrderController::class)->names('order');
    Route::get('price/filter', [PriceController::class, 'filter'])->name('price.filter');
    Route::get('/deliveries/{postal_code?}', [OrderController::class, 'deliveries'])->name('deliveries');
});
