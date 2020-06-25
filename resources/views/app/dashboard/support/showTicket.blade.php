@extends('layouts.dashboard')

@section('title', Lang::get('Show Ticket'))

@section('content')
@component('components.alert')@endcomponent
<div class="card">
    <div class="card-header">
        @if(! $ticket['deleted_at'])
        <div class="float-right"><a href="{{ route('support.ticket.close', [$ticket['id']]) }}">Fechar ticket</a></div>
        @endif
        Visualizar Ticket
    </div>
    <div class="card-body">
        <ul id="tickets">
            @if($response['code'] == 200)
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
            @if(count($responses) > 0 )
            @if(! $ticket['deleted_at'])
            <a href="{{ route('support.ticket.form.response', [$ticketID]) }}">Enviar nova mensagem</a>
            <hr>
            @endif
            Histórico de mensagens:
            @foreach($responses as $response) 
            <li>
               
                @if($response['responsible_id'])
                Suporte: 
                @else 
                Você: 
                @endif
                 => {{  $response['message'] }}
            </li> 
            @endforeach
            @endif 
            @else 
            Não há nenhum ticket para exibir
            @endif
        </ul>
    </div>
</div>

@endsection
