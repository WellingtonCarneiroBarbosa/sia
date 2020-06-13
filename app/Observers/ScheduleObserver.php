<?php

namespace App\Observers;

use Illuminate\Support\Facades\Notification;
use App\Notifications\Schedule\CanceledScheduleNotification;
use App\Notifications\Schedule\RescheduledNotification;
use App\Notifications\Schedule\ScheduledNotification;
use App\Notifications\Schedule\UpdatedScheduleNotification;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\ScheduleLog;
use App\User;

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

        ScheduleLog::create($log);

        /**
         * Convert datetime object
         * to string
         * 
         */
        $schedule['start'] = date_format($schedule['start'], 'Y-m-d H:i:s');
        $schedule['end']   = date_format($schedule['end'], 'Y-m-d H:i:s');

        $schedule['user'] = getAuthUserFirstName();

        /**Notify all users */
        $users = User::where('id', '!=', auth()->user()->id)->get();
        Notification::send($users, new ScheduledNotification($schedule));
       
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
        
        ScheduleLog::create($log);

        /**
         * Convert datetime object
         * to string
         * 
         */
        $schedule['start'] = date_format($schedule['start'], 'Y-m-d H:i:s');
        $schedule['end']   = date_format($schedule['end'], 'Y-m-d H:i:s');

        /**
         * Verify if the 
         * schedule date
         * was updated
         * 
         */
        if($schedule['start'] != $schedule->getOriginal('start') || $schedule['end'] != $schedule->getOriginal('end'))
        {
            /**Notify all users */   
            $schedule['user'] = getAuthUserFirstName();

            $users = User::where('id', '!=', auth()->user()->id)->get();
            Notification::send($users, new UpdatedScheduleNotification($schedule));   
        }
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

        ScheduleLog::create($log);

        /**Notify all users */
        $schedule['user'] = getAuthUserFirstName();

        $users = User::where('id', '!=', auth()->user()->id)->get();
        Notification::send($users, new CanceledScheduleNotification($schedule));
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

        ScheduleLog::create($log);

        /**
         * when a schedule is restored,
         * it creates an unnecessary
         * update log, here it removes
         * this log
         * 
         */
        ScheduleLog::where('action', 2)->where('created_at', $createLog['created_at'])->delete();

        /**Notify all users */
        $schedule['user'] = getAuthUserFirstName();

        $users = User::where('id', '!=', auth()->user()->id)->get();
        Notification::send($users, new RescheduledNotification($schedule));
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

        ScheduleLog::create($log);
    }
}
