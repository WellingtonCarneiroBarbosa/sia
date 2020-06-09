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
 * 5 == forceDelete (move to historic)
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
        $log     =
        [
            'schedule_id'   => $schedule->id,
            'user_id'       => auth()->user()->id,
            'action'        => '1'
        ];

        $createLog = ScheduleLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**Notify all users */
    }

    /**
     * Handle the schedule "updated" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function updated(Schedule $schedule)
    {
        $log     =
        [
            'schedule_id'   => $schedule->id,
            'user_id'       => auth()->user()->id,
            'action'        => '2'
        ];

        $createLog = ScheduleLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**Notify all users */
    }

    /**
     * Handle the schedule "deleted" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function deleted(Schedule $schedule)
    {
        $log     =
        [
            'schedule_id'   => $schedule->id,
            'user_id'       => auth()->user()->id,
            'action'        => '3'
        ];

        $createLog = ScheduleLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**Notify all users */
    }

    /**
     * Handle the schedule "restored" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function restored(Schedule $schedule)
    {
        $log     =
        [
            'schedule_id'   => $schedule->id,
            'user_id'       => auth()->user()->id,
            'action'        => '4'
        ];

        $createLog = ScheduleLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**
         * when a schedule is restored,
         * it creates an unnecessary
         * update log, here it removes
         * this log
         * 
         */
        ScheduleLog::where('action', 2)->where('created_at', $createLog['created_at'])->delete();

        /**Notify all users */
    }

    /**
     * Handle the schedule "force deleted" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function forceDeleted()
    {
        $log     =
        [
            'schedule_id'   => null,
            'user_id'       => auth()->user()->id,
            'action'        => '5'
        ];

        $createLog = ScheduleLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**Notify all users */
    }
}
