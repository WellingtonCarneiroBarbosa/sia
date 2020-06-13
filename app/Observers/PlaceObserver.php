<?php

namespace App\Observers;

use Illuminate\Support\Facades\Notification;
use App\Models\Places\Place;
use App\Models\Places\PlaceLog;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\HistoricSchedule;
use App\Notifications\Place\DeletedPlaceNotification;
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

class PlaceObserver
{
    /**
     * Handle the place "created" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function created(Place $place)
    {
        $log     =
        [
            'place_id'      => $place->id,
            'user_id'       => auth()->user()->id,
            'action'        => '1'
        ];

        PlaceLog::create($log);
    }

    /**
     * Handle the place "updated" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function updated(Place $place)
    {
        $log     =
        [
            'place_id'      => $place->id,
            'user_id'       => auth()->user()->id,
            'action'        => '2'
        ];

        PlaceLog::create($log);
    }

    /**
     * Handle the place "deleted" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function deleted(Place $place)
    {
        $log     =
        [
            'place_id'      => null,
            'user_id'       => auth()->user()->id,
            'action'        => '3'
        ];

        PlaceLog::create($log);

        /**
         * Move a schedule
         * to historic table
         * and delete from
         * schedules table
         * 
         */
        $expiredSchedules = Schedule::withTrashed()->where('place_id', null)->orWhere('customer_id', null)->get();

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
        $place['user'] = getAuthUserFirstName();

        $users = User::where('id', '!=', auth()->user()->id)->get();
        Notification::send($users, new DeletedPlaceNotification($place));
    }
}
