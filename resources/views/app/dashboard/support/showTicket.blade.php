@extends('layouts.dashboard')

@section('title', Lang::get('Show Ticket'))

@section('content')
@component('components.alert')@endcomponent
<div class="card">
    <div class="card-header">Visualizar Ticket</div>
    <div class="card-body">
        <ul id="tickets">
            @if($response['code'] == 200)
            @foreach($ticket as $ticket)
            <hr>
            <li>
                @php 
                $ticketID = $ticket['id'];
                @endphp
                Ticket ID => {{ $ticket['id'] }}
                <br>
                Descrição => {{ $ticket['message'] }}
                <br>
                Status =>
                @if($ticket['deleted_at'])
                Encerrado 
                @elseif($ticket['user_id'])
                Em andamento
                @else 
                Não visualizado
                @endif
                <br>
            </li>
            <hr>
            @endforeach
            @if(count($responsesFromSupport) > 0 )
            Resposta do suporte
            <li>
                @foreach($responsesFromSupport as $response) 
                Mensagem =>{{  $response['message'] }}
                @endforeach
                <br>
                <a href="{{ route('support.ticket.form.response', [$ticketID]) }}">Responder Suporte</a>
            </li> 
            @endif 
            <br>
            @if(count($responsesFromClient) > 0 )
            Resposta do cliente
            <li>
                @foreach($responsesFromClient as $response) 
                Mensagem =>{{  $response['message'] }}
                @endforeach
            </li> 
            @endif 
            @else 
            Não há nenhum ticket para exibir
            @endif
        </ul>
    </div>
</div>

@endsection
