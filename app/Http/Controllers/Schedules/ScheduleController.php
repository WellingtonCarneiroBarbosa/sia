<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\ScheduleLog;
use App\Models\Places\Place;
use App\Models\Customers\Customer;
use Illuminate\Support\Facades\Lang;

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

        return redirect()->back()->with(['status' => Lang::get('Scheduling Created')]);
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
