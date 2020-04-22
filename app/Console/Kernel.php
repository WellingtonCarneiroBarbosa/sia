<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Schedules\HistoricSchedule;
use Carbon\Carbon;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $now = date('Y-m-d H:i:s');

            $expiredSchedules = DB::select("SELECT * FROM schedules WHERE end <= ?", [$now]);

            $hasExpiredSchedules = hasData($expiredSchedules);

            if($hasExpiredSchedules){
                foreach($expiredSchedules as $schedule){
                  $data = array(
                      'title'   => $schedule->title, 'place_id'     => $schedule->place_id, 'start'     => $schedule->start,
                      'end'     => $schedule->end, 'customer_id'    => $schedule->customer_id, 'status' => $schedule->status,
                  );

                  $historic = DB::insert('INSERT INTO historic_schedules (title, place_id, start, end, customer_id, status, created_at, updated_at, deleted_at)
                  values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                  [
                      $schedule->title,       $schedule->place_id,        $schedule->start,
                      $schedule->end,         $schedule->customer_id,     $schedule->status,
                      $schedule->created_at,  $schedule->updated_at,      $schedule->deleted_at
                  ]);

                  $delete = DB::delete('DELETE FROM schedules WHERE id = ?', [$schedule->id]);
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
