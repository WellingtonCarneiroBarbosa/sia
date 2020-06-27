@extends('layouts.dashboard')

@section('title', Lang::get('Logs'))

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
    @component('components.alert')@endcomponent
    
    @if($quantity_logs > 0)

        <h1>{{ $title }}</h1>

        <a href="#" data-toggle="modal" data-target="#modal-filter" id="filtros-locais" class="btn btn-sm btn-neutral mb-2 mr-2">{{ __("Gerar relatório de atividade") }}</a>

        @component('components.modals.userActivityReport', ['user' => $user])@endcomponent
  
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

@section('scripts')
    <!--plugins-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
    <script src="{{ asset('js/plugins/maskNumber/dist/jquery.masknumber.min.js') }}"></script>
    <script>
        /**
         * Masks
         * 
         */
        (function( $ ) {
            $(function() {
                $('.date').mask('00/00/0000');
            });
        })(jQuery);
    </script>

@endsection