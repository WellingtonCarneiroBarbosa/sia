<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Schedules\Schedule;

class StatisticController extends Controller
{
    public function howManySchedulesInAMouth($month)
    {
        $schedules = Schedule::whereMonth('created_at', $month)->count();
        return $schedules;
    }

    public function howManyCanceledSchedulesInAMouth($month)
    {
        $schedules = Schedule::onlyTrashed()->whereMonth('deleted_at', $month)->count();
        return $schedules;
    }
    

    public function index()
    {
        /**
         * Dates Methods
         * 
         */

        $carbon = new Carbon();

        $now = $carbon->now();

        /**
         * Actualy Mounth
         * 
         */
        $actualyMonth       = $now->month;
        $actualyMonthName   = utf8_encode($now->formatLocalized('%B'));

        /**
         * Last Month
         * 
         */
        $lastMonth      = $now->subMonth()->month;
        $lastMonthName  = utf8_encode($now->subMonth()->formatLocalized('%B'));

        /**
         * Quantites
         * 
         */
        $howManySchedulesAtThisMonth         = static::howManySchedulesInAMouth($actualyMonth);

        $howManyCanceledSchedulesAtThisMonth = static::howManyCanceledSchedulesInAMouth($actualyMonth);

        $howManySchedulesAtLastMonth         = static::howManySchedulesInAMouth($lastMonth);

        $howManyCanceledSchedulesAtLastMonth = static::howManyCanceledSchedulesInAMouth($lastMonth);


        return view('app.dashboard.statistics.index');
    }
}
