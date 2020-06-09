<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Schedules\Schedule;
use App\Observers\ScheduleObserver;

class ScheduleModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Schedule::observe(ScheduleObserver::class);
    }
}
