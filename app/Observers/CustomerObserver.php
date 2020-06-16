<?php

namespace App\Observers;

use Illuminate\Support\Facades\Notification;
use App\Models\Customers\Customer;
use App\Models\Customers\CustomerLog;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\HistoricSchedule;
use App\Notifications\Customer\DeletedCustomerNotification;
use App\Notifications\NotifyUser;
use App\User;

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

        CustomerLog::create($log);
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

        CustomerLog::create($log);
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

        /**
         * Notify all users
         * 
         */
        $customer['user'] = getAuthUserFirstName();

        $users = NotifyUser::getUsersToNotifyExceptAuthUser();
        Notification::send($users, new DeletedCustomerNotification($customer));
    }
}
