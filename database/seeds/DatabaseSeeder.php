<?php

use Illuminate\Database\Seeder;
use \Illuminate\Database\Eloquent\FactoryBuilder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            /**
             * AdminSeeder::class,
             * UserSeeder::class,
             */
            PlaceSeeder::class,
        ]);

      

        FactoryBuilder::macro('withoutEvents', function () {
            $this->class::flushEventListeners();
        
            return $this;
        });

        factory(App\Models\Customers\Customer::class, 50)->withoutEvents()->create();
        factory(App\Models\Schedules\Schedule::class, 100)->withoutEvents()->create();
    }
}
