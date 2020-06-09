<?php

namespace App\Observers;

use App\Models\Places\Place;
use App\Models\Places\PlaceLog;
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

        $createLog = PlaceLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**Notify the auth()->user() */
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

        $createLog = PlaceLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**Notify the auth()->user() */
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

        $createLog = PlaceLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**Notify the auth()->user() */

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
    }
}
