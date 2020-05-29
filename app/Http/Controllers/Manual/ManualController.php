<?php

namespace App\Http\Controllers\Manual;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManualController extends Controller
{
<<<<<<< HEAD
public function index()
{
return view('app.dashboard.manual.index');
}
 
/**
 
 
* Schedules Manual Controller
 
 
*
 
 
*/
public function schedulesCreate()
{
return view('app.dashboard.manual.schedules.create');
}
=======
    public function index()
    {
        return view('app.dashboard.manual.index');
    }

    /**
    * Schedules Manual Controller
    *
    */
    public function schedulesCreate()
    {
        return view('app.dashboard.manual.schedules.create');
    }
>>>>>>> bcba2e8ccd4502af26c839a9e2462b99f4a378a6
}