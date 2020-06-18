@extends('layouts.dashboard')

@section('title', Lang::get('Your Tickets'))

@section('content')
@component('components.alert')@endcomponent
<div class="card">
    <div class="card-header">Seus Tickets</div>
    <div class="card-body">
        <ul id="tickets">
            @if($tickets['code'] == 200)
            @foreach($tickets['data'] as $ticket)
            <hr>
            <li>
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
                <a href="{{ route('support.ticket.details', [$ticket['id']]) }}">Visualizar andamento</a>
            </li>
            <hr>
            @endforeach
            @else 
            Não há nenhum ticket para exibir
            @endif
        </ul>
    </div>
</div>

@endsection
