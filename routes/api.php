<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ApiController::class, 'products']);
Route::get('/products/featured', [ApiController::class, 'featuredProducts']);
Route::get('/products/{id}', [ApiController::class, 'product']);
Route::get('/categories', [ApiController::class, 'categories']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [ApiController::class, 'cart']);
    Route::post('/cart/add', [ApiController::class, 'addToCart']);
    Route::put('/cart/update/{id}', [ApiController::class, 'updateCart']);
    Route::delete('/cart/remove/{id}', [ApiController::class, 'removeFromCart']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');