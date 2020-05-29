@extends('layouts.dashboard')

@section('title', 'Resultado da Pesquisa')

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Schedules") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-neutral mb-2">{{ __("Come back to schedules") }}</a>
                    <a href="#" data-toggle="modal" data-target="#modal-filter" id="filtros-agendamento" class="btn btn-sm btn-neutral mb-2 mr-2">{{ __("Another Search") }}</a>
                </div>
            </div>
            <!-- fim do header -->
        </div>
    </div>
</div>

<!-- tabela de agendamentos -->

<div class="container-fluid mt--6">
    <!-- conteudo da pagina -->

    @if(!$hasSchedules)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-inner--text"><i class="fas fa-thumbs-down mr-2"></i><strong> {{ __("Opps") }}...</strong>{{ $response }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <div class="espaco"></div>
    <div class="espaco"></div>
    <center>
        <img style="width: 70%; " src="{{ asset('dashboard/assets/img/brand/team/semdados.png') }}" alt="{{ __("team") }}">
    </center>
    @endif

    <div class="row">
        <div class="col-xl-12">
            @if($hasSchedules)
                @component('components.scheduleTable', ['schedules' => $schedules, 'now' => $now])@endcomponent
            @endif
        </div>
    </div>

    @component('components.modals.findSchedule', ['hasPlaces' => $hasPlaces, 'places' => $places])@endcomponent
    
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>

<script>
    (function( $ ) {
        $(function() {
            $('.date').mask('00/00/0000');
        });
    })(jQuery);
</script>

@endsection