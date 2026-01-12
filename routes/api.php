<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductPriceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::get('products/{product}/prices', [ProductPriceController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);

    Route::post('products/{product}/prices', [ProductPriceController::class, 'store']);
});
