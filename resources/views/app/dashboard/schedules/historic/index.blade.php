@extends('layouts.dashboard')

@section('title', Lang::get('Historic Schedules'))

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Historic Schedules") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-neutral mb-2" id="novo-agendamento">{{ __("Go back to schedule's list") }}</a>
                </div>
            </div>
            <!-- fim do header -->
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <!-- alertas -->
    @component('components.alert')@endcomponent

    <div class="row">
        <div class="col-xl-12">
            @if($hasSchedules)
                @component('components.historicScheduleTable', ['schedules' => $schedules])@endcomponent
            @else
                @component('components.noData', ['message' => Lang::get('We still have nothing to display. Here, expired and invalid schedules will be displayed')])@endcomponent
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