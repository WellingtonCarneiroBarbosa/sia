<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\HistoricSchedule;
use App\Models\Places\Place;
use ArrayObject, DB, Lang, Validator;

class StatisticController extends Controller
{
    /**
     * @var Carbon
     */
    private $lastMonth;
    /**
     * @var int
     */
    private $currentMonth;

    public function __construct(Carbon $carbon)
    {
        $this->currentMonth = $carbon->now()->month;
        $this->currentYear = $carbon->now()->year;
        $this->lastMonth = $carbon->subMonth();
    }

    public function specificDate(Request $request)
    {
        /**
         * Validate request
         * 
         */
        {
            $data = $request->all();

            $data['start'] = dateAmericanFormat($data['start']);
            $data['end'] = dateAmericanFormat($data['end']);

            $messages  = [
                'before' => Lang::get('The date entered is not a valid date'),
                'after'  => Lang::get('The date entered is not a valid date'),
            ];
        
            $validator = Validator::make($data, [
                'start'   => ['required', 'date', 'before_or_equal:end',  config("app.min_schedule_date"), config("app.max_schedule_date")],
                'end'     => ['required', 'date', config("app.min_schedule_date"), config("app.max_schedule_date")],
            ], $messages);

            if($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
        }

        $places = Place::all();

        if(! count($places) > 0)
        {
            return redirect()->back()->with(['error' => Lang::get('Please register a place')]);
        }

        /**
         * Schedule statistics
         *
         */
        $howManySchedules = Schedule::where(DB::raw('DATE(created_at)'), ">=", $data['start'])->where(DB::raw('DATE(created_at)'), "<=", $data['end'])->count();
        $howManyCanceledSchedules = Schedule::onlyTrashed()->where(DB::raw('DATE(created_at)'), ">=", $data['start'])->where(DB::raw('DATE(created_at)'), "<=", $data['end'])->count();
        
        /**
         * Has schedules to show 
         * 
         */
        if($howManySchedules <= 0 && $howManyCanceledSchedules <= 0) {
            return redirect()->route('statistics')->withInput()->with(['error' => Lang::get("We did not find any statistics for these dates")]);
        }
            

        /**
         * Place statistics
         * 
         */

        $currentMonthSchedules = Schedule::where(DB::raw('DATE(created_at)'), '>=', $data['start'])->where(DB::raw('DATE(created_at)'), '<=', $data['end'])->get();

        foreach($places as $place)
        {
            $appointmentsPerPlace[$place->id] = 0;
        }

        foreach($currentMonthSchedules as $schedule)
        {
            foreach($places as $place)
            {
                if($schedule->place_id === \intval($place->id))
                {
                    $appointmentsPerPlace[$place->id]++;
                }
            }
        }

        return view('app.dashboard.statistics.index', [
            'startDate'              => $data['start'], 'endDate' => $data['end'],
            'howManyNewSchedules'    => $howManySchedules, 'howManyCanceledSchedules' => $howManyCanceledSchedules,
            'places'                 => $places, 'appointmentsPerPlace' => $appointmentsPerPlace
        ]);
    }

    public function index()
    {
        $places = Place::all();

        if(! count($places) > 0)
        {
            return redirect()->back()->with(['error' => Lang::get('Please register a place')]);
        }

        /**
         * Schedule statistics
         *
         */
        {
            $lastMonthName  = utf8_encode($this->lastMonth->formatLocalized('%B'));

            $howManySchedulesAtThisMonth         = $this->howManySchedulesInAMouth($this->currentMonth);

            $howManyCanceledSchedulesAtThisMonth = $this->howManyCanceledSchedulesInAMouth($this->currentMonth);

            $howManySchedulesAtLastMonth         = $this->howManySchedulesInAMouth($this->lastMonth);

            $howManyCanceledSchedulesAtLastMonth = $this->howManyCanceledSchedulesInAMouth($this->lastMonth);

            /**
             * Get percentage Statistics
             *
             */
            $canceledStatistics  = $this->getCanceledSchedulesStatistics($howManyCanceledSchedulesAtThisMonth, $howManyCanceledSchedulesAtLastMonth);

            $schedulesStatistics = $this->getSchedulesStatistics($howManySchedulesAtThisMonth, $howManySchedulesAtLastMonth);

            /**
             * Data for views
             *
             */
            $goodCanceledStatistic = $canceledStatistics[0];

            $goodConfirmedStatistic = $schedulesStatistics[0];

            $canceledStatistic     = $canceledStatistics[1];

            $confirmedStatistic    = $schedulesStatistics[1];
        }

        /**
         * Place statistics
         * 
         */
        $currentMonthSchedules = $this->getCurrentMonthSchedules();
       
        foreach($places as $place)
        {
            $appointmentsPerPlace[$place->id] = 0;
        }

        foreach($currentMonthSchedules as $schedule)
        {
            foreach($places as $place)
            {
                if($schedule->place_id === \intval($place->id))
                {
                    $appointmentsPerPlace[$place->id]++;
                }
            }
        }

        return view('app.dashboard.statistics.index', [
            'lastMonth'              => $lastMonthName, 
            'canceledStatistic'      => $canceledStatistic,      'confirmedStatistic'    => $confirmedStatistic,
            'goodConfirmedStatistic' => $goodConfirmedStatistic, 'goodCanceledStatistic' => $goodCanceledStatistic,
            'howManyNewSchedules'    => $howManySchedulesAtThisMonth, 'howManyCanceledSchedules' => $howManyCanceledSchedulesAtThisMonth,
            'places'                 => $places, 'appointmentsPerPlace' => $appointmentsPerPlace
        ]);
    }

    /**
     * Get statistics for
     * places
     * 
     */
    public function getCurrentMonthSchedules()
    {
        
        $datetimeObject = \DateTime::createFromFormat("Y-m", $this->currentYear . "-" . $this->currentMonth);

        // o primeiro dia do mês hard coded
        $start = $datetimeObject->format('Y-m-01');

        // t é equivalente ao último dia do mês
        $end = $datetimeObject->format('Y-m-t');

        $currentMonthSchedules = Schedule::where(DB::raw('DATE(created_at)'), '>=', $start)->where(DB::raw('DATE(created_at)'), '<=', $end)->get();

        return $currentMonthSchedules;
    }

    /**
     * @param $month
     * @return int
     */
    public static function howManySchedulesInAMouth($month)
    {
        return Schedule::whereMonth('created_at', $month)->count();
    }

    /**
     * @param $month
     * @return int
     */
    public static function howManyCanceledSchedulesInAMouth($month)
    {
        return Schedule::onlyTrashed()->whereMonth('deleted_at', $month)->count();
    }

    /**
     * @param $actualyMonth
     * @param $lastMonth
     * @return ArrayObject
     *  [0] => positive stat?
     *  [1] => percentage number
     */
    public static function getCanceledSchedulesStatistics($actualyMonth, $lastMonth){
        $statistics = new ArrayObject();

        if($actualyMonth > 0 && $lastMonth > 0)
        {
            if($actualyMonth > $lastMonth)
            {
                $percentage = positivePercentageChange($actualyMonth, $lastMonth);

                $statistics->append(false);
                $statistics->append($percentage);

                return $statistics;
            }
            else if($lastMonth > $actualyMonth)
            {
                $percentage = negativePercentageChange($lastMonth, $actualyMonth);

                $statistics->append(true);
                $statistics->append($percentage);

                return $statistics;
            }
        }
        else if($actualyMonth > 0 && $lastMonth <= 0)
        {
            $percentage = percentageForm($actualyMonth);

            $statistics->append(false);
            $statistics->append($percentage);

            return $statistics;
        }

        $statistics->append(null);
        $statistics->append(0);

        return $statistics;
    }

    /**
     * @param $actualyMonth
     * @param $lastMonth
     * @return ArrayObject
     */
    public static function getSchedulesStatistics($actualyMonth, $lastMonth){
        $statistics = new ArrayObject();

        if($actualyMonth > 0 && $lastMonth > 0)
        {
            if($actualyMonth > $lastMonth)
            {
                $percentage = positivePercentageChange($actualyMonth, $lastMonth);

                $statistics->append(true);
                $statistics->append($percentage);

                return $statistics;
            }
            else if($lastMonth > $actualyMonth)
            {
                $percentage = negativePercentageChange($lastMonth, $actualyMonth);

                $statistics->append(false);
                $statistics->append($percentage);

                return $statistics;
            }
        }
        else if($actualyMonth > 0 && $lastMonth <= 0)
        {
            $percentage = percentageForm($actualyMonth);

            $statistics->append(true);
            $statistics->append($percentage);

            return $statistics;
        }

        $statistics->append(null);
        $statistics->append(0);

        return $statistics;
    }
}
