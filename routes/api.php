<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\PackageController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::get('packages', [PackageController::class, 'index']);
    Route::get('packages/{package}', [PackageController::class, 'show']);

    Route::middleware(['auth:sanctum'])->group(function(){
        Route::controller(CartController::class)->group(function () {
            Route::post('add-to-cart', 'addCart');
            Route::get('get-cart', 'getCart');
            Route::put('cart/update', 'update');
            Route::delete('cart/delete/{id}', 'delete');
            Route::delete('cart/clear', 'clear');
            Route::post('cart/place-order', 'post');
            Route::get('previous-orders', 'getPrevious');
            Route::get('current-order', 'currentOrder');
            Route::put('current-order-update', 'updateCurrentOrder');
            Route::get('coupon', 'getCoupon');
        });
    });
});
