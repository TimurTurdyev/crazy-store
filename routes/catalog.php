<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Catalog\CartController;
use App\Http\Controllers\Catalog\OrderController;

Route::get('/', function () {
    return view('catalog.home.index');
})->name('home');

Route::get('sale', [App\Http\Controllers\Catalog\SaleController::class, 'index'])->name('sale');
Route::get('catalog/{category}', [App\Http\Controllers\Catalog\CategoryController::class, 'index'])->name('catalog');
Route::get('group/{group}', [App\Http\Controllers\Catalog\GroupController::class, 'index'])->name('catalog.group');

Route::get('brand/{brand}', [App\Http\Controllers\Catalog\BrandController::class, 'index'])->name('catalog.brand');
Route::get('product/{product}', [App\Http\Controllers\Catalog\ProductController::class, 'index'])->name('catalog.product');

Route::prefix('cart')->as('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add', [CartController::class, 'add'])->name('add');
    Route::post('update', [CartController::class, 'update'])->name('update');
    Route::get('remove/{id}', [CartController::class, 'destroy'])->name('destroy');
    Route::get('clear', [CartController::class, 'clear'])->name('clear');
    Route::post('promo.add', [CartController::class, 'promoAdd'])->name('promo.add');
    Route::get('promo.remove', [CartController::class, 'promoRemove'])->name('promo.remove');
});

Route::prefix('order')->as('order.')->group(function () {
    Route::get('/create', [OrderController::class, 'create'])->name('create');
    Route::post('/store', [OrderController::class, 'store'])->name('store');
    Route::get('/completed/{order:order_code}', [OrderController::class, 'completed'])->name('completed');
    Route::get('/histories/{order:order_code}', [OrderController::class, 'histories'])->name('histories');
    Route::get('/deliveries/{postal_code?}', [OrderController::class, 'deliveries'])->name('deliveries');
});

Route::get('order/{order}/payment/instruction', [\App\Http\Controllers\Catalog\PaymentController::class, 'instruction'])->name('payment.instruction');
Route::post('order/{order:order_code}/payment/instruction/change', [\App\Http\Controllers\Catalog\PaymentController::class, 'change'])->name('payment.instruction.change');

Route::post('cdek-api/{method}', [\App\Http\Controllers\Api\CdekController::class, 'index'])->name('cdek-api');

Route::group(['prefix' => 'customer', 'middleware' => ['auth'], 'as' => 'customer.'], function () {
    Route::get('orders', [\App\Http\Controllers\Catalog\CustomerController::class, 'orders'])->name('orders');
    Route::get('orders/{order}', [\App\Http\Controllers\Catalog\CustomerController::class, 'orderDetail'])->name('order');
});
