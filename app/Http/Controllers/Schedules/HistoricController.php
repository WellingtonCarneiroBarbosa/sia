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
                                     ->paginate(config('app.paginate_limit'));

        $places = Place::get();
        $customers = Customer::get();

        $hasSchedules = hasData($schedules);
        $hasPlaces = hasData($places);
        $hasCustomers = hasData($customers);

        $now = date('Y-m-d H:i:s');

        return view('app.dashboard.schedules.historic.index',
        [
            'schedules' => $schedules, 'hasSchedules' => $hasSchedules,
            'hasPlaces' => $hasPlaces, 'hasCustomers' => $hasCustomers,
            'places' => $places, 'customers' => $customers, 'now' => $now
        ]);
    }
}
