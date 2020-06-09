<?php

namespace App\Observers;

use App\Models\Schedules\ScheduleHistoric;

class ScheduleHistoricObserver
{
    /**
     * Handle the schedule historic "created" event.
     *
     * @param  \App\Models\Schedules\ScheduleHistoric  $scheduleHistoric
     * @return void
     */
    public function created(ScheduleHistoric $scheduleHistoric)
    {
        //
    }

    /**
     * Handle the schedule historic "updated" event.
     *
     * @param  \App\Models\Schedules\ScheduleHistoric  $scheduleHistoric
     * @return void
     */
    public function updated(ScheduleHistoric $scheduleHistoric)
    {
        //
    }

    /**
     * Handle the schedule historic "deleted" event.
     *
     * @param  \App\Models\Schedules\ScheduleHistoric  $scheduleHistoric
     * @return void
     */
    public function deleted(ScheduleHistoric $scheduleHistoric)
    {
        //
    }

    /**
     * Handle the schedule historic "restored" event.
     *
     * @param  \App\Models\Schedules\ScheduleHistoric  $scheduleHistoric
     * @return void
     */
    public function restored(ScheduleHistoric $scheduleHistoric)
    {
        //
    }

    /**
     * Handle the schedule historic "force deleted" event.
     *
     * @param  \App\Models\Schedules\ScheduleHistoric  $scheduleHistoric
     * @return void
     */
    public function forceDeleted(ScheduleHistoric $scheduleHistoric)
    {
        //
    }
}
