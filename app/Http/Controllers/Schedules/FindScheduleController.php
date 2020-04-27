<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Models\Places\Place;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Datetime;
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
        $data = $request->except('_token');

        $data['start'] = dateAmericanFormat($data['start']);
        $data['end']   = dateAmericanFormat($data['end']);

        $validator = Validator::make($data, [
            'start'   => ['required', 'date', 'before_or_equal:end',  config("app.min_schedule_date"), config("app.max_schedule_date")],
            'end'     => ['required', 'date', 'after_or_equal:start', config("app.min_schedule_date"), config("app.max_schedule_date")],
        ], $messages);
      

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        /**
         * validate completed
         * 
         */


        /**
         * get all the schedules by data range
         * 
         */
        $schedules = Schedule::where(DB::raw('DATE(start)'), '>=', $data['start'])
                             ->where(DB::raw('DATE(end)'),   '<=', $data['end'])
                             ->orWhere(DB::raw('DATE(start)'), $data['start'])
                             ->orWhere(DB::raw('DATE(end)'), $data['end'])
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
        $data = $request->except('_token');

        $data['start'] = dateAmericanFormat($data['start']);
        $data['end']   = dateAmericanFormat($data['end']);

        $validator = Validator::make($data, [
            'start'   => ['required', 'date', 'before_or_equal:end',  config("app.min_schedule_date"), config("app.max_schedule_date")],
            'end'     => ['required', 'date', 'after_or_equal:start', config("app.min_schedule_date"), config("app.max_schedule_date")],
        ], $messages);
      

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        /**
         * validate completed
         * 
         */
        
        /**
         * get all the schedules by data range
         * and specific place
         * 
         */
        
        $schedules = Schedule::where(DB::raw('DATE(start)'), '>=', $data['start'])
        ->where(DB::raw('DATE(end)'),   '<=', $data['end'])
        ->where('place_id', $data['place_id'])
        ->orWhere(DB::raw('DATE(start)'), $data['start'])
        ->where('place_id', $data['place_id'])
        ->orWhere(DB::raw('DATE(end)'), $data['end'])
        ->where('place_id', $data['place_id'])
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
        /**
         * Custom messages for 
         * exceptions
         * 
         */
        $messages  = [
            'date'   => Lang::get('The date entered is not a valid date')
        ];

        /**
         * Validate request
         * 
         */
        $data = $request->except('_token');

        $data['date'] = dateAmericanFormat($data['date']);

        $validator = Validator::make($data, [
            'date'   => ['required', 'date', config("app.min_schedule_date"), config("app.max_schedule_date")],
        ], $messages);
      

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        /**
         * validate completed
         * 
         */
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
