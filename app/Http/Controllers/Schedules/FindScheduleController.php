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
        /**
         * Custom messages for 
         * exceptions
         * 
         */
        $messages  = [
            'before_or_equal' => Lang::get('The date entered is not a valid date'),
            'after_or_equal'  => Lang::get('The date entered is not a valid date'),
            'date'   => Lang::get('The date entered is not a valid date')
        ];

        /**
         * Validate request
         * 
         */
        $request->validate([
            'start'          => ['required', 'date', 'before_or_equal:end',  config("app.min_schedule_date"), config("app.max_schedule_date")],
            'end'            => ['required', 'date', 'after_or_equal:start', config("app.min_schedule_date"), config("app.max_schedule_date")],
        ], $messages);

        /**
         * Validated data
         * 
         */
        $data       = $request->except('_token');

        $data['start'] = dateAmericanFormat($data['start']);
        $data['end']   = dateAmericanFormat($data['end']);

        /**
         * get all the schedules by data range
         * 
         */
        $schedules = Schedule::where(DB::raw('DATE(start)'), '>=', $data['start'])
                             ->where(DB::raw('DATE(end)'),   '<=', $data['end'])
                             ->with('schedulingCustomer')
                             ->with('schedulingPlace')
                             ->paginate(config('app.paginate_limit'));

        $hasSchedules = hasData($schedules);

        if(!$hasSchedules){
            $response = Lang::get(" We didn't find any schedule");
        }else{
            $response = null;
        }

        $places         = Place::get();

        $hasPlaces      = hasData($places);
        
        return view('app.dashboard.schedules.find', 
        [
            'schedules' => $schedules, 'hasSchedules' => $hasSchedules,
            'response'  => $response,  'data'         => $data,
            'places'    => $places,    'hasPlaces'    => $hasPlaces
        ]);
    }

    /**
     * Find a schedule by date range and
     * any place
     * 
     */
    public function dateRangeAndPlace(Request $request){
        $data       = $request->except('_token');

        /**
         * Custom messages for 
         * exceptions
         * 
         */
        $messages  = [
            'before_or_equal' => Lang::get('The date entered is not a valid date'),
            'after_or_equal'  => Lang::get('The date entered is not a valid date'),
            'date'   => Lang::get('The date entered is not a valid date')
        ];

        /**
         * Validate request
         * 
         */
        $request->validate([
            'start'          => ['required', 'date', 'before_or_equal:end',  config("app.min_schedule_date"), config("app.max_schedule_date")],
            'end'            => ['required', 'date', 'after_or_equal:start', config("app.min_schedule_date"), config("app.max_schedule_date")],
        ], $messages);

        /**
         * Validated data
         * 
         */
        $data       = $request->except('_token');

        $data['start'] = dateAmericanFormat($data['start']);
        $data['end']   = dateAmericanFormat($data['end']);

        /**
         * get all the schedules by data range
         * and specific place
         * 
         */
        $schedules = Schedule::where(DB::raw('DATE(start)'), '>=', $data['start'])
                             ->where(DB::raw('DATE(end)'),   '<=', $data['end'])
                             ->where('place_id', $data['place_id'])
                             ->with('schedulingCustomer')
                             ->with('schedulingPlace')
                             ->paginate(config('app.paginate_limit'));

        $hasSchedules = hasData($schedules);

        if(!$hasSchedules){
            $response = Lang::get(" We didn't find any schedule");
        }else{
            $response = null;
        }
        

        $places         = Place::get();

        $hasPlaces      = hasData($places);
        
        return view('app.dashboard.schedules.find', 
        [
            'schedules' => $schedules, 'hasSchedules' => $hasSchedules,
            'response'  => $response,  'data'         => $data,
            'places'    => $places,    'hasPlaces'    => $hasPlaces
        ]);
    }

    /**
     * Find a schedule by specific date
     * 
     */
    public function uniqueDate(Request $request){
        $data       = $request->except('_token');

        /**
         * Custom messages for 
         * exceptions
         * 
         */
        $messages  = [
            'before' => Lang::get('The date entered is not a valid date'),
            'after'  => Lang::get('The date entered is not a valid date'),
            'date'   => Lang::get('The date entered is not a valid date')
        ];
        /**
         * Validate request
         * 
         */

        $request->validate([
            'date'          => ['required', 'date', config("app.min_schedule_date"), config("app.max_schedule_date")],
        ], $messages);

        /**
         * Validated data
         * 
         */
        $data       = $request->except('_token');

        $data['date'] = dateAmericanFormat($data['date']);

        /**
         * Select where start or
         * end_date === $anyDate
         * 
         */
        $schedules = Schedule::where(DB::raw('DATE(start)'), $data['date'])
                             ->orWhere(DB::raw('DATE(end)'), $data['date'])
                             ->with('schedulingCustomer')
                             ->with('schedulingPlace')
                             ->paginate(config('app.paginate_limit'));

        $hasSchedules = hasData($schedules);

        if(!$hasSchedules){
            $response = Lang::get(" We didn't find any schedule");
        }else{
            $response = null;
        }
    
   
        $places         = Place::get();

        $hasPlaces      = hasData($places);
        
        return view('app.dashboard.schedules.find', 
        [
            'schedules' => $schedules, 'hasSchedules' => $hasSchedules,
            'response'  => $response,  'data'         => $data,
            'places'    => $places,    'hasPlaces'    => $hasPlaces
        ]);
    }
}
