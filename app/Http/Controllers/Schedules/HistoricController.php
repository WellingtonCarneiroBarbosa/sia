<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\HistoricSchedule;
use App\Models\Places\Place;
use App\Models\Customers\Customer;

class HistoricController extends Controller
{
    /**
     * Returns all schedules
     * 
     */
    public function index()
    {
        $schedules = HistoricSchedule::with('historicSchedulingCustomer')
                                     ->with('historicSchedulingPlace')
                                     ->orderBy('start', 'ASC')
                                     ->paginate(config('app.paginate_limit'));

        $places = Place::get();
        $customers = Customer::withTrashed()->get();

        $hasSchedules = hasData($schedules);
        $hasPlaces    = hasData($places);
        $hasCustomers = hasData($customers);

        return view('app.dashboard.schedules.historic.index',
        [
            'schedules' => $schedules, 'hasSchedules' => $hasSchedules,
            'hasPlaces' => $hasPlaces, 'hasCustomers' => $hasCustomers,
            'places' => $places, 'customers' => $customers
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $schedule = HistoricSchedule::with('historicSchedulingCustomer')
                      ->with('historicSchedulingPlace')->findOrFail($id);

        $now = date('Y-m-d H:i:s');

        return view('app.dashboard.schedules.show', [
            'schedule' => $schedule, 'now' => $now,
        ]);
    }
}
