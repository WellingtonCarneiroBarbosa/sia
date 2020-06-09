<?php

namespace App\Observers;

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

        $createLog = UserLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**Notify all users */
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $log     =
        [
            'user_id'        => $user->id,
            'user_action_id' => auth()->user()->id,
            'action'         => '2'
        ];

        $createLog = UserLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**Notify all users */
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

        $createLog = UserLog::create($log);

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**Notify all users */
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

        if(!$createLog){
           /**Notify the auth()->user() */
        }

        /**
         * when a user is restored,
         * it creates an unnecessary
         * update log, here it removes
         * this log
         * 
         */
        UserLog::where('action', 2)->where('created_at', $createLog['created_at'])->delete();

        /**Notify all users */
    }
}
