<?php

namespace App\Observers;

use App\Models\Schedules\Schedule;
use App\Models\Schedules\ScheduleLog;

/**
 * ====================================
 * LOGS CAPTION
 *
 * 1 == create
 * 2 == update
 * 3 == delete
 * 4 == restore
 * 5 == forceDelete
 * 6 == moved to historic
 * ====================================
 * 
 */

class ScheduleObserver
{
    /**
     * Handle the schedule "created" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function created(Schedule $schedule)
    {
        //
    }

    /**
     * Handle the schedule "updated" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function updated(Schedule $schedule)
    {
        //
    }

    /**
     * Handle the schedule "deleted" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function deleted(Schedule $schedule)
    {
        //
    }

    /**
     * Handle the schedule "restored" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function restored(Schedule $schedule)
    {
        //
    }

    /**
     * Handle the schedule "force deleted" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function forceDeleted(Schedule $schedule)
    {
        //
    }
}
