<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!--
    -- Meta Tags
    --
    -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ __("Manage your appointments with a modern and functional application") }}">
    <meta name="author" content="Evolue IT">

    <!-- Styles -->
    <link href="{{ asset('dashboard/assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/argon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet" />

    <!--
    -- Favicon
    --
    -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('home/assets/img/brand/siaLogo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('home/assets/img/brand/siaLogo.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Convidado - {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

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
                
                locale: "pt-br",

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

            calendar.render()

        });
    </script>

</head>

<body>
    <!--page loader-->
    <div id="pageloader">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    </div>

    <!-- top nav -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid"></div>
                <div class="collapse navbar-collapse" id="hideNav">
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img src="https://www.auctus.com.br/wp-content/uploads/2017/09/sem-imagem-avatar.png">                        
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">Convidado</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="app">
           <div class="container">
            @if($hasSchedules)
            <div class="espacol"></div>
                <div id='calendar'></div>
            @else
                @component('components.noData', ['message' => 'Não há nenhum agendamento para exibir.'])@endcomponent
            @endif
           </div>
        </div>
        
   
        <hr>
        <footer class="footer pt-0">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="copyright text-center  text-lg-left  text-muted">
                        &copy; {{ now()->year }} <a href="https://www.facebook.com/Evolue-it-114357466615105/" class="font-weight-bold ml-1" target="_blank">Evolue IT</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a class="nav-link">{{ __("Thank you for supporting us") }}!</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home.about') }}" class="nav-link" title="{{ __('Click to know more about the system') }}" target="_blank">{{ __("About the Project") }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('dash/manual/pdf') }}" title="{{ __('Click to view usage documentation') }}" class="nav-link" target="_blank">{{ __("How To Use") }}?</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>

    </div>
    
    <script src="{{ asset('js/loader/main.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/argon.min.js?v=1.2.0') }}"></script>
</body>

</html>