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
Route::group(['middleware' => ['web', 'auth', 'verified']], function () {
    /***
     * Start
     * Dashboard routes
     * 
     */
    Route::group(['prefix' => 'dash'], function () {
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
            //
        });

        /***
         * Group for users routes
         * 
         */
        Route::group(['prefix' => 'users'], function () {

            Route::get('/', 'Users\SystemUserController@index')
                                          ->name('users.index');

            Route::get('create', 'Users\SystemUserController@create')
                                                ->name('users.create')
                                                 ->middleware('admin'); 

            Route::post('/store', 'Users\SystemUserController@store')
                                                ->name('users.store')
                                                ->middleware('admin');
            
            Route::get('edit/{id}', 'Users\SystemUserController@edit')
                                                  ->name('users.edit');

            Route::put('update/{id}', 'Users\SystemUserController@update')
                                                    ->name('users.update');

            Route::get('/confirm-disable/{id}', 'Users\SystemUserController@confirmDestroy')
                                                              ->name('users.confirmDestroy');
            
            Route::delete('/disable/{id}', 'Users\SystemUserController@destroy')
                                                         ->name('users.destroy');

            Route::get('/confirm-restore/{id}', 'Users\SystemUserController@confirmRestore')
                                                              ->name('users.confirmRestore');

            Route::put('/restore/{id}', 'Users\SystemUserController@restore')
                                                      ->name('users.restore');

            Route::get('show/{id}', 'Users\SystemUserController@show')
                                                  ->name('users.show');

            /***
             * Group for authenticated user
             * 
             */
            Route::group(['prefix' => 'my-profile'], function () {
                Route::get('/', function (){
                    return 'ok';
                })->name('myProfile.index');
            });
        });

        /***
         * Group for places routes
         * 
         */
        Route::group(['prefix' => 'places'], function () {

            Route::get('/', 'Places\PlaceController@index')
                                     ->name('places.index');

            Route::get('/edit/{id}', 'Places\PlaceController@edit')
                                              ->name('places.edit');

            Route::get('/show/{id}', 'Places\PlaceController@show')
                                              ->name('places.show');

            Route::put('/update/{id}',  'Places\PlaceController@update')
                                                  ->name('places.update');
  
            Route::get('/create', 'Places\PlaceController@create')
                                           ->name('places.create');

            Route::post('/store',  'Places\PlaceController@store')
                                            ->name('places.store');

            Route::delete('/delete/{id}',  'Places\PlaceController@destroy')
                                                     ->name('places.delete');

            Route::any('/availability/', 'Places\FindPlacesController@findPerDateRange')
                                                           ->name('places.availability');                                                    

            Route::group(['prefix' => 'confirm'], function () {
                Route::get('/delete/{id}', 'Places\PlaceController@confirmDestroy')
                                                   ->name('places.confirm.delete');
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
                                              
        });

        /***
         * Group for logs
         * 
         */
        Route::group(['prefix' => 'logs'], function () {
            Route::get('/me', function () {
                return 'ok';
            })->name('myLogs');
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
        Route::group(['prefix' => 'chat'], function () {

            Route::get('/', 'Chats\ChatController@index')
                                     ->name('chat.index');

            Route::get('/contacts', 'Chats\ChatController@fetchContacts');

            Route::get('/conversation/{id}', 'Chats\ChatController@fetchMessages');
        });

        /***
         * Statistics route
         * 
         */
        Route::get('/statistics', function (){
            return 'ok';
        })->name('statistics');
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


