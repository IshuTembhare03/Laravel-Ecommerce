<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/products', [FrontendController::class, 'products'])->name('products');
Route::get('/product/{slug}', [FrontendController::class, 'productDetail'])->name('product.detail');

Route::get('/login', [AuthenticationController::class, 'create'])->name('login');
Route::post('/login', [AuthenticationController::class, 'store']);
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [AuthenticationController::class, 'destroy'])->name('logout');

Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/success', [FrontendController::class, 'orderSuccess'])->name('order.success');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        Route::get('/products', [AdminController::class, 'productsIndex'])->name('admin.products.index');
        Route::get('/products/create', [AdminController::class, 'productsCreate'])->name('admin.products.create');
        Route::post('/products', [AdminController::class, 'productsStore'])->name('admin.products.store');
        Route::get('/products/{id}/edit', [AdminController::class, 'productsEdit'])->name('admin.products.edit');
        Route::put('/products/{id}', [AdminController::class, 'productsUpdate'])->name('admin.products.update');
        Route::delete('/products/{id}', [AdminController::class, 'productsDestroy'])->name('admin.products.destroy');
        Route::delete('/product-images/{id}', [AdminController::class, 'productImageDestroy'])->name('admin.product-images.destroy');
        
        Route::get('/categories', [AdminController::class, 'categoriesIndex'])->name('admin.categories.index');
        Route::get('/categories/create', [AdminController::class, 'categoriesCreate'])->name('admin.categories.create');
        Route::post('/categories', [AdminController::class, 'categoriesStore'])->name('admin.categories.store');
        Route::get('/categories/{id}/edit', [AdminController::class, 'categoriesEdit'])->name('admin.categories.edit');
        Route::put('/categories/{id}', [AdminController::class, 'categoriesUpdate'])->name('admin.categories.update');
        Route::delete('/categories/{id}', [AdminController::class, 'categoriesDestroy'])->name('admin.categories.destroy');
        
        Route::get('/orders', [AdminController::class, 'ordersIndex'])->name('admin.orders.index');
        Route::get('/orders/{id}', [AdminController::class, 'ordersShow'])->name('admin.orders.show');
        Route::put('/orders/{id}', [AdminController::class, 'ordersUpdate'])->name('admin.orders.update');
    });
});