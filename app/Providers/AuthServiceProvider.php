<?php

namespace App\Providers;

use App\Services\Md5Hasher;
use Illuminate\Hashing\HashManager;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('hash.driver.md5', function () {
            return new Md5Hasher;
        });

        $this->app->extend('hash', function ($hashManager, $app) {
            if ($hashManager instanceof HashManager) {
                $hashManager->extend('md5', function () use ($app) {
                    return $app->make('hash.driver.md5');
                });
            }

            return $hashManager;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
