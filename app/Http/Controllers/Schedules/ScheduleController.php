<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\ScheduleLog;
use App\Models\Places\Place;
use App\Models\Customers\Customer;
use Illuminate\Support\Facades\Lang;
use DB;

class ScheduleController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $places         = Place::get();
        $customers      = Customer::get();

        $hasPlaces      = hasData($places);
        $hasCustomers   = hasData($customers);

        return view('app.dashboard.schedules.create', 
        [
            'places'    => $places,     'hasPlaces'    => $hasPlaces,
            'customers' => $customers,  'hasCustomers' => $hasCustomers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /**
         * Custom messages for 
         * exceptions
         * 
         */
        $messages  = [
            'before' => Lang::get('The start date and time must be before the end date and time'),
            'after'  => Lang::get('The end date and time must be after the start date and time'),
            'date'   => Lang::get('The date entered is not a valid date')
        ];

        /**
         * Validate request
         * 
         */
        $request->validate([
            'title'          => ['required', 'max:40',      'string'],
            'start'          => ['required', 'before:end',  'date'],
            'end'            => ['required', 'after:start', 'date'],
        ], $messages);

        /**
         * Validated data
         * 
         */
        $data = $request->all();

        $data['start'] = date_create_from_format('d/m/Y G:i', $data['start']);
        $data['end']   = date_create_from_format('d/m/Y G:i', $data['end']);

        if($request->status){
            $data['status'] = null;
        }


         /**
          * Validate if the place is avaible
          * to schedule
          *
          * LOGICS FOR VALIDATION
          *
          * Considero que já existe um conflito
          * com um outro compromisso quando a data é a mesma,
          * ou existe uma sobreposição
          * de horário. 
          */

        $isReserved       = DB::select(
            'select * from schedules where 
            ? between start and end
            or
            ? between start and end
            or
            start > ? and end < ?
            or
            ? = start and ? = end',

            [$data['start'], $data['end'],
            
            $data['start'], $data['end'],

            $data['start'], $data['end']]
        );

        $isReserved = hasData($isReserved);

        if($isReserved){
            return redirect()
                     ->back()->with(['error' => Lang::get(' This location is not available on these dates')]);
        }

        $create  = Schedule::create($data);

        $log     =
        [
            'schedule_id'   => $create->id,
            'user_id'       => auth()->user()->id,
            'action'        => '1'
        ];

        $createLog = ScheduleLog::create($log);

        if(!$createLog){
            return abort(500);
        }

        if(!$create){
            return redirect()
                     ->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }

        return redirect()->route('home')->with(['status' => Lang::get('Scheduling Created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule   = Schedule::with('schedulingCustomer')->with('schedulingPlace')->findOrFail($id);

        $places     = Place::get();
        $customers  = Customer::get();

        return view('app.dashboard.schedules.edit', [
            'schedule'      => $schedule,
            'places'        => $places,
            'customers'     => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data    = $request->all();

        if($request->status){
            $data['status'] = null;
        }

        /**
         * checks if the date entered
         * is in the past
         * 
         */

         /**something here that cheks it */
        

        $update  = Schedule::findOrFail($id)->update($data);

        $log     =
        [
            'schedule_id'   => $id,
            'user_id'       => auth()->user()->id,
            'action'        => '2'
        ];

        $createLog = ScheduleLog::create($log);

        if(!$createLog){
            return abort(500);
        }

        if(!$update){
            return redirect()
                     ->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }

        return redirect()->back()->with(['status' => Lang::get('Updated schedule')]);
    }

    /**
     * Confirm before cancel
     * 
     */

    public function confirmCancel($id){
        $schedule = Schedule::with('schedulingCustomer')
                    ->with('schedulingPlace')
                    ->findOrFail($id);

        return view('app.dashboard.schedules.confirm.cancel', [
            'schedule'  => $schedule
        ]);
    }

    /**
     * Cancel the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $cancel  = Schedule::findOrFail($id)->delete();

        if(!$cancel){
            return redirect()
                     ->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }

        $log     =
        [
            'schedule_id'   => $id,
            'user_id'       => auth()->user()->id,
            'action'        => '3'
        ];

        $createLog = ScheduleLog::create($log);

        if(!$createLog){
            return abort(500);
        }

        return redirect()->route('home')->with(['status' => Lang::get('Schedule canceled')]);
    }
}
