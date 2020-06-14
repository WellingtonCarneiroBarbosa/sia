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

    /**
     * Trata os dados dos logs
     * dos usuarios
     *
     */
    foreach($users_log as $log)
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
                $log->action = Lang::get('deactivated');
                break;
            case 4: 
                $log->action = Lang::get('enabled');
                break;
        } 
    }
@endphp 

@section('content')
<div class="container">
    <div class="espaco"></div>
    @if($quantity_logs > 0)
        <h1>{{ $title }}</h1>

        @component('components.logsBody', [
            'user' => $user_name, 'users_log' => $users_log,
            'schedules_log' => $schedules_log, 'customers_log' => $customers_log,
            'places_log' => $places_log
            ])
            
        @endcomponent
        
    @else 
        @component('components.noData', ['message' => $noDataMessage])@endcomponent
    @endif
</div>
@endsection