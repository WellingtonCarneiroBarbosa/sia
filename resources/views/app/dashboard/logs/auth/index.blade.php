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
    <h1>{{ __('Listing your latest') }} {{ $quantity_logs }} {{ __('system activities - max') }}: {{ $max_quantity_logs }}</h1>
    <ul>
        @foreach ($schedules_log as $log)
        <li>Você
            <strong>{{ $log->action }}</strong>
            um agendamento em <u>{{ dateTimeBrazilianFormat($log->created_at) }}</u>
        </li>
        @endforeach
    </ul>

    <hr>

    <ul>
        @foreach ($customers_log as $log)
        <li>Você
            <strong>{{ $log->action }}</strong>
            um cliente em <u>{{ dateTimeBrazilianFormat($log->created_at) }}</u>
        </li>
        @endforeach
    </ul>

    <hr>

    <ul>
        @foreach ($places_log as $log)
        <li>Você
            <strong>{{ $log->action }}</strong>
            um local em <u>{{ dateTimeBrazilianFormat($log->created_at) }}</u>
        </li>
        @endforeach
    </ul>
</div>
@endsection