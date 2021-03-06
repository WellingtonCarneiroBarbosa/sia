<?php 

namespace App\Notifications;

use App\User;

class NotifyUser {

    public static function getUsersToNotifyExceptAuthUser() {
        $users = User::where('id', '!=', auth()->user()->id)->where('email_verified_at', '!=', null)
                ->where('profile_completed_at', '!=', null)->where('dont_email_notification', null)->get();

        return $users;
    }

}