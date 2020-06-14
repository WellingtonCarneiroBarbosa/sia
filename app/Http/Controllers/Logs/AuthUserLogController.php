<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\ScheduleLog;
use App\Models\Places\PlaceLog;
use App\Models\Customers\CustomerLog;
use Auth;

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

        $max_quantity_logs = $limit_per_log * 3;

        /**
         * Get latest logs on all
         * logs table
         * 
         */
        $schedules_log = ScheduleLog::where('user_id', $user_id)->latest()->take($limit_per_log)->get();

        $places_log = PlaceLog::where('user_id', $user_id)->latest()->take($limit_per_log)->get();

        $customers_log = CustomerLog::where('user_id', $user_id)->latest()->take($limit_per_log)->get();

        $quantity_logs = count($schedules_log) + count($places_log) + count($customers_log);

        return view('app.dashboard.logs.auth.index', [
            'schedules_log' => $schedules_log, 'places_log'    => $places_log,
            'customers_log' => $customers_log, 'quantity_logs' => $quantity_logs,
            'max_quantity_logs' => $max_quantity_logs,
        ]);
    }
}
