<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Models\Places\Place;
use App\Models\Customers\Customer;

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

        return view('app.dashboard.schedules.canceled', [
            'canceledSchedules'         => $canceledSchedules,
            'hasCanceledSchedules'      => $hasCanceledSchedules,
            'places'                    => $places,       
            'hasPlaces'                 => $hasPlaces,
            'customers'                 => $customers, 
            'hasCustomers'              => $hasCustomers
        ]);
    }
}
