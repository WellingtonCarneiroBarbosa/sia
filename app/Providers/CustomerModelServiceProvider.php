<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Customers\Customer;
use App\Observers\CustomerObserver;

class CustomerModelServiceProvider extends ServiceProvider
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
        Customer::observe(CustomerObserver::class);
    }
}
