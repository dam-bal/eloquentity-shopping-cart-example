<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Carts
 */
Route::post('carts', [CartController::class, 'store'])->middleware('auth:sanctum');

Route::get('carts/{cartId}', [CartController::class, 'show']);

Route::post('carts/{cartId}/items/{productId}', [CartController::class, 'addProduct']);

Route::delete('carts/{cartId}/items/{productId}', [CartController::class, 'removeProduct']);

Route::post('carts/{cartId}/checkout', [CartController::class, 'checkout'])->middleware('auth:sanctum');

/**
 * Orders
 */
Route::get('orders/{orderId}', [OrderController::class, 'show']);

/**
 * Customer
 */
Route::post('customers', [CustomerController::class, 'store']);

Route::post('auth', [CustomerController::class, 'auth']);

Route::get('customer', [CustomerController::class, 'show'])->middleware('auth:sanctum');

/**
 * Products
 */
Route::get('products', [ProductController::class, 'index']);
