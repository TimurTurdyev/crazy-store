<?php

use App\Http\Controllers\Catalog\CartController;
use App\Http\Controllers\Catalog\CheckoutController;
use App\Http\Controllers\Catalog\OrderController;
use App\Http\Controllers\Widget\CdekWidgetController;

Route::get('/', function () {
    return view('catalog.home.index');
})->name('home');

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
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/shipping/{shipping}', [OrderController::class, 'include'])->name('shipping');
});

Route::prefix('cdek-widget')->as('cdek_widget.')->group(function () {
    Route::get('/', [CdekWidgetController::class, 'index'])->name('index');
    Route::get('/info', [CdekWidgetController::class, 'info'])->name('info');
    Route::post('/info', [CdekWidgetController::class, 'info'])->name('info');
    Route::get('/template', [CdekWidgetController::class, 'template'])->name('template');
});

Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.cart');
});
