<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\HistoricSchedule;
use App\Models\Places\Place;
use App\Models\Customers\Customer;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

use DB;
use DateTime;

class ScheduleController extends Controller
{

    public function getGuestView(Request $request) 
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $schedules      = Schedule::orderBy('start', 'ASC')->where('start', '>=', now())
        ->with('schedulingCustomer')->with('schedulingPlace')->get();

        $hasSchedules = hasData($schedules);

        $schedules = \json_encode($schedules);

        return view('app.guest.schedules', compact('schedules', 'hasSchedules'));
                          
    }

    /**
     * Get schedule info
     * 
     */
    public function getScheduleInfos($schedule_id)
    {
        $schedule = Schedule::with('schedulingCustomer')
        ->with('schedulingPlace')->findOrFail($schedule_id);

        $schedule['start'] = dateTimeBrazilianFormat($schedule['start']);
        $schedule['end'] = dateTimeBrazilianFormat($schedule['end']);

        return response()->json($schedule);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $places         = Place::orderBy('name', 'ASC')->get();
        $customers      = Customer::orderBy('corporation', 'ASC')->get();

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
            'date'   => Lang::get('The date entered is not a valid date'),
            'gte'    => Lang::get('The schedule must have at least 1 participant'),
        ];

        /**
         * Validate request
         * 
         */
        $data = $request->all();

        $data['start'] = DateTime::createFromFormat('d/m/Y H:i', $data['start']);
        $data['end']   = DateTime::createFromFormat('d/m/Y H:i', $data['end']);
        $data['participants']  = sanitizeString($data['participants']);

        $validator = Validator::make($data, [
            'title'   => ['required', 'string', 'max:40',],
            'start'   => ['required', 'date', 'before:end',  config("app.min_schedule_date"), config("app.max_schedule_date")],
            'end'     => ['required', 'date', config("app.min_schedule_date"), config("app.max_schedule_date")],
            'participants' => ['required', 'max:6', 'gte:1'],
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

        /**check if the place support the participants */
        $placeCapacity = Place::findOrFail($data['place_id']);

        $placeCapacity = $placeCapacity->capacity;

        if((int) $data['participants'] > (int) $placeCapacity){
            $error = Lang::get('This place support only ') .  $placeCapacity  . Lang::get(' peoples');
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

        $now = date('Y-m-d H:i:s');
        $now = DateTime::createFromFormat('Y-m-d H:i:s', $now);

        if($data['start'] <= $now){
            $saveOnHistoric = HistoricSchedule::create($data);

            redirectBackIfThereIsAError($saveOnHistoric);

            return redirect()->back()->with(['status' => Lang::get(' The schedule was saved in the history section')]);
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
        
        $create  = Schedule::create($data);

        redirectBackIfThereIsAError($create);

        return redirect()->route('home')->with(['status' => Lang::get('Scheduling Created') . ". " . Lang::get('System users were notified via email')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $schedule = Schedule::withTrashed()->with('schedulingCustomer')
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
            'date'   => Lang::get('The date entered is not a valid date'),
            'gte'    => Lang::get('The schedule must have at least 1 participant'),
        ];

        /**
         * Validate request
         * 
         */
        $data = $request->all();

        $data['start'] = DateTime::createFromFormat('d/m/Y H:i', $data['start']);
        $data['end']   = DateTime::createFromFormat('d/m/Y H:i', $data['end']);
        $data['participants']  = sanitizeString($data['participants']);

        $validator = Validator::make($data, [
            'title'   => ['required', 'string', 'max:40',],
            'start'   => ['required', 'date', 'before:end',  config("app.min_schedule_date"), config("app.max_schedule_date")],
            'end'     => ['required', 'date', config("app.min_schedule_date"), config("app.max_schedule_date")],
            'participants' => ['required', 'max:6', 'gte:1'],
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

        /**check if the place support the participants */
        $placeCapacity = Place::findOrFail($data['place_id']);

        $placeCapacity = $placeCapacity->capacity;

        if((int) $data['participants'] > (int) $placeCapacity){
            $error = Lang::get('This place support only ') .  $placeCapacity  . Lang::get(' peoples');
            return redirect()
                    ->back()
                    ->withErrors($error)
                    ->withInput();
        }

        $now = date('Y-m-d H:i:s');
        $now = DateTime::createFromFormat('Y-m-d H:i:s', $now);

        if($data['start'] <= $now){
        $error = Lang::get('This schedule cannot start with this start date');
        return redirect()
                ->back()
                ->withErrors($error)
                ->withInput();
        }

        $scheduleUpdate  = Schedule::findOrFail($id);

        $scheduleStartBeforeUpdate = $scheduleUpdate['start'];
        $scheduleEndBeforeUpdate = $scheduleUpdate['end'];

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

        $updated = $scheduleUpdate->update($data);

        redirectBackIfThereIsAError($updated);

        /**
         * Convert datetime object
         * to string
         * 
         */
        $data['start'] = date_format($data['start'], 'Y-m-d H:i:s');
        $data['end']   = date_format($data['end'], 'Y-m-d H:i:s');

        if($data['start'] != $scheduleStartBeforeUpdate || $data['end'] != $scheduleEndBeforeUpdate)
        {
            $message = Lang::get('Updated schedule') . ". " . Lang::get('System users were notified via email');
        }
        else
        {
            $message = Lang::get('Updated schedule');
        }
        

        return redirect()->back()->with(['status' => $message]);
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

        redirectBackIfThereIsAError($cancel);

        $expiredSchedules = Schedule::withTrashed()->where('place_id', null)->orWhere('customer_id', null)->get();

        $hasExpiredSchedules = hasData($expiredSchedules);

        if($hasExpiredSchedules){
            foreach($expiredSchedules as $schedule){
                $data = $schedule->getAttributes();
                HistoricSchedule::create($data);
                Schedule::where('id', $data["id"])->forceDelete();
            }
        }

        return redirect()->route('home')->with(['status' => Lang::get('Schedule canceled') . ". " . Lang::get('System users were notified via email')]);
    }

    public function generateGuestURL(){
        $token = Str::random(5);

        $temporaryURL = URL::temporarySignedRoute(
            'schedules.guest', now()->addMinutes(2), ['token' => $token]
        );

        return redirect()->back()->with(['status' => 'Link gerado. Validade: 2 minutos-> ' . $temporaryURL]);
    }
}
