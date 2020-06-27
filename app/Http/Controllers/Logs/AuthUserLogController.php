<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\ScheduleLog;
use App\Models\Places\PlaceLog;
use App\Models\Customers\CustomerLog;
use App\UserLog;
use Auth, Lang;

class AuthUserLogController extends Controller
{
    /**
     * Returns all logs
     * 
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $limit_per_log = 10;

        $max_quantity_logs = $limit_per_log * 4;

        /**
         * Get latest logs on all
         * logs table
         * 
         */
        $schedules_log = ScheduleLog::where('user_id', $user_id)->latest()->take($limit_per_log)->get();

        $places_log = PlaceLog::where('user_id', $user_id)->latest()->take($limit_per_log)->get();

        $customers_log = CustomerLog::where('user_id', $user_id)->latest()->take($limit_per_log)->get();

        $users_log = UserLog::where('user_action_id', $user_id)->latest()->take($limit_per_log)->get();

        $quantity_logs = count($schedules_log) + count($places_log) + count($customers_log) + count($users_log);

        $user_name = Lang::get('You'); 

        $title = Lang::get('Listing your latest') . " " . $quantity_logs . " " . Lang::get('system activities - max') . ":" . " " . $max_quantity_logs;

        $noDataMessage = Lang::get('You have not yet performed any activity on the system');
        
        return view('app.dashboard.logs.index', [
            'schedules_log' => $schedules_log, 'places_log'    => $places_log,
            'customers_log' => $customers_log, 'quantity_logs' => $quantity_logs,
            'users_log'     => $users_log,     'max_quantity_logs' => $max_quantity_logs,
            'user_name'     => $user_name,     'title' => $title,
            'noDataMessage' => $noDataMessage, 'user' => Auth::user()
        ]);
    }
}
