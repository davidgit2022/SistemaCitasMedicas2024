<?php

namespace App\Providers;

use App\Interfaces\ScheduleServiceInterface;
use App\Services\ScheduleInterfaceService;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ScheduleServiceInterface::class, ScheduleInterfaceService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
