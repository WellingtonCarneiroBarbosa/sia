<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Schedules\ScheduleLog;
use App\Models\Places\PlaceLog;
use App\Models\Customers\CustomerLog;
use App\User;
use App\UserLog;
use DB, Datetime, Validator;

class UserActivityReportController extends Controller
{
    static function formatLogs ($schedules_log, $customers_log, $places_log, $users_log)
    {
        $created = Lang::get('registered');
        $updated = Lang::get('updated');
        $canceled = Lang::get('revoked');
        $restored = Lang::get('restored');
        $forceDeleted = Lang::get('deleted');

        /**
        * Trata os dados dos logs
        * dos agendamentos
        * 
        */
        foreach($schedules_log as $log)
        {
            switch($log->action)
            {
                case 1: 
                    $log->action = $created;
                    break;
                case 2: 
                    $log->action = $updated;
                    break;
                case 3:
                    $log->action = $canceled;
                    break;
                case 4: 
                    $log->action = $restored;
                    break; 
                case 5: 
                    $log->action = $forceDeleted;
                    break;
            } 
        }

        /**
        * Trata os dados dos logs
        * dos clientes
        * 
        */
        foreach($customers_log as $log)
        {
            switch($log->action)
            {
                case 1: 
                    $log->action = $created;
                    break;
                case 2: 
                    $log->action = $updated;
                    break;
                case 3:
                    $log->action = $forceDeleted;
                    break;
            } 
        }

        /**
        * Trata os dados dos logs
        * dos locais
        * 
        */
        foreach($places_log as $log)
        {
            switch($log->action)
            {
                case 1: 
                    $log->action = $created;
                    break;
                case 2: 
                    $log->action = $updated;
                    break;
                case 3:
                    $log->action = $forceDeleted;
                    break;
            } 
        }

        /**
         * Trata os dados dos logs
         * dos usuarios
         *
         */
        foreach($users_log as $log)
        {
            switch($log->action)
            {
                case 1: 
                    $log->action = $created;
                    break;
                case 2: 
                    $log->action = $updated;
                    break;
                case 3:
                    $log->action = Lang::get('deactivated');
                    break;
                case 4: 
                    $log->action = Lang::get('enabled');
                    break;
            } 
        }
    }

    static function getLogs($data, $userID)
    {
        /**
         * Get logs
         * 
         */
        $limit = 50;

        $schedules_log = ScheduleLog::where('user_id', $userID)->where('created_at', '>=', $data['start'])->where('created_at', '<=', $data['end'])->latest()->take($limit)->get();
        $customers_log = CustomerLog::where('user_id', $userID)->where('created_at', '>=', $data['start'])->where('created_at', '<=', $data['end'])->latest()->take($limit)->get();
        $places_log = PlaceLog::where('user_id', $userID)->where('created_at', '>=', $data['start'])->where('created_at', '<=', $data['end'])->latest()->take($limit)->get();
        $users_log = UserLog::where('user_action_id', $userID)->where('created_at', '>=', $data['start'])->where('created_at', '<=', $data['end'])->latest()->take($limit)->get();

        /**
         * Verify if has
         * any log
         * 
         */
        $hasScheduleLogs = hasData($schedules_log);
        $hasCustomerLogs = hasData($customers_log);
        $hasPlaceLogs = hasData($places_log);
        $hasUserLogs = hasData($users_log);


        return [
            'schedule_logs' => $schedules_log, 'hasScheduleLogs' => $hasScheduleLogs,
            'place_logs' => $places_log, 'hasPlaceLogs' => $hasPlaceLogs,
            'customer_logs' => $customers_log, 'hasCustomerLogs' => $hasCustomerLogs,
            'user_logs' => $users_log, 'hasUserLogs' => $hasUserLogs
        ];
    }

    public function generate(Request $request, $userID)
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

        try {

            /**
             * Get informations
             * 
             */
            {
                $user = User::withTrashed()->findOrFail($userID);
                $logs = $this->getLogs($data, $userID);

                $data['start'] = dateBrazilianFormat($data['start']);
                $data['end'] = dateBrazilianFormat($data['end']);

                /**
                 * If hasnt any log..
                 * 
                 */
                if(! $logs['hasScheduleLogs'] && ! $logs['hasCustomerLogs'] && ! $logs['hasPlaceLogs'] && ! $logs['hasUserLogs'])
                {
                    if($data['start'] == $data['end'])
                    {
                        $exceptionMessageDate = $data['start'];
                    } else {
                        $exceptionMessageDate = $data['start'] . " " . Lang::get('and') . " " . $data['end'];
                    }

                    $exceptionMessage = "Este usuário não realizou nenhuma atividade no sistema durante" . " " . $exceptionMessageDate;
                    return redirect()->back()->withInput()->with(['error' => $exceptionMessage]);
                }

                $this->formatLogs($logs['schedule_logs'], $logs['customer_logs'], $logs['place_logs'], $logs['user_logs']);
            }

            /**
             * Generate PDF
             * 
             */
            $fileName = Lang::get('User Activity Report') . " - " . $user->name . " " . now();
            return \PDF::loadView('pdf.UserActivityReports', compact(['logs', 'user']))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->setPaper('A4')
                ->stream( $fileName . '.pdf');

        
        } catch (\Exception $e) {
            /**
             * Define exception
             * message
             * 
             */
            {
                if(config('app.debug')) {
                    $exceptionMessage = $e->getMessage();
                } else {
                    $exceptionMessage = Lang::get("Error generating report. Please try again.");
                }
            }
            return redirect()->back()->with(['error' => Lang::get($exceptionMessage)]);
        }
    }
}
