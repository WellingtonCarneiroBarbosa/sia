@extends('layouts.dashboard')

@section('title', Lang::get('Dashboard'))

@section('styles')
    <link href='{{ asset("dashboard/libs/full-calendar/lib/main.css") }}' rel='stylesheet' />

    <script src='{{ asset("dashboard/libs/full-calendar/lib/main.js") }}'></script>
    <script src="{{ asset('dashboard/libs/full-calendar/lib/locales/pt-br.js') }}"></script>

    <script>
    $(document).ready(function () { 
        function formatDate (input) {
            var datePart = input.match(/\d+/g),
            year = datePart[0].substring(2), // get only two digits
            month = datePart[1], day = datePart[2];
          
            return day+'/'+month+'/'+year;
        }

        var calendarEl = document.getElementById('calendar');
        var data = "{{ $schedules }}";

        data = data.replace(/&quot;/g,'"')
        //if schedule confirmed, color = green
        data = data.replace(/"status":"1"/g, '"color":"#28a745"')
        //if schedule on budge, color = orange
        data = data.replace(/"status":null/g, '"color":"#ffc107"')
     
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

                // Get schedule infos 
                var scheduleInfoUrl = "{{ url('dash/schedules/info') }}" + "/" + scheduleID

                $(function(){
                    $.ajax({
                        url: scheduleInfoUrl,
                        method: "GET", 

                        success: function (data) {
                            var place = data.scheduling_place.name
                            var customer = data.scheduling_customer.corporation
                            var start = data.start
                            var end = data.end 
                            var details = data.details
                            if(details == null) 
                                details = "{{ Lang::get('Nothing to show') }}"

                             // get modal options 
                            document.getElementById('schedule-modal-title').innerHTML = info.event.title;
                            document.getElementById('schedule-modal-place').innerHTML = place;
                            document.getElementById('schedule-modal-start').innerHTML = start;
                            document.getElementById('schedule-modal-end').innerHTML = end;
                            document.getElementById('schedule-modal-customer').innerHTML = customer;
                            document.getElementById('schedule-modal-details').innerHTML = details;
                        }
                    })
                })

                var title = info.event.title; 
                var place = info.event.place_id;

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
            events: JSON.parse(data)
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
        <div class="col-12">
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
                                <hr>
                                <div class="row">
                                    <ul>
                                        <li><strong>{{ __("Title") }}: </strong><span id="schedule-modal-title"></span></li>
                                        <li><strong>{{ __("Place") }}: </strong><span id="schedule-modal-place"></span></li>
                                        <li><strong>{{ __("Start") }}: </strong><span id="schedule-modal-start"></span></li>
                                        <li><strong>{{ __("End") }}: </strong><span id="schedule-modal-end"></span></li>
                                        <li><strong>{{ __("Customer") }}: </strong><span id="schedule-modal-customer"></span></li>
                                        <li><strong>{{ __("Details") }}: </strong><span id="schedule-modal-details"></span></li>
                                    </ul>
                                </div>
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