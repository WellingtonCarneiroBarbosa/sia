<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\ScheduleLog;
use App\Models\Schedules\HistoricSchedule;
use App\Models\Places\Place;
use App\Models\Customers\Customer;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use DB;
use DateTime;

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
            'before' => Lang::get('The date entered is not a valid date'),
            'after'  => Lang::get('The date entered is not a valid date'),
            'date'   => Lang::get('The date entered is not a valid date')
        ];

        /**
         * Validate request
         * 
         */
        $data = $request->all();

        $data['start'] = DateTime::createFromFormat('d/m/Y H:i', $data['start']);
        $data['end']   = DateTime::createFromFormat('d/m/Y H:i', $data['end']);

        $validator = Validator::make($data, [
            'title'   => ['required', 'string', 'max:40',],
            'start'   => ['required', 'date', 'before:end',  config("app.min_schedule_date"), config("app.max_schedule_date")],
            'end'     => ['required', 'date', 'after:start', config("app.min_schedule_date"), config("app.max_schedule_date")],
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

        $now = date('Y-m-d H:i:s');
        $now = DateTime::createFromFormat('Y-m-d H:i:s', $now);

        if($data['start'] <= $now){
            $saveOnHistoric = HistoricSchedule::create($data);

            if(!$saveOnHistoric){
                $error = Lang::get('Something went wrong. Please try again!');
                return redirect()
                        ->back()
                        ->withErrors($error)
                        ->withInput();
            }

            return redirect()->back()->with(['status' => Lang::get(' The schedule was saved in the history section')]);
        }

        $isReserved  = DB::select(
            "SELECT * FROM schedules WHERE place_id = ? AND deleted_at IS NULL AND (
                ? BETWEEN start AND end
                OR ? BETWEEN start AND end
                OR ( start > ? AND end < ? ) 
                OR ( ? = start AND ? = end )
            )",[$data['place_id'],
                $data['start'], $data['end'],
                $data['start'], $data['end'],
                $data['start'], $data['end']
                ]
            );


        $isReserved = hasData($isReserved);

        if($isReserved){
            $error = Lang::get(' This location is not available on these dates');
            return redirect()
                    ->back()
                    ->withErrors($error)
                    ->withInput();
        }

        /**
         * checks if the date entered
         * is in the past
         * 
         */

         /**something here that checks it */


        $create  = Schedule::create($data);

        if(!$create){
            $error = Lang::get('Something went wrong. Please try again!');
            return redirect()
                    ->back()
                    ->withErrors($error)
                    ->withInput();
        }

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

        return redirect()->route('home')->with(['status' => Lang::get('Scheduling Created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $schedule = Schedule::with('schedulingCustomer')
                    ->with('schedulingPlace')->findOrFail($id);

        $now = date('Y-m-d H:i:s');

        return view('app.dashboard.schedules.show', ['schedule' => $schedule, 'now' => $now]);
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

        $hasPlaces      = hasData($places);
        $hasCustomers   = hasData($customers);

        return view('app.dashboard.schedules.edit', [
            'schedule'      => $schedule,
            'places'        => $places,
            'customers'     => $customers,
            'hasPlaces'     => $hasPlaces,
            'hasCustomers'  => $hasCustomers
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
        $data = $request->all();

        $data['start'] = DateTime::createFromFormat('d/m/Y H:i', $data['start']);
        $data['end']   = DateTime::createFromFormat('d/m/Y H:i', $data['end']);

        $validator = Validator::make($data, [
            'title'   => ['required', 'string', 'max:40',],
            'start'   => ['required', 'date', 'before:end',  config("app.min_schedule_date"), config("app.max_schedule_date")],
            'end'     => ['required', 'date', 'after:start', config("app.min_schedule_date"), config("app.max_schedule_date")],
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
        if($request->status === "on"){
            $data['status'] = null;
        }else {
            $data['status'] = '1';
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

          $scheduleUpdate  = Schedule::findOrFail($id);

          $isReserved  = DB::select(
            "SELECT * FROM schedules WHERE place_id = ? AND deleted_at IS NULL AND created_at != ? AND (
                ? BETWEEN start AND end
                OR ? BETWEEN start AND end
                OR ( start > ? AND end < ? ) 
                OR ( ? = start AND ? = end )
            )",[$data['place_id'], $scheduleUpdate['created_at'],
                $data['start'], $data['end'],
                $data['start'], $data['end'],
                $data['start'], $data['end']
                ]
            );

        $isReserved = hasData($isReserved);

        if($isReserved){
            $error = Lang::get(' This location is not available on these dates');
            return redirect()
                    ->back()
                    ->withErrors($error)
                    ->withInput();
        }


        /**
         * checks if the date entered
         * is in the past
         * 
         */

         /**something here that checks it */
        

        $scheduleUpdate = $scheduleUpdate->update($data);

        if(!$scheduleUpdate){
            $error = Lang::get('Something went wrong. Please try again!');
            return redirect()
                    ->back()
                    ->withErrors($error)
                    ->withInput();
        }

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

        $now = date('Y-m-d H:i:s');                

        return view('app.dashboard.schedules.confirm.cancel', [
            'schedule'  => $schedule, 'now' => $now
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
            $error = Lang::get('Something went wrong. Please try again!');
            return redirect()
                    ->back()
                    ->withErrors($error)
                    ->withInput();
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
