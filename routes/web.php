<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    return view('app.home.index');
})->name('inicio');

Route::get('/about', function (){
    return view('app.home.about');
})->name('home.about');

Route::get('/exception/invalid/token', function () {
    return view('errors.invalidToken');
});


Auth::routes(['verify' => true]);

Route::get('/guest/{token}', function (Request $request){
    if (! $request->hasValidSignature()) {
        abort(401);
    }            

    return "Aq sera a tela de agendamentos para os convidados e tals. Essa tela é valida por 2 minutos.";
})->name('schedules.guest');

/***
 * Change the app language
 * 
 */
Route::get('dash/configs/lang/{locale}', 'LocalizationController@index')->name('config.language');

Route::get('/teste', function (){
    return "hm..";
})->middleware('verified');
/***
 * Start
 * Authenticated routes
 * 
 */
Route::group(['middleware' => ['web', 'auth', 'verified', 'completeProfile']], function () {
   

    /***
     * Start
     * Dashboard routes
     * 
     */
    Route::group(['prefix' => 'dash'], function () {
        
        Route::get('/manual/pdf', function (){
            $filename = 'manual.pdf';
            $path = storage_path($filename);

            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
            return response()->file('manual.pdf');
        });
        /**
         * Funcionalities
         * in beta
         * 
         */
        Route::group(['prefix' => 'beta'], function () {
            /**
             * Support routes
             * 
             */
            Route::namespace('Support')->group(function (){
                Route::prefix('support')->name('support.')->group(function (){

                    Route::get('/', 'SupportController@myTickets')->name('tickets');

                    Route::get('/request', 'SupportController@openTicketView')->name('request');

                    Route::get('/response/{ticketID}', 'SupportController@formResponse')->name('ticket.form.response');

                    Route::post('/response/{ticketID}', 'SupportController@responseTicket')->name('ticket.response');
                
                    Route::post('/request/send', 'SupportController@openTicket')->name('send.request');

                    Route::get('/ticket/{ticketID}/details', 'SupportController@ticketDetails')->name('ticket.details');
                
                    Route::get('/ticket/close/{ticketID}', 'SupportController@closeTicket')->name('ticket.close');
                });
            });
            
            /**
             * Schedules in calendar
             * form
             * 
             */
            Route::namespace('Schedules')->name('schedules.calendar.')->prefix('schedules')->group(function (){
                Route::get('/', 'ScheduleCalendarController@index')->name('index');
                Route::get('/schedule-list', 'ScheduleCalendarController@getSchedules')->name('list');
            
            });
        });
        /***
         * Route index of the dash
         * 
         */
        Route::get('/', 'HomeController@index')->name('home');

        /***
         * Group for schedules routes
         * 
         */
        Route::group(['prefix' => 'schedules'], function () {

            Route::get('/create', 'Schedules\ScheduleController@create')
                                              ->name('schedules.create');

            Route::get('/show/{id}', 'Schedules\ScheduleController@show')
                                                 ->name('schedules.show');                                             

            Route::post('/store', 'Schedules\ScheduleController@store')
                                              ->name('schedules.store');

            Route::get('/edit/{id}', 'Schedules\ScheduleController@edit')
                                                 ->name('schedules.edit');
                                                 
            Route::put('/update/{id}', 'Schedules\ScheduleController@update')
                                                   ->name('schedules.update');

            Route::delete('/cancel/{id}', 'Schedules\ScheduleController@cancel')
                                                      ->name('schedules.cancel');

            Route::put('/restore/{id}', 'Schedules\CanceledSchedulesController@restore')
                                                             ->name('schedules.restore');

            Route::delete('/permanently/delete/{id}', 'Schedules\CanceledSchedulesController@permanentlyDelete')
                                                                           ->name('schedules.permanentlyDelete');

            Route::get('/generate/guestURL', 'Schedules\ScheduleController@generateGuestURL')
                                                       ->name('schedules.generate.guestURL');

            /***
             * Group for canceled 
             * schedules
             * 
             */
            Route::group(['prefix' => 'canceled'], function () {

                Route::get('/', 'Schedules\CanceledSchedulesController@index')
                                                  ->name('schedules.canceled');

                Route::get('/show/{id}', 'Schedules\CanceledSchedulesController@show')
                                                     ->name('schedules.canceled.show');  

                /***
                 * Specific filter
                 * 
                 */
                Route::group(['prefix' => 'find/per'], function () {
                    
                    Route::any('/date-range', 'Schedules\FindCanceledScheduleController@dateRange')
                                                     ->name('schedules.canceled.findPer.dateRange');

                    Route::any('/date-and-place', 'Schedules\FindCanceledScheduleController@dateRangeAndPlace')
                                                              ->name('schedules.canceled.findPer.dateAndPlace');

                    Route::any('/specific-date', 'Schedules\FindCanceledScheduleController@uniqueDate')
                                                      ->name('schedules.canceled.findPer.specificDate');
                });
            });

            /***
             * Group for confirm 
             * actions
             * 
             */
            Route::group(['prefix' => 'confirm'], function () {
                
                Route::get('/cancel/{id}', 'Schedules\ScheduleController@confirmCancel')
                                                      ->name('schedules.confirm.cancel');

                Route::get('/restore/{id}', 'Schedules\CanceledSchedulesController@confirmRestore')
                                                                ->name('schedules.confirm.restore');

                Route::get('/permanently/delete/{id}', 'Schedules\CanceledSchedulesController@confirmPermanentlyDelete')
                                                                           ->name('schedules.confirm.permanentlyDelete');                                                       

            });

            /***
             * Group for filters
             * 
             */
            Route::group(['prefix' => 'find'], function () {
                /***
                 * Specific filter
                 * 
                 */
                Route::group(['prefix' => 'per'], function () {
                    
                    Route::any('/date-range', 'Schedules\FindScheduleController@dateRange')
                                                      ->name('schedules.findPer.dateRange');

                    Route::any('/date-and-place', 'Schedules\FindScheduleController@dateRangeAndPlace')
                                                        ->name('schedules.findPer.dateAndPlace');

                    Route::any('/specific-date', 'Schedules\FindScheduleController@uniqueDate')
                                                       ->name('schedules.findPer.specificDate');
                });
            });

            /**
             * Routes for historic schedules
             * 
             */
            Route::group(['prefix' => 'historic'], function () {
                
                Route::get('/', 'Schedules\HistoricController@index')
                                   ->name('schedules.historic.index');

                Route::get('/show/{id}', 'Schedules\HistoricController@show')
                                            ->name('schedules.historic.show');

            });
            //
        });

        /***
         * Group for users routes
         * 
         */
        Route::group(['prefix' => 'users'], function () {

            Route::get('/', 'Users\SystemUserController@index')
                                          ->name('users.index');

            Route::get('show/{id}', 'Users\SystemUserController@show')
                                                  ->name('users.show');

            /**
             * Only admins and superior
             * can access this!
             * 
             */
            Route::group(['middleware' => 'admin'], function () {

                Route::get('create', 'Users\SystemUserController@create')
                                                   ->name('users.create');

                Route::post('/store', 'Users\SystemUserController@store')
                                                    ->name('users.store');

                Route::get('edit/{id}', 'Users\SystemUserController@edit') 
                                       ->middleware('isIDEqualAuthUserId')
                                                      ->name('users.edit');

                Route::put('update/{id}', 'Users\SystemUserController@update')
                                            ->middleware('isIDEqualAuthUserId')
                                                        ->name('users.update');

                Route::get('/confirm-disable/{id}', 'Users\SystemUserController@confirmDestroy')
                                                             ->middleware('isIDEqualAuthUserId')
                                                                  ->name('users.confirmDestroy');

                Route::delete('/disable/{id}', 'Users\SystemUserController@destroy')
                                                    ->middleware('isIDEqualAuthUserId')
                                                             ->name('users.destroy');

                Route::get('/confirm-restore/{id}', 'Users\SystemUserController@confirmRestore')
                                                             ->middleware('isIDEqualAuthUserId')
                                                                  ->name('users.confirmRestore');

                Route::put('/restore/{id}', 'Users\SystemUserController@restore')
                                              ->middleware('isIDEqualAuthUserId')
                                                          ->name('users.restore');

            });

            /***
             * Group for authenticated user
             * 
             */
            Route::group(['prefix' => 'my-profile'], function () {

                Route::get('/', 'Users\AuthedUserController@showMyProfile')
                                                  ->name('myProfile.index');

            });
        });

        /***
         * Group for places routes
         * 
         */
        Route::group(['prefix' => 'places'], function () {

            Route::get('/', 'Places\PlaceController@index')
                                     ->name('places.index');


            Route::get('/show/{id}', 'Places\PlaceController@show')
                                              ->name('places.show');


            Route::any('/availability/', 'Places\FindPlacesController@findPerDateRange')
                                                           ->name('places.availability'); 

            /**
             * Only admins can
             * access this!
             * 
             */
            Route::group(['middleware' => 'admin'], function () {
                
                Route::get('/edit/{id}', 'Places\PlaceController@edit')
                                                  ->name('places.edit');

                Route::put('/update/{id}',  'Places\PlaceController@update')
                                                     ->name('places.update');

                Route::get('/create', 'Places\PlaceController@create')
                                               ->name('places.create');

                Route::post('/store',  'Places\PlaceController@store')
                                                ->name('places.store');

                Route::delete('/delete/{id}',  'Places\PlaceController@destroy')
                                                         ->name('places.delete');

                /***
                 * Confirm any action
                 * routes
                 * 
                 */
                Route::group(['prefix' => 'confirm'], function () {

                    Route::get('/delete/{id}', 'Places\PlaceController@confirmDestroy')
                                                        ->name('places.confirm.delete');

                });
            });
        });

        /***
         * Group for customers routes
         * 
         */
        Route::group(['prefix' => 'customers'], function () {

            Route::get('/', 'Customers\CustomerController@index')
                                        ->name('customers.index');

            Route::get('/create', 'Customers\CustomerController@create')
                                              ->name('customers.create');

            Route::post('/store', 'Customers\CustomerController@store')
                                              ->name('customers.store');

            Route::get('/show/{id}', 'Customers\CustomerController@show')
                                                 ->name('customers.show');

            Route::get('edit/{id}', 'Customers\CustomerController@edit')
                                                ->name('customers.edit');

            Route::put('update/{id}', 'Customers\CustomerController@update')
                                                  ->name('customers.update');

            Route::get('confirm/delete/{id}', 'Customers\CustomerController@confirmDestroy')
                                                          ->name('customers.confirm.delete');

            Route::delete('delete/{id}', 'Customers\CustomerController@destroy')
                                                     ->name('customers.destroy');


            /**
             * Filter routes
             * 
             */
            Route::group(['prefix' => 'filter'], function () {
                
                Route::any('/corporation', 'Customers\FindCustomerController@corporation')
                                                      ->name('customers.find.corporation');

            });


            /**
             * Deleted Customer
             * methods
             * 
             */
            Route::group(['prefix' => 'deleted'], function () {

                Route::get('/', 'Customers\DeletedCustomer@index')
                                       ->name('customers.deleted'); 

                /**
                 * Filter Routes
                 * 
                 */
                Route::group(['prefix' => 'filter'], function () {

                    Route::any('/corporation', 'Customers\FindDeletedCustomerController@corporation')
                                                         ->name('customers.deleted.find.corporation');
                                                         
                });          
            });
        });

        /***
         * Group for logs
         * 
         */
        Route::group(['prefix' => 'logs'], function () {

            /**
             * Logs for auth user
             * 
             */
            Route::group(['prefix' => 'me'], function () {
                Route::get('/', 'Logs\AuthUserLogController@index')
                                                  ->name('logs.me');
            });

            /**
             * Logs for other users
             * 
             */
            Route::group(['prefix' => 'user', 'middleware' => 'admin'], function () {
                Route::get('/{id}', 'Logs\UserLogController@index')
                                                ->name('logs.user');
            });

        });

        /***
         * Group for feedbacks
         * 
         */
        Route::group(['prefix' => 'feedback'], function () {
            Route::get('/create', function () {
                return 'ok';
            })->name('feedback.create');
        });

        /**
         * Group for chat
         * 
         */
        Route::namespace('Chats')->prefix('chat')->name('chat.')->group(function (){

            Route::get('/', 'ChatController@index')->name('index');

            Route::get('/message/{id}', 'ChatController@getMessage')->name('message');

            Route::post('message', 'ChatController@sendMessage');

            Route::get('/debug', function (){
                return view('app.dashboard.chat.send');
            });

        });

        /***
         * Statistics route
         * 
         */
        Route::group(['prefix' => 'statistics', 'middleware' => 'admin'], function () {

            Route::get('/', 'Statistics\StatisticController@index')
                                               ->name('statistics'); 
                                               
            Route::post('/specific-date', 'Statistics\StatisticController@specificDate')
                                                       ->name('statistics.specificDate');

        });
        

        /**
         * Manual Routes
         * 
         */
        Route::group(['prefix' => 'manual'], function () {

            Route::get('/', 'Manual\ManualController@index')
                                      ->name('manual.index');
                                      
            /**
             * Schedules manual
             * 
             */
            Route::group(['prefix' => 'schedules'], function () {

                Route::get('/create',  'Manual\ManualController@schedulesCreate')
                                                ->name('manual.schedules.create'); 
                                                
            });

            Route::group(['prefix' => 'places'], function () {
                Route::get('/create',  'Manual\ManualController@schedulesCreate')
                                                ->name('manual.places.create'); 
            });
        });

        /**
         * Reports routes
         * 
         */
        Route::namespace('Reports')->prefix('reports')->name('reports.')->group(function (){
            Route::group(['prefix' => 'activities'], function (){
                Route::post('user/{userID}', 'UserActivityReportController@generate')->name('generate.user');
            });
        });

        /**
         * Configs Routes
         * 
         */
        Route::namespace('Configuration')->prefix('configuration')->name('config.')->group(function () {
            Route::get('/', 'ConfigurationController@index')->name('index');

            Route::get('email-notification', 'EmailConfigurationController@emailNotification')
                                                                  ->name('email.notification');
        });
    });
    /***
     * End
     * Dashboard routes
     * 
     */
});
/***
 * End
 * Authenticated routes
 * 
 */

/**
 * Complete profile routes
 * 
 */
 Route::group(['middleware' => ['web', 'auth', 'verified', 'notCompletedProfileYet'], 'prefix' => 'complete-profile'], function () {

    Route::get('/', 'Users\CompleteProfileController@index')
                            ->name('complete.profile.index');

    Route::get('stage-1', 'Users\CompleteProfileController@stageOne')
                                  ->name('complete.profile.stageOne');

    Route::get('stage-2', 'Users\CompleteProfileController@stageTwo')
                                  ->name('complete.profile.stageTwo');

    Route::get('stage-3', 'Users\CompleteProfileController@stageThree')
                                  ->name('complete.profile.stageThree');


    Route::group(['prefix' => 'store'], function () {
        Route::post('/stage-1', 'Users\CompleteProfileController@storeStageOne')
                                        ->name('complete.profile.storeStageOne');

        Route::post('/stage-2', 'Users\CompleteProfileController@storeStageTwo')
                                        ->name('complete.profile.storeStageTwo');

        Route::post('/stage-3', 'Users\CompleteProfileController@storeStageThree')
                                        ->name('complete.profile.storeStageThree');
    });
 });


