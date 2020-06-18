<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function myTickets() 
    {
       
        /**
         * Pega a url base da api de suporte
         * 
         */
        $url = config('app.support_api');

        /**
         * Pega o endpoint + os parametros necessarios
         * 
         * (email do cliente // token de acesso)
         * 
         */
        $endpoint = "/tickets/" . auth()->user()->email;

        $key = config('app.support_api_key');

        $url = $url . $endpoint . "?token=" . $key;

        /**
         * Envia o request e pega a resposta
         * 
         */
        $response = file_get_contents($url);

        /**
         * Converte o json de resposta para um array
         * 
         */
        $tickets = json_decode($response, true); 

        return view('app.dashboard.support.index', [
            'tickets' => $tickets
        ]);
    }

    public function request()
    {
        return view('app.dashboard.support.request');
    }

    public function formResponse($ticketID)
    {
        return view('app.dashboard.support.response', [
            'ticketID' => $ticketID
        ]);
    }

    public function responseTicket($ticketID, Request $request)
    {
        $url = config('app.support_api');

        $key = config('app.support_api_key');

        $endpoint = "/tickets/responses/client/" . $ticketID;

        $url = $url . $endpoint;

        /**
         * Dados do request
         * 
         */
        $data = [
            'token' => $key,
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

        if($response["code"] === 201) {
            return redirect()->route('support.ticket.details', [$ticketID])->with(['success' => "Resposta enviada"]);
        }

        return redirect()->route('support.ticket.details', [$ticketID])->with(['error' => "Erro ao enviar resposta"]);
    }

    public function ticketDetails($ticketID)
    {

        $url = config('app.support_api');

        $key = config('app.support_api_key');

        $firstParameter = auth()->user()->email;

        $secondParameter = $ticketID;

        $endpoint = "/tickets/" . $firstParameter . "/" . $secondParameter . "?token=" . $key;

        $url = $url . $endpoint;

        /**
         * Send request
         * 
         */
        $response = file_get_contents($url);

        /**
         * Convert response in array
         * 
         */
        $response = \json_decode($response, true);

        $ticket = $response['data']['ticket'];

        $responsesFromSupport = $response['data']['responsesFromSupport'];

        $responsesFromClient = $response['data']['responsesFromClient'];

        return view('app.dashboard.support.showTicket', [
            'response' => $response, 'ticket' => $ticket,
            'responsesFromSupport' => $responsesFromSupport,
            'responsesFromClient' => $responsesFromClient,
        ]);
    }
}
