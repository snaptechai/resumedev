<?php

use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PageDetailController;
use App\Http\Controllers\Admin\RedirectLinkController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TemplatesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('settings.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('banner', BannerController::class);
    Route::post('/update-banner-status/{id}', [BannerController::class, 'updateBannerStatus']);
    Route::resource('coupon', CouponController::class);
    Route::resource('faqs', FAQController::class);
    Route::resource('tags', TagController::class);
    Route::resource('article-categories', ArticleCategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('page-details', PageDetailController::class);
    Route::resource('templates', TemplatesController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('redirect-links', RedirectLinkController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('orders', OrderController::class);
    Route::post('orders/{id}/message', [OrderController::class, 'storeMessage'])->name('orders.message');
    Route::resource('articles', ArticleController::class);
    Route::resource('notification', NotificationController::class);
});

require __DIR__.'/auth.php';