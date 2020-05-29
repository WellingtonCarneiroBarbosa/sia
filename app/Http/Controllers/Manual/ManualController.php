<?php

namespace App\Http\Controllers\Manual;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManualController extends Controller
{
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
}