<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedules\Schedule;

class ScheduleCalendarController extends Controller
{
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function index()
    {
        $schedules = \json_encode($this->schedule->all());
        return view('app.dashboard.schedules.calendar.index', compact('schedules'));
    }

    public function getSchedules()
    {
        
        return response()->json($schedules);
    }
}
