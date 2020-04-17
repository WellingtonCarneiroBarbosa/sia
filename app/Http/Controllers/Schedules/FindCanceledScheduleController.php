<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use Lang;

class FindCanceledScheduleController extends Controller
{
    /**
     * Find a canceled schedule
     * by date range
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

        /***
         * Select where start_date or end_date === $anyDate
         * or start_date or end_date between $date01 $date02
         * 
         */
        $schedules = Schedule::with('schedulingCustomer')
                    ->with('schedulingPlace')
                    ->WhereBetween('start_date', [$start_date, $end_date])
                    ->onlyTrashed()
                    ->orWhereBetween('end_date',   [$start_date, $end_date])
                    ->onlyTrashed()
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

    /**
     * Find a canceled schedule
     * by date range and
     * any place
     * 
     */
    public function dateRangeAndPlace(Request $request){
        $data       = $request->except('_token');

        $start_date = $data['start_date'];
        $end_date   = $data['end_date'];
        $place      = $data['place_id'];

        /**
         * get all the schedules by data range
         * 
         */

        /***
         * Select where start_date or end_date === $anyDate
         * or start_date or end_date between $date01 $date02
         * and place === $place
         * 
         */
        $schedules = Schedule::with('schedulingCustomer')
                    ->with('schedulingPlace')
                    ->where('place_id', $place)
                    ->WhereBetween('start_date', [$start_date, $end_date])
                    ->onlyTrashed()
                    ->orWhereBetween('end_date',   [$start_date, $end_date])
                    ->onlyTrashed()
                    ->where('place_id', $place)
                    ->onlyTrashed()
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

    /**
     * Find a canceled schedule by
     * specific date
     * 
     */
    public function uniqueDate(Request $request){
        $data       = $request->except('_token');

        $date       = $data['date'];

        /**
         * get all the schedules by unique date
         * 
         */

        /**
         * Select where start_date or end_date === $date
         * 
         */
        $schedules = Schedule::with('schedulingCustomer')
                    ->with('schedulingPlace')
                    ->where('start_date', $date)
                    ->onlyTrashed()
                    ->orWhere('end_date', $date)
                    ->onlyTrashed()
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
