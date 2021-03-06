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
        $schedules      = Schedule::orderBy('start', 'ASC')->where('start', '>=', now())
        ->with('schedulingCustomer')->with('schedulingPlace')->get();
                          
        $places         = Place::get();

        $hasPlaces      = hasData($places);
        $hasSchedules   = hasData($schedules);

        $schedules = \json_encode($schedules);

        $now = date('Y-m-d H:i:s');

        return view('app.dashboard.index',
        [
            'schedules' => $schedules,  'hasSchedules' => $hasSchedules,
            'places'    => $places,     'hasPlaces'    => $hasPlaces,
            'now'       => $now
        ]);
    }
}
