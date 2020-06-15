<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;
use App\Models\Places\Place;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $schedules      = Schedule::with('schedulingCustomer')
                          ->with('schedulingPlace')
                          ->paginate(config('app.paginate_limit'));   
                          
        $places         = Place::get();

        $hasPlaces      = hasData($places);
        $hasSchedules   = hasData($schedules);

        $now = date('Y-m-d H:i:s');

        return view('app.dashboard.index',
        [
            'schedules' => $schedules,  'hasSchedules' => $hasSchedules,
            'places'    => $places,     'hasPlaces'    => $hasPlaces,
            'now'       => $now
        ]);
    }

    /**
     * Support team home
     * 
     */
    public function supportHome()
    {
        return "oi";
    }
}
