<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Models\Places\Place;
use App\Models\Customers\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $schedules      = Schedule::with('schedulingCustomer')
                                        ->with('schedulingPlace')
                                                    ->paginate(10);
        $places         = Place::get();

        $customers      = Customer::get();

        $hasSchedules   = hasData($schedules);

        $hasPlaces      = hasData($places);

        $hasCustomers   = hasData($customers);

        return view('app.dashboard.index',
        [
            'schedules' => $schedules,  'hasSchedules' => $hasSchedules,
            'places'    => $places,     'hasPlaces'    => $hasPlaces,
            'customers' => $customers,  'hasCustomers' => $hasCustomers
        ]);
    }
}
