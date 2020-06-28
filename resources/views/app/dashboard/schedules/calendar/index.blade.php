@extends('layouts.dashboard')

@section('title', Lang::get("Schedule's List"))

@section('styles')
    <link href='{{ asset("dashboard/libs/full-calendar/lib/main.css") }}' rel='stylesheet' />

    <script src='{{ asset("dashboard/libs/full-calendar/lib/main.js") }}'></script>
    <script src="{{ asset('dashboard/libs/full-calendar/lib/locales/pt-br.js') }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var showScheduleInfosUrl = "{{ url('dash/schedules/show') }}";
        var data = "{{ $schedules }}";

        var calendar = new FullCalendar.Calendar(calendarEl, {
            
            @if(config('app.locale') != "pt-BR")
            locale: "en",
            @else 
            locale: "pt-br",
            @endif

            // Redirect to more details on click
            eventClick: function(info) {
                var id = info.event.id
                showScheduleInfosUrl = showScheduleInfosUrl + "/" + id;
                return window.open(showScheduleInfosUrl, '_blank');
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
<div class="container">
    <div class="espaco"></div>
    <div id='calendar'></div>
</div>

@endsection

