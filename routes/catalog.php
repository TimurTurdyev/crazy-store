<?php
use App\Http\Controllers\Catalog\CartController;
use App\Http\Controllers\Catalog\CheckoutController;
use App\Http\Controllers\Catalog\OrderController;

Route::get('/', function () {
    return view('catalog.home.index');
})->name('home');

Route::get('catalog/{category}', [App\Http\Controllers\Catalog\CategoryController::class, 'index'])->name('catalog');
Route::get('group/{group}', [App\Http\Controllers\Catalog\GroupController::class, 'index'])->name('catalog.group');

Route::get('brand/{brand}', [App\Http\Controllers\Catalog\BrandController::class, 'index'])->name('catalog.brand');
Route::get('product/{product}', [App\Http\Controllers\Catalog\ProductController::class, 'index'])->name('catalog.product');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('add', [CartController::class, 'add'])->name('cart.add');
    Route::post('update', [CartController::class, 'update'])->name('cart.update');
    Route::get('remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('coupon.add', [CartController::class, 'couponAdd'])->name('cart.coupon.add');
    Route::get('coupon.remove', [CartController::class, 'couponRemove'])->name('cart.coupon.remove');
});

Route::prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('order.index');
});

Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.cart');
});
