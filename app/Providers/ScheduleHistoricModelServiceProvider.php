<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Schedules\HistoricSchedule;
use App\Observers\ScheduleHistoricObserver;

class ScheduleHistoricModelServiceProvider extends ServiceProvider
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
        HistoricSchedule::observe(ScheduleHistoricObserver::class);
    }
}
