@extends('layouts.dashboard')

@section('title', Lang::get('My Activity'))

@php 
    $created = Lang::get('registered');
    $updated = Lang::get('updated');
    $canceled = Lang::get('revoked');
    $restored = Lang::get('restored');
    $forceDeleted = Lang::get('deleted');

    /**
    * Trata os dados dos logs
    * dos agendamentos
    * 
    */
    foreach($schedules_log as $log)
    {
        switch($log->action)
        {
            case 1: 
                $log->action = $created;
                break;
            case 2: 
                $log->action = $updated;
                break;
            case 3:
                $log->action = $canceled;
                break;
            case 4: 
                $log->action = $restored;
                break; 
            case 5: 
                $log->action = $forceDeleted;
                break;
        } 
    }

    /**
    * Trata os dados dos logs
    * dos clientes
    * 
    */
    foreach($customers_log as $log)
    {
        switch($log->action)
        {
            case 1: 
                $log->action = $created;
                break;
            case 2: 
                $log->action = $updated;
                break;
            case 3:
                $log->action = $forceDeleted;
                break;
        } 
    }

    /**
    * Trata os dados dos logs
    * dos locais
    * 
    */
    foreach($places_log as $log)
    {
        switch($log->action)
        {
            case 1: 
                $log->action = $created;
                break;
            case 2: 
                $log->action = $updated;
                break;
            case 3:
                $log->action = $forceDeleted;
                break;
        } 
    }
@endphp 

@section('content')
<div class="container">
    <div class="espaco"></div>
    @if(count($schedules_log) > 0)
        <h1>{{ __('Listing your latest') }} {{ $quantity_logs }} {{ __('system activities - max') }}: {{ $max_quantity_logs }}</h1>
    
        <hr>
        <ul>
            @foreach ($schedules_log as $log)
            <li>{{ __("You") }}
                <strong>{{ $log->action }}</strong>
                {{ __("a schedule") }} <u>{{ $log->created_at->diffForHumans() }}</u>
                -
                @if($log->schedule_id && $log->schedule_log['id'])
                    <a href="{{ route('schedules.show', ['id' => $log->schedule_id]) }}">Visualizar agendamento</a>
                @elseif($log->schedule_id)
                    <a href="{{ route('schedules.historic.show', ['id' => $log->schedule_id]) }}">Visualizar agendamento</a>
                @else
                    <i>Visualização não disponível</i>
                @endif
            </li>
            @endforeach
        </ul>
 


        <hr>
        <ul>
            @foreach ($customers_log as $log)
            <li>{{ __("You") }}
                <strong>{{ $log->action }}</strong>
                {{ __("a customer") }} <u>{{ $log->created_at->diffForHumans() }}</u>
                -
                <a href="{{ route('customers.show', ['id' => $log->customer_id]) }}">Visualizar cliente</a>
            </li>
            @endforeach
        </ul>
  


        <hr>
        <ul>
            @foreach ($places_log as $log)
            <li>{{ __("You") }}
                <strong>{{ $log->action }}</strong>
                {{ __("a place") }} <u>{{ $log->created_at->diffForHumans() }}</u>
                -
                @if($log->place_id)
                    <a href="{{ route('places.show', ['id' => $log->place_id]) }}">Visualizar local</a>
                @else
                    <i>Visualização não disponível</i>
                @endif
                @endforeach
            </li>   
        </ul>
    @else 
    @component('components.noData', ['message' => Lang::get('You have not yet performed any activity on the system')])@endcomponent
    @endif
</div>
@endsection