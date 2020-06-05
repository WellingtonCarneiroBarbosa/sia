<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\HistoricSchedule;
use App\Models\Places\Place;
use App\Models\Customers\Customer;
use App\Models\Schedules\ScheduleLog;
use Illuminate\Support\Facades\Lang;
use DB;
use DateTime;

class CanceledSchedulesController extends Controller
{
    /**
     * Return all canceled schedules
     * and paginate it
     * 
     */
    public function index(){
        $canceledSchedules = Schedule::with('schedulingCustomer')->with('schedulingPlace')
                             ->onlyTrashed()->paginate(config('app.paginate_limit'));

        $hasCanceledSchedules = hasData($canceledSchedules);

        $places       = Place::get();
        $customers    = Customer::get();

        $hasPlaces    = hasData($places);
        $hasCustomers = hasData($customers);

        $now = date('Y-m-d H:i:s');

        return view('app.dashboard.schedules.canceled', [
            'schedules'         => $canceledSchedules,
            'hasSchedules'      => $hasCanceledSchedules,
            'places'                    => $places,       
            'hasPlaces'                 => $hasPlaces,
            'customers'                 => $customers, 
            'hasCustomers'              => $hasCustomers,
            'now'                       => $now
        ]);
    }

    /**
     * show a canceled schedule
     */
    public function show($id){
        $schedule = Schedule::onlyTrashed()
                    ->with('schedulingCustomer')
                    ->with('schedulingPlace')->findOrFail($id);

        $now = date('Y-m-d H:i:s');

        return view('app.dashboard.schedules.show', ['schedule' => $schedule, 'now' => $now]);
    }

     /**
     * Confirm before restore
     * 
     */
    public function confirmRestore($id){
        $schedule = Schedule::with('schedulingCustomer')
                    ->with('schedulingPlace')
                    ->onlyTrashed()
                    ->findOrFail($id);

        $now = date('Y-m-d H:i:s');

        return view('app.dashboard.schedules.confirm.restore', [
            'schedule'  => $schedule, 'now' => $now
        ]);
    }

    /**
     * Restore a schedule
     * 
     */
    public function restore($id){

        $schedule = Schedule::onlyTrashed()->findOrFail($id);

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
            )",[$schedule['place_id'],
                $schedule['start'], $schedule['end'],
                $schedule['start'], $schedule['end'],
                $schedule['start'], $schedule['end']
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

        $schedule = $schedule->restore();

        if(!$schedule){
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
            'action'        => '4'
        ];

        $createLog = ScheduleLog::create($log);

        if(!$createLog){
            return abort(500);
        }

        return redirect()->route('home')->with(['status' => Lang::get('Rescheduled')]);
    }

    /**
     * Confirm before delete
     * 
     */
    public function confirmPermanentlyDelete($id){
        $schedule = Schedule::with('schedulingCustomer')->with('schedulingPlace')
                    ->onlyTrashed()->findOrFail($id);

        $now = date('Y-m-d H:i:s');

        return view('app.dashboard.schedules.confirm.deletePermanently', [
            'schedule'  => $schedule, 'now' => $now
        ]);
    }

    /**
     * Delete
     * 
     */
    public function permanentlyDelete($id){
        $delete =  Schedule::onlyTrashed()->findOrFail($id)->forceDelete();

        if(!$delete){
            $error = Lang::get('Something went wrong. Please try again!');
            return redirect()
                    ->back()
                    ->withErrors($error)
                    ->withInput();
        }

        $log     =
        [
            'schedule_id'   => null,
            'user_id'       => auth()->user()->id,
            'action'        => '5'
        ];

        $createLog = ScheduleLog::create($log);

        if(!$createLog){
            return abort(500);
        }

        $expiredSchedules = Schedule::withTrashed()->where('place_id', null)->orWhere('customer_id', null)->get();

        $hasExpiredSchedules = hasData($expiredSchedules);

        if($hasExpiredSchedules){
            foreach($expiredSchedules as $schedule){
                $data = $schedule->getAttributes();
                HistoricSchedule::create($data);
                Schedule::where('id', $data["id"])->forceDelete();
            }
        }

        return redirect()->route('schedules.canceled')->with(['status' => Lang::get('Permanently deleted')]);
    }
}
