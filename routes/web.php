<?php

use App\Http\Controllers\Admin\AddonController;
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
use App\Http\Controllers\Admin\SeoTagsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TemplatesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('settings.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('permission:View & Manage order')->group(function () {
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');

        Route::middleware('permission:Edit order')->group(function () {
            Route::get('orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
            Route::put('orders/{id}', [OrderController::class, 'update'])->name('orders.update');
            Route::put('orders/{id}/update-admin-note', [OrderController::class, 'update_admin_note'])->name('orders.update-admin-note');
            Route::post('orders/{order}/upload-admin-note', [OrderController::class, 'uploadAdminNoteFile'])->name('order.admin-note.upload');
            Route::delete('orders/{order}/file/{file}', [OrderController::class, 'deleteAdminNoteFile'])->name('order.admin-note.file.delete');
        });
        Route::middleware('permission:Delete order')->group(function () {
            Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        });
        Route::middleware('permission:Send chat messages')->group(function () {
            Route::post('orders/{id}/message', [OrderController::class, 'storeMessage'])->name('orders.message');
            Route::get('/admin/orders/{id}/getmessages', [OrderController::class, 'getMessages'])->name('admin.orders.getmessages');
        });
    });


    Route::middleware('permission:View review')->group(function () {
        Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');

        Route::middleware('permission:Accept review')->group(function () {
            Route::put('reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
        });

        Route::middleware('permission:Delete review')->group(function () {
            Route::delete('reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        });
    });

    Route::middleware('permission:View article')->group(function () {
        Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
        Route::middleware('permission:Add article')->group(function () {
            Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
            Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
        });

        Route::get('articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

        Route::middleware('permission:Edit article')->group(function () {
            Route::get('articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
            Route::put('articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
        });

        Route::middleware('permission:Delete article')->group(function () {
            Route::delete('articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
        });
    });

    Route::middleware('permission:View user')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');

        Route::middleware('permission:Add user')->group(function () {
            Route::get('users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('users', [UserController::class, 'store'])->name('users.store');
            Route::get('users/{id}/writer-view', [UserController::class, 'writer_view'])->name('users.writerView');
        });

        Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');

        Route::middleware('permission:Edit user')->group(function () {
            Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
        });

        Route::middleware('permission:Delete user')->group(function () {
            Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });

    Route::middleware('permission:View package')->group(function () {
        Route::get('packages', [PackageController::class, 'index'])->name('packages.index');
        Route::get('packages/{id}', [PackageController::class, 'show'])->name('packages.show');

        Route::middleware('permission:Edit package')->group(function () {
            Route::get('packages/{id}/edit', [PackageController::class, 'edit'])->name('packages.edit');
            Route::put('packages/{id}', [PackageController::class, 'update'])->name('packages.update');
        });
    });

    Route::middleware('permission:View template')->group(function () {
        Route::get('templates', [TemplatesController::class, 'index'])->name('templates.index');
        Route::get('templates/{id}', [TemplatesController::class, 'show'])->name('templates.show');

        Route::middleware('permission:Add template')->group(function () {
            Route::get('templates/create', [TemplatesController::class, 'create'])->name('templates.create');
            Route::post('templates', [TemplatesController::class, 'store'])->name('templates.store');
        });

        Route::middleware('permission:Edit template')->group(function () {
            Route::get('templates/{id}/edit', [TemplatesController::class, 'edit'])->name('templates.edit');
            Route::put('templates/{id}', [TemplatesController::class, 'update'])->name('templates.update');
        });
        Route::middleware('permission:Delete template')->group(function () {
            Route::delete('templates/{id}', [TemplatesController::class, 'destroy'])->name('templates.destroy');
        });
    });

    Route::middleware('permission:View coupon')->group(function () {
        Route::get('coupon', [CouponController::class, 'index'])->name('coupon.index');

        Route::middleware('permission:Add coupon')->group(function () {
            Route::get('coupon/create', [CouponController::class, 'create'])->name('coupon.create');
            Route::post('coupon', [CouponController::class, 'store'])->name('coupon.store');
        });

        Route::get('coupon/{id}', [CouponController::class, 'show'])->name('coupon.show');

        Route::middleware('permission:Add coupon')->group(function () {
            Route::get('coupon/{id}/edit', [CouponController::class, 'edit'])->name('coupon.edit');
            Route::put('coupon/{id}', [CouponController::class, 'update'])->name('coupon.update');
        });

        Route::middleware('permission:Delete coupon')->group(function () {
            Route::delete('coupon/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');
        });
    });

    Route::middleware('permission:View FAQ')->group(function () {
        Route::get('faqs', [FAQController::class, 'index'])->name('faqs.index');
        Route::get('faqs/{id}', [FAQController::class, 'show'])->name('faqs.show');

        Route::middleware('permission:Add FAQ')->group(function () {
            Route::get('faqs/create', [FAQController::class, 'create'])->name('faqs.create');
            Route::post('faqs', [FAQController::class, 'store'])->name('faqs.store');
        });

        Route::middleware('permission:Edit FAQ')->group(function () {
            Route::get('faqs/{id}/edit', [FAQController::class, 'edit'])->name('faqs.edit');
            Route::put('faqs/{id}', [FAQController::class, 'update'])->name('faqs.update');
        });

        Route::middleware('permission:Delete FAQ')->group(function () {
            Route::delete('faqs/{id}', [FAQController::class, 'destroy'])->name('faqs.destroy');
        });
    });

    Route::middleware('permission:View page content')->group(function () {
        Route::get('page-details', [PageDetailController::class, 'index'])->name('page-details.index');
        Route::get('page-details/{id}', [PageDetailController::class, 'show'])->name('page-details.show');

        Route::middleware('permission:Edit page content')->group(function () {
            Route::get('page-details/{id}/edit', [PageDetailController::class, 'edit'])->name('page-details.edit');
            Route::put('page-details/{id}', [PageDetailController::class, 'update'])->name('page-details.update');
        });
    });

    Route::middleware('permission:View redirect link')->group(function () {
        Route::get('redirect-links', [RedirectLinkController::class, 'index'])->name('redirect-links.index');
        Route::get('redirect-links/{id}', [RedirectLinkController::class, 'show'])->name('redirect-links.show');

        Route::middleware('permission:Add redirect link')->group(function () {
            Route::get('redirect-links/create', [RedirectLinkController::class, 'create'])->name('redirect-links.create');
            Route::post('redirect-links', [RedirectLinkController::class, 'store'])->name('redirect-links.store');
        });

        Route::middleware('permission:Edit redirect link')->group(function () {
            Route::get('redirect-links/{id}/edit', [RedirectLinkController::class, 'edit'])->name('redirect-links.edit');
            Route::put('redirect-links/{id}', [RedirectLinkController::class, 'update'])->name('redirect-links.update');
        });

        Route::middleware('permission:Delete redirect link')->group(function () {
            Route::delete('redirect-links/{id}', [RedirectLinkController::class, 'destroy'])->name('redirect-links.destroy');
        });
    });

    Route::middleware('permission:View article category')->group(function () {
        Route::get('article-categories', [ArticleCategoryController::class, 'index'])->name('article-categories.index');
        Route::get('article-categories/{id}', [ArticleCategoryController::class, 'show'])->name('article-categories.show');

        Route::middleware('permission:Add article category')->group(function () {
            Route::get('article-categories/create', [ArticleCategoryController::class, 'create'])->name('article-categories.create');
            Route::post('article-categories', [ArticleCategoryController::class, 'store'])->name('article-categories.store');
        });

        Route::middleware('permission:Edit article category')->group(function () {
            Route::get('article-categories/{id}/edit', [ArticleCategoryController::class, 'edit'])->name('article-categories.edit');
            Route::put('article-categories/{id}', [ArticleCategoryController::class, 'update'])->name('article-categories.update');
        });

        Route::middleware('permission:Delete article category')->group(function () {
            Route::delete('article-categories/{id}', [ArticleCategoryController::class, 'destroy'])->name('article-categories.destroy');
        });
    });

    Route::middleware('permission:View article tag')->group(function () {
        Route::get('tags', [TagController::class, 'index'])->name('tags.index');
        Route::get('tags/{id}', [TagController::class, 'show'])->name('tags.show');

        Route::middleware('permission:Add article tag')->group(function () {
            Route::get('tags/create', [TagController::class, 'create'])->name('tags.create');
            Route::post('tags', [TagController::class, 'store'])->name('tags.store');
        });

        Route::middleware('permission:Edit article tag')->group(function () {
            Route::get('tags/{id}/edit', [TagController::class, 'edit'])->name('tags.edit');
            Route::put('tags/{id}', [TagController::class, 'update'])->name('tags.update');
        });

        Route::middleware('permission:Delete article tag')->group(function () {
            Route::delete('tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy');
        });
    });

    Route::middleware('permission:Edit header banner')->group(function () {
        Route::resource('banner', BannerController::class);
        Route::post('/update-banner-status/{id}', [BannerController::class, 'updateBannerStatus']);
    });

    Route::middleware('permission:View SEO Tag')->group(function () {
        Route::get('seo-tags', [SeoTagsController::class, 'index'])->name('seo-tags.index');
        Route::get('seo-tags/{id}', [SeoTagsController::class, 'show'])->name('seo-tags.show');

        Route::middleware('permission:Add SEO Tag')->group(function () {
            Route::get('seo-tags/create', [SeoTagsController::class, 'create'])->name('seo-tags.create');
            Route::post('seo-tags', [SeoTagsController::class, 'store'])->name('seo-tags.store');
        });

        Route::middleware('permission:Edit SEO Tag')->group(function () {
            Route::get('seo-tags/{id}/edit', [SeoTagsController::class, 'edit'])->name('seo-tags.edit');
            Route::put('seo-tags/{id}', [SeoTagsController::class, 'update'])->name('seo-tags.update');
        });

        Route::middleware('permission:Delete SEO Tag')->group(function () {
            Route::delete('seo-tags/{id}', [SeoTagsController::class, 'destroy'])->name('seo-tags.destroy');
        });
    });

    Route::middleware('permission:View Addon')->group(function () {
        Route::get('addon', [AddonController::class, 'index'])->name('addon.index');

        Route::middleware('permission:Edit Addon')->group(function () {
            Route::get('addon/{id}/edit', [AddonController::class, 'edit'])->name('addon.edit');
            Route::put('addon/{id}', [AddonController::class, 'update'])->name('addon.update');
        });
    });

    Route::resource('notification', NotificationController::class);
});

require __DIR__ . '/auth.php';