<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Places\Place;
use App\Observers\PlaceObserver;

class PlaceModelServiceProvider extends ServiceProvider
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
        Place::observe(PlaceObserver::class);   
    }
}
