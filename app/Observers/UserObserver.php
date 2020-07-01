<?php

namespace App\Observers;

use Illuminate\Support\Facades\Notification;
use App\Notifications\User\DisabledUserNotification;
use App\Notifications\User\EnabledUserNotification;
use App\User;
use App\UserLog;

/**
 * ====================================
 * LOGS CAPTION
 *
 * 1 == create
 * 2 == update - role_id
 * 3 == disable
 * 4 == enable
 * ====================================
 * 
 */

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $log     =
        [
            'user_id'        => $user->id,
            'user_action_id' => auth()->user()->id,
            'action'         => '1'
        ];

        UserLog::create($log);

    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        /**Impede que o método seja utilizado caso a coluna password seja alterada */
        if(! $user->isDirty($user->getAuthPassword())){
            $log     =
            [
                'user_id'        => $user->id,
                'user_action_id' => auth()->user()->id,
                'action'         => '2'
            ];

            UserLog::create($log);
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $log     =
        [
            'user_id'        => $user->id,
            'user_action_id' => auth()->user()->id,
            'action'         => '3'
        ];

        UserLog::create($log);

        /**Notify the disabled user */
        Notification::send($user, new DisabledUserNotification());
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        $log     =
        [
            'user_id'        => $user->id,
            'user_action_id' => auth()->user()->id,
            'action'         => '4'
        ];

        $createLog = UserLog::create($log);

        /**
         * when a user is restored,
         * it creates an unnecessary
         * update log, here it removes
         * this log
         * 
         */
        UserLog::where('action', 2)->where('created_at', $createLog['created_at'])->delete();

        /**Notify the enabled user */
        Notification::send($user, new EnabledUserNotification($user));
    }
}
