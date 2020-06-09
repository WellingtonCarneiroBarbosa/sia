<?php

namespace App\Observers;

use App\Models\Places\Place;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\HistoricSchedule;

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
        //
    }

    /**
     * Handle the place "updated" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function updated(Place $place)
    {
        //
    }

    /**
     * Handle the place "deleted" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function deleted(Place $place)
    {
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

    /**
     * Handle the place "restored" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function restored(Place $place)
    {
        //
    }

    /**
     * Handle the place "force deleted" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function forceDeleted(Place $place)
    {
        //
    }
}
