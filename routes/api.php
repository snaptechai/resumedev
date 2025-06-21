<?php

use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\FAQController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\MetaTagController;
use App\Http\Controllers\API\PackageController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\TemplateController;
use App\Http\Controllers\API\GoogleOAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);


    Route::get('/auth/google', [GoogleOAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [GoogleOAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

    Route::controller(TemplateController::class)->group(function () {
        Route::get('sliders', 'index');
    });

    Route::controller(FAQController::class)->group(function () {
        Route::get('faqs', 'index');
    });

    Route::get('packages', [PackageController::class, 'index']);
    Route::get('packages/{package}', [PackageController::class, 'show']);
    Route::get('coupon', [CartController::class, 'getCoupon']);
    Route::get('get-banner', [BannerController::class, 'getBanner']);

    Route::get('meta', [MetaTagController::class, 'getMeta']);

    Route::get('articles', [ArticleController::class, 'index']);

    Route::get('articles/sitemap', [ArticleController::class, 'sitemap']);
    Route::get('articles/{article}', [ArticleController::class, 'show']);
    Route::get('categories', [ArticleController::class, 'categories']);
    Route::get('categories/sitemap', [ArticleController::class, 'categorySitemap']);
    Route::get('categories/{category}', [ArticleController::class, 'byCategory']);

    Route::get('/accept-review', [ReviewController::class, 'index']);

    Route::middleware(['auth:sanctum'])->group(function () {
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
            Route::get('/get-details/{order_id}', 'getDetails');
        });

        Route::get('messages/{order_id}', [MessageController::class, 'getMessages']);
        Route::post('message', [MessageController::class, 'postMessage']);
    });
});
