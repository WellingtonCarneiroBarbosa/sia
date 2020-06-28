@extends('layouts.dashboard')

@section('title', Lang::get('Dashboard'))

@section('styles')
    <link href='{{ asset("dashboard/libs/full-calendar/lib/main.css") }}' rel='stylesheet' />

    <script src='{{ asset("dashboard/libs/full-calendar/lib/main.js") }}'></script>
    <script src="{{ asset('dashboard/libs/full-calendar/lib/locales/pt-br.js') }}"></script>
    <script>
    $(document).ready(function () { 
        var calendarEl = document.getElementById('calendar');
        var data = "{{ $schedules }}";

        var calendar = new FullCalendar.Calendar(calendarEl, {
            
            @if(config('app.locale') != "pt-BR")
            locale: "en",
            @else 
            locale: "pt-br",
            @endif

            // Show modal action options
            eventClick: function(info) {
                // Get schedule ID 
                var scheduleID = info.event.id 

                // Get schedule action endpoints
                var showSchedule = "{{ url('dash/schedules/show') }}" + "/" + scheduleID;
                var editSchedule = "{{ url('dash/schedules/edit') }}" + "/" + scheduleID;
                var cancelSchedule = "{{ url('dash/schedules/confirm/cancel') }}" + "/" + scheduleID;

                //Set urls on modal buttons
                document.getElementById('show-schedule').href = showSchedule;
                document.getElementById('edit-schedule').href = editSchedule;
                document.getElementById('cancel-schedule').href = cancelSchedule;
                
                // Scroll to the modal
                window.scrollTo(0, 0);

                //Show modal
                return $('#modal-action').modal();
            },

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            initialDate: "{{ now() }}",
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: true,
            selectable: true,
            events: JSON.parse(data.replace(/&quot;/g,'"'))
        });

        calendar.render();
    });

    </script>
@endsection

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
                    <a href="{{ route('schedules.create') }}" class="btn btn-sm btn-neutral mb-2" id="novo-agendamento">{{ __("New") }}</a>
                    <a href="{{route('schedules.canceled')}}" class="btn btn-sm btn-neutral mb-2">{{ __("Canceled") }}</a>
                    <a href="#" data-toggle="modal" data-target="#modal-filter" id="filtros-agendamento" class="btn btn-sm btn-neutral mb-2 mr-2">{{ __("Filters") }}</a>
                    {{-- <a href="{{ route('schedules.generate.guestURL') }}" class="btn btn-sm btn-neutral mb-2">Gerar compartilhamento temporário</a> --}}
                    <a href="{{ route('schedules.historic.index') }}" class="btn btn-sm btn-neutral mb-2">{{ __("Historic") }}</a>
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
            <div class="espacol"></div>
                <div id='calendar'></div>
                {{-- @component('components.scheduleTable', ['schedules' => $schedules, 'now' => $now])@endcomponent --}}
            @else
                @component('components.noData', ['message' => Lang::get('We still have nothing to display. Click new and register an appointment')])@endcomponent
            @endif
        </div>
    </div>

    @component('components.modals.findSchedule', ['hasPlaces' => $hasPlaces, 'places' => $places])@endcomponent

    {{-- Action Modal --}}
    <div class="modal-filtros fade" id="modal-action" tabindex="-1" role="dialog" aria-labelledby="modal-action" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="espacol"></div>
                <div class="text-center">
                    <h3>{{ __("Selecione Uma Ação") }}</h3>
                </div>
                <div class="modal-body">
                    <!--options-->
    
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <center>
                                    <a href="#" id="show-schedule">
                                        <button class="btn btn-primary">{{ __("View more") }}</button>
                                    </a>
                                    <a href="#" id="edit-schedule">
                                        <button class="btn btn-primary">{{ __("Edit") }}</button>
                                    </a>
                                    <a href="#" id="cancel-schedule">
                                        <button class="btn btn-primary">{{ __("Cancel") }}</button>
                                    </a>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!--end options-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary  ml-auto" data-dismiss="modal">{{ __("Close") }}</button>
                </div>
            </div>
        </div>
    </div>

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