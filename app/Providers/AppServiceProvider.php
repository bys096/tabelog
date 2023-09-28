<?php

namespace App\Providers;

use App\Domain\Repository\DiaryRepository;
use App\Domain\Repository\DiaryRepositoryInterface;
use Fluent\Logger\FluentLogger;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Domain\Repository\UserRepositoryInterface::class,
            \App\Domain\Repository\UserRepository::class
        );

        $this->app->bind(
            DiaryRepositoryInterface::class,
            DiaryRepository::class
        );

        $this->app->singleton(FluentLogger::class, function () {
            return new FluentLogger('localhost', 24224);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
