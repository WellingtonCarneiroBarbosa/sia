<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;

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
        /***
         * Get all the schedules with the places
         * and customers
         * 
         * @paginate
         */
        $schedules = Schedule::paginate(10);

        $hasSchedules = hasData($schedules);

        return view('app.dashboard.index', ['schedules' => $schedules, 'hasSchedules' => $hasSchedules]);
    }
}
