<?php

namespace App\Observers;

use App\Models\Schedules\HistoricSchedule;

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
        //
    }

    /**
     * Handle the schedule historic "updated" event.
     *
     * @param  \App\Models\Schedules\HistoricSchedule  $historicSchedule
     * @return void
     */
    public function updated(HistoricSchedule $historicSchedule)
    {
        //
    }

    /**
     * Handle the schedule historic "deleted" event.
     *
     * @param  \App\Models\Schedules\HistoricSchedule  $historicSchedule
     * @return void
     */
    public function deleted(HistoricSchedule $historicSchedule)
    {
        //
    }

    /**
     * Handle the schedule historic "restored" event.
     *
     * @param  \App\Models\Schedules\HistoricSchedule  $historicSchedule
     * @return void
     */
    public function restored(HistoricSchedule $historicSchedule)
    {
        //
    }

    /**
     * Handle the schedule historic "force deleted" event.
     *
     * @param  \App\Models\Schedules\HistoricSchedule  $historicSchedule
     * @return void
     */
    public function forceDeleted(HistoricSchedule $historicSchedule)
    {
        //
    }
}
