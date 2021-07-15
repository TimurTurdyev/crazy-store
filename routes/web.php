<?php
use App\Http\Controllers\Catalog\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('catalog.home.index');
})->name('home');

Route::get('catalog/{category}', [App\Http\Controllers\Catalog\CategoryController::class, 'index'])->name('catalog');
Route::get('group/{group}', [App\Http\Controllers\Catalog\GroupController::class, 'index'])->name('catalog.group');

Route::get('brand/{brand}', [App\Http\Controllers\Catalog\BrandController::class, 'index'])->name('catalog.brand');
Route::get('product/{product}', [App\Http\Controllers\Catalog\ProductController::class, 'index'])->name('catalog.product');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('checkout.cart');
    Route::post('add', [CartController::class, 'add'])->name('cart.add');
    Route::get('remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('clear', [CartController::class, 'clear'])->name('cart.clear');
});

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
