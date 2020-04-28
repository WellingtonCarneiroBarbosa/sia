<?php

namespace App\Http\Controllers\Places;

use DB;
use App\Models\Places\Place;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class FindPlacesController extends Controller
{
    public function findPerDateRange(Request $request){
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
        $schedules = Schedule::where(DB::raw('DATE(start)'), '>=', $data['start'])
        ->where(DB::raw('DATE(end)'),   '<=', $data['end'])
        ->orWhere(DB::raw('DATE(start)'), $data['start'])
        ->orWhere(DB::raw('DATE(end)'), $data['end'])
        ->with('schedulingCustomer')
        ->with('schedulingPlace')
        ->paginate(config('app.paginate_limit'));

        $hasSchedules = hasData($schedules);

        if(!$hasSchedules){
            return redirect()->back()->with(['status' => Lang::get(" This place is avaible on those dates")]);
        }else{
            $response = Lang::get(" This location is unavailable on those dates:");
        }

        $places         = Place::get();

        $hasPlaces      = hasData($places);

        $now = date('Y-m-d H:i:s');

        return view('app.dashboard.places.availability', 
        [
        'schedules' => $schedules, 'hasSchedules' => $hasSchedules,
        'response'  => $response,  'data'         => $data,
        'places'    => $places,    'hasPlaces'    => $hasPlaces,
        'now'       => $now
        ]);
    }
}
