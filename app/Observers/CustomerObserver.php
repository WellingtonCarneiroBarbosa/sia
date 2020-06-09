<?php

namespace App\Observers;

use App\Models\Customers\Customer;
use App\Models\Customers\CustomerLog;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\HistoricSchedule;

/**
 * ====================================
 * LOGS CAPTION
 *
 * 1 == create
 * 2 == update
 * 3 == delete
 * ====================================
 * 
 */

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
        $log     =
        [
            'customer_id'   => $customer->id,
            'user_id'       => auth()->user()->id,
            'action'        => '1'
        ];

        $createLog = CustomerLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }
        
        /**Notify all users */
    }

    /**
     * Handle the customer "updated" event.
     *
     * @param  \App\Models\Customers\Customer  $customer
     * @return void
     */
    public function updated(Customer $customer)
    {
        $log     =
        [
            'customer_id'   => $customer->id,
            'user_id'       => auth()->user()->id,
            'action'        => '2'
        ];

        $createLog = CustomerLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }
        
        /**Notify all users */
    }

    /**
     * Handle the customer "deleted" event.
     *
     * @param  \App\Models\Customers\Customer  $customer
     * @return void
     */
    public function deleted(Customer $customer)
    {
        $log     =
        [
            'customer_id'   => $customer->id,
            'user_id'       => auth()->user()->id,
            'action'        => '3'
        ];

        $createLog = CustomerLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }
        
        /**Notify all users */

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
