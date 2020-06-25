<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lang;

class SupportController extends Controller
{

    public function __construct()
    {
        $this->url = config('app.support_api');
        $this->token = "?token=" . config('app.support_api_key');
    }

    public function myTickets() 
    {
       
        $endpoint = "/tickets/" . auth()->user()->email;

        $url = $this->url . $endpoint . $this->token;

        $response = file_get_contents($url);

        $tickets = json_decode($response, true); 

        return view('app.dashboard.support.index', [
            'tickets' => $tickets
        ]);
    }

    public function openTicket(Request $request) {
        $data = $request->all();

        $data['name'] = auth()->user()->name; 
        $data['email'] = auth()->user()->email;

        $endpoint = "/tickets";

        $url = $this->url . $endpoint . $this->token;

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => "POST",
                'content' => \http_build_query($data)
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        $response = \json_decode($response, true);

        if($response['code'] != 201) {
            return redirect()->back()->withInput()->with(['error' => Lang::get('Error opening ticket')]);

        } 

        return redirect()->back()->with(['status' => Lang::get('Ticket opened')]);
    }

    public function openTicketView() {
        $endpoint = "/demands";

        $url = $this->url . $endpoint . $this->token;

        $response = \file_get_contents($url);

        $demands = \json_decode($response, true);

        return view('app.dashboard.support.request', [
            'demands' => $demands['data']
        ]);
    }

    public function formResponse($ticketID)
    {
        return view('app.dashboard.support.response', [
            'ticketID' => $ticketID
        ]);
    }

    public function responseTicket($ticketID, Request $request)
    {
        $endpoint = "/tickets/client-response";

        $url = $this->url . $endpoint . $this->token;

        /**
         * Dados do request
         * 
         */
        $data = [
            'ticket_id' => $ticketID,
            'message' => $request->message
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => "POST",
                'content' => \http_build_query($data)
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        $response = \json_decode($response, true);

        if($response["code"] != 201) {
            return redirect()->route('support.ticket.details', [$ticketID])->with(['error' => "Erro ao enviar resposta"]);
        }

        return redirect()->route('support.ticket.details', [$ticketID])->with(['status' => "Resposta enviada"]);
    }

    public function ticketDetails($ticketID)
    {
        $endpoint = "/tickets/info/" . $ticketID;

        $url = $this->url . $endpoint . $this->token;

        $response = file_get_contents($url);

        $response = \json_decode($response, true);

        $ticket = $response['data']['ticket_infos'];

        $ticket_client = $response['data']['ticket_infos']['client'];

        $ticket_demand = $response['data']['ticket_infos']['demand'];

        $responses = $response['data']['ticket_responses'];

        return view('app.dashboard.support.showTicket', [
            'ticket' => $ticket, 'responses' => $responses,
            'ticket_client' => $ticket_client,
            'ticket_demand' => $ticket_demand,
            'response' => $response,
        ]);
    }

    public function closeTicket($ticketID)
    {
        $endpoint = "/tickets/close/" . $ticketID;

        $url = $this->url . $endpoint . $this->token;

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => "DELETE"
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        $response = \json_decode($response, true);

        dd($response);

        if($response["code"] != 201) {
            return redirect()->route('support.ticket.details', [$ticketID])->with(['error' => "Erro ao enviar resposta"]);
        }

        return redirect()->route('support.ticket.details', [$ticketID])->with(['status' => "Resposta enviada"]);
    }
}
