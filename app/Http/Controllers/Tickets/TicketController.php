<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\Demand;

class TicketController extends Controller
{
    /**
     * Request a new ticket
     * 
     */
    public function request(){
        return view('app.dashboard.tickets.request');
    }
}
