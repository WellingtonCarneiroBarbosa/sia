<?php

namespace App\Observers;

use App\Models\Customers\Customer;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\HistoricSchedule;

class CustomerObserver
{
    /**
     * Handle the customer "created" event.
     *
     * @param  \App\Models\Customers\Customer  $customer
     * @return void
     */
    public function created(Customer $customer)
    {
        //
    }

    /**
     * Handle the customer "updated" event.
     *
     * @param  \App\Models\Customers\Customer  $customer
     * @return void
     */
    public function updated(Customer $customer)
    {
        //
    }

    /**
     * Handle the customer "deleted" event.
     *
     * @param  \App\Models\Customers\Customer  $customer
     * @return void
     */
    public function deleted(Customer $customer)
    {
        $expiredSchedules = Schedule::withTrashed()->where('place_id', null)->orWhere('customer_id', $customer->id)->get();

        $hasExpiredSchedules = hasData($expiredSchedules);

        if($hasExpiredSchedules){
            foreach($expiredSchedules as $schedule){
                $data = $schedule->getAttributes();
                $data['schedule_id'] = $data['id'];
                HistoricSchedule::create($data);
                Schedule::where('id', $data["id"])->forceDelete();
            }
        }
    }
}
