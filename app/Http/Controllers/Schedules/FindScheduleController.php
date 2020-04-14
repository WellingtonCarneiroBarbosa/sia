<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Models\Places\Place;
use Illuminate\Support\Facades\Lang;
use DB;

class FindScheduleController extends Controller
{
    /**
     * Find a schedule by date range
     * 
     */

    public function dateRange(Request $request){
        $data       = $request->except('_token');

        $start_date = $data['start_date'];
        $end_date   = $data['end_date'];

        /**
         * get all the schedules by data range
         * 
         */
        $schedules = Schedule::with('schedulingCustomer')
                    ->with('schedulingPlace')
                    ->where('start_date', $start_date)
                    ->orWhere('end_date', $end_date)
                    ->orWhereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date',   [$start_date, $end_date])
                    ->paginate(config('app.paginate_limit'));

        $hasSchedules = hasData($schedules);

        if(!$hasSchedules){
            $response = Lang::get(" We didn't find any schedule");
        }else{
            $response = null;
        }
        
        return view('app.dashboard.schedules.find', 
        [
            'schedules' => $schedules, 'hasSchedules' => $hasSchedules,
            'response'  => $response,  'data'         => $data
        ]);
    }
}
