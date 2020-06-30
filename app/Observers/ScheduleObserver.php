<?php

namespace App\Observers;

use Illuminate\Support\Facades\Notification;
use App\Notifications\Schedule\CanceledScheduleNotification;
use App\Notifications\Schedule\RescheduledNotification;
use App\Notifications\Schedule\ScheduledNotification;
use App\Notifications\Schedule\UpdatedScheduleNotification;
use App\Notifications\NotifyUser;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\ScheduleLog;
use App\User;
use App\Events\Action\NewAction;
use Lang;

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
        $users = NotifyUser::getUsersToNotifyExceptAuthUser();
        Notification::send($users, new ScheduledNotification($schedule));

        $message = $schedule['user'] . " " . Lang::get('registered a new appointment for') . " " . dateTimeBrazilianFormat($schedule['start']) . " " . Lang::get('and') . " " . dateTimeBrazilianFormat($schedule['end']);
        
        $user_id = auth()->user()->id;
        
        /**
         * Notify online users
         * 
         */
        event(new NewAction(['user_id' => $user_id, 'message' => $message]));
    }

    /**
     * Handle the schedule "updated" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function updated(Schedule $schedule)
    {
        /**Impede que o método seja utilizado caso a coluna deleted_at seja alterada */
        if(! $schedule->isDirty($schedule->getDeletedAtColumn()) && count($schedule->getDirty()) != 1){
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

                $users = NotifyUser::getUsersToNotifyExceptAuthUser();
                Notification::send($users, new UpdatedScheduleNotification($schedule));   
            }
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
        /**
         * Impede que crie o log caso esteja sendo realizado o metodo
         * force delete
         * 
         */
        if (! $schedule->isForceDeleting()) {
            $log     =
            [
                'schedule_id'   => $schedule->id,
                'user_id'       => auth()->user()->id,
                'action'        => '3'
            ];

            ScheduleLog::create($log);

            /**Notify all users */
            $schedule['user'] = getAuthUserFirstName();

            $users = NotifyUser::getUsersToNotifyExceptAuthUser();
            Notification::send($users, new CanceledScheduleNotification($schedule));
        }
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

        /**Notify all users */
        $schedule['user'] = getAuthUserFirstName();

        $users = NotifyUser::getUsersToNotifyExceptAuthUser();
        Notification::send($users, new RescheduledNotification($schedule));
    }

    /**
     * Handle the schedule "force deleted" event.
     *
     * @param  \App\Models\Schedules\Schedule  $schedule
     * @return void
     */
    public function forceDeleted(Schedule $schedule)
    {
        $log     =
        [
            'schedule_id'   => $schedule->id,
            'user_id'       => auth()->user()->id,
            'action'        => '5'
        ];

        ScheduleLog::create($log);

        /**Notify all users */
    }
}
