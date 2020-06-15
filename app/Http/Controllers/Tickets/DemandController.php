<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tickets\Demand;

class DemandController extends Controller
{
    /**
     * Returns form to register a new
     * demand
     * 
     */
    public function create()
    {
        return view('app.dashboard.demand.create');
    }
}
