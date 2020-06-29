<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Lang;

class EmailConfigurationController extends Controller
{
    public function __construct(User $user) 
    {
        $this->user = $user;
    }

    public function emailNotification(Request $request)
    {
        try {
            if(! isset($request['dont_email_notification']))
            {
                $data['dont_email_notification'] = 1;

                $message = Lang::get('Email notifications disabled');
            } else {
                $data['dont_email_notification'] = null;

                $message = Lang::get('Email notifications enabled');
            }

            $userID = Auth()->user()->id;

            $this->user->findOrFail($userID)->update($data);

            return redirect()->back()->with(['status' => $message]);

        } catch (\Exception $e) {
            if(config('app.debug'))
            {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }

            return redirect()->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }
    }
}
