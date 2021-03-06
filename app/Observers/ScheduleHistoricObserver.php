<?php

namespace App\Observers;

use App\Models\Schedules\HistoricSchedule;
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
class ScheduleHistoricObserver
{
    /**
     * Handle the schedule historic "created" event.
     *
     * @param  \App\Models\Schedules\HistoricSchedule  $historicSchedule
     * @return void
     */
    public function created(HistoricSchedule $historicSchedule)
    {
        /**
         * NOTIFY ALL USERS
         * 
         */
    }
}
