<?php

namespace App\Providers;

use App\Domain\Repository\DiaryRepository;
use App\Domain\Repository\DiaryRepositoryInterface;
use App\Domain\Repository\DiarySegmentRepository;
use App\Domain\Repository\DiarySegmentRepositoryInterface;
use App\Domain\Repository\HashTagRepository;
use App\Domain\Repository\HashTagRepositoryInterface;
use App\Domain\Repository\SegmentRepository;
use App\Domain\Repository\SegmentRepositoryInterface;
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

        $this->app->bind(
            DiarySegmentRepositoryInterface::class,
            DiarySegmentRepository::class
        );

        $this->app->bind(
            HashTagRepositoryInterface::class,
            HashTagRepository::class
        );

        $this->app->bind(
            SegmentRepositoryInterface::class,
            SegmentRepository::class
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
