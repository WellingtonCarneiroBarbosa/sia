<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

/***
 * Change the app language
 * 
 */
Route::get('dash/configs/lang/{locale}', 'LocalizationController@index')->name('config.language');

/***
 * Start
 * Authenticated routes
 * 
 */
Route::group(['middleware' => ['auth']], function () {
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

            Route::post('/store', 'Schedules\ScheduleController@store')
                                              ->name('schedules.store');

            Route::get('/edit/{id}', 'Schedules\ScheduleController@edit')
                                                 ->name('schedules.edit');
                                                 
            Route::put('/update/{id}', 'Schedules\ScheduleController@update')
                                                   ->name('schedules.update');

            Route::delete('/cancel/{id}', 'Schedules\ScheduleController@cancel')
                                                      ->name('schedules.cancel');

            /***
             * Group for canceled 
             * schedules
             * 
             */
            Route::group(['prefix' => 'canceled'], function () {
                Route::get('/', 'Schedules\CanceledSchedulesController@index')
                                                  ->name('schedules.canceled');

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
            Route::get('/', function () {
                return 'ok';
            })->name('users.index');

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

            Route::get('/create', 'Places\PlaceController@create')
                                           ->name('places.create');

            Route::post('/store',  'Places\PlaceController@store')
                                            ->name('places.store');

        });

        /***
         * Group for customers routes
         * 
         */
        Route::group(['prefix' => 'customers'], function () {

            Route::get('/create', 'Customers\CustomerController@create')

                                              ->name('customers.create');

            Route::post('/store', 'Customers\CustomerController@store')
                                              ->name('customers.store');
                                              
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


