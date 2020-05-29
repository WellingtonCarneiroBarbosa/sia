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
    <link href="{{ asset('dashboard/assets/css/argon.css?v=1.2.0') }}" rel="stylesheet">
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet" />

    <!--
    -- Favicon
    --
    -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('home/assets/img/brand/siaLogo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('home/assets/img/brand/siaLogo.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

    @yield('styles')
</head>

<body>
    <!--page loader-->
    <div id="pageloader">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    </div>

    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header align-items-center" style="margin-bottom: 2em;">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{asset('dashboard/assets/img/brand/siaLogo.png')}}" class="navbar-brand-img" alt="{{ config('app.name', 'Laravel') }}"><span class="ml-2">{{ config('app.name', 'Laravel') }}</span>
                </a>
            </div>
            <!-- Divider -->
            <hr class="my-3">
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">

                        <!--Agendamentos - left -->
                        <li class="nav-item">
                            <a class="nav-link {{request()->routeIs('schedules*') ? 'active' : (request()->routeIs('home') ? 'active' : '' )}}" href="{{route('home')}}">
                                <i class="fa fa-calendar text-primary"></i>
                                <span title="{{ __(" Click to manage the appointments ") }}" class="nav-link-text">{{ __("Schedules") }}</span>
                            </a>
                        </li>
                        <!-- Fim Agendamentos - left -->

                        <!--Usuários - left -->
                        <li class="nav-item">
                            <a class="nav-link {{request()->routeIs('users*') ? 'active' : ''}}" href="{{route('users.index')}}">
                                <i class="ni ni-circle-08 text-primary"></i>
                                <span title="{{ __(" Click to manage the users ") }}" class="nav-link-text">{{ __("Users") }}</span>
                            </a>
                        </li>
                        <!-- Fim Usuários - left -->

                        <!--Locais - left -->
                        <li class="nav-item">
                            <a class="nav-link {{request()->routeIs('places*') ? 'active' : ''}}" href="{{ route('places.index') }}">
                                <i class="fa fa-map text-primary"></i>
                                <span title="{{ __("Click to manage the places") }}" class="nav-link-text">{{ __("Places") }}</span>
                            </a>
                        </li>
                        <!-- Fim Locais - left -->

                        <!--clientes - left -->
                        <li class="nav-item">
                            <a class="nav-link {{request()->routeIs('customers*') ? 'active' : ''}}" href="{{ route('customers.index') }}">
                                <i class="ni ni-briefcase-24 text-primary"></i>
                                <span title="{{ __("Click to manage the customers") }}" class="nav-link-text">{{ __("Customers") }}</span>
                            </a>
                        </li>
                        <!-- Fim clientes - left -->

                        @if(auth()->user()->role_id >= 5)
                        <li class="nav-item">
                            <a class="nav-link {{request()->routeIs('statistics') ? 'active' : ''}}" href="{{ route('statistics') }}">
                                <i class="fa fa-chart-line text-primary"></i>
                                <span title="{{ __("Click to go to the statistics") }}" class="nav-link-text">{{ __("Statistics") }}</span>
                            </a>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- fim do sidenav -->

    <!-- top nav -->
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->
                    <form class="navbar-search navbar-search-light form-inline mr-sm-3 form-loader" id="navbar-search-main">
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control" placeholder="{{ __("Search This Page") }}" type="text">
                            </div>
                        </div>
                        <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                                <span aria-hidden="true">×</span>
                        </button>
                    </form>
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-chat-round"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                                <!-- Dropdown header -->
                                <div class="px-3 py-3">
                                    <h6 class="text-sm text-muted m-0">{{ __("You have") }}<strong class="text-primary ml-2 mr-2">1</strong> {{ __("unread conversations") }}.</h6>
                                </div>
                                <!-- List group -->
                                <div class="list-group list-group-flush">
                                    <a href="#!" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder" src="{{asset('dashboard/assets/img/theme/team-1.jpg')}}" class="avatar rounded-circle">
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">Marcelo Gabriel</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small>2 hrs {{ __("ago") }}</small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0">{{ __("Don't forget, meeting at 3pm") }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- View all -->
                                <a href="#!" title="{{ __(" Click to see all ") }}" onclick="em_desenvolvimento_alert()" class="dropdown-item text-center text-primary font-weight-bold py-3">{{ __("See all") }}</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-ungroup"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                                <div class="row shortcuts px-4">
                                    <a href="#!" onclick="em_desenvolvimento_alert()" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                                <i class="ni ni-calendar-grid-58"></i>
                                            </span>
                                        <small title="{{ __(" Click to go to the calendar ") }}">{{ __("Calendar") }}</small>
                                    </a>
                                    <a target="_blank" href="https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=13&ct=1582478452&rver=7.0.6737.0&wp=MBI_SSL&wreply=https%3a%2f%2foutlook.live.com%2fowa%2f%3fnlp%3d1%26RpsCsrfState%3ddeb00056-f05f-7220-28a5-906686de2d85&id=292841&aadredir=1&CBCXT=out&lw=1&fl=dob%2cflname%2cwld&cobrandid=90015"
                                        class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                                <i class="ni ni-email-83"></i>
                                            </span>
                                        <small title="{{ __(" Click to go to the microsoft e-mail ") }}">{{ __("E-mail") }}</small>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#modal-feedback" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                                <i class="ni ni-support-16"></i>
                                            </span>
                                        <small title="{{ __(" Click to send a feedback for the developers ") }}">{{ __("Feedback") }}</small>
                                    </a>
                                    <a href="{{route('home')}}" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        <small title="{{ __(" Click to manage the appointments ") }}">{{ __("Schedules") }}</small>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                            @if(auth()->user()->image != null)
                                            <img style="width: 15em; height: 15em"  src="{{ url('storage/images/users/'.auth()->user()->image) }}">
                                            @else
                                            <img src="https://www.auctus.com.br/wp-content/uploads/2017/09/sem-imagem-avatar.png">
                                            @endif
                                        </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{ ucFirstNames(auth()->user()->name) }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">{{ __("Hello!") }}</h6>
                                </div>
                                <a href="{{route('myProfile.index')}}" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span title="{{ __("Click to go to the your profile page") }}">{{ __("My Profile") }}</span>
                                </a>
                                <a href="#!" onclick="em_desenvolvimento_alert()" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span {{ __("Click to go to the settings page") }}>{{ __("Settings") }}</span>
                                </a>
                                <a href="{{ route('myLogs') }}" class="dropdown-item">
                                    <i class="ni ni-calendar-grid-58"></i>
                                    <span title="{{ __("Click to go to your logs page") }}">{{ __("Logs") }}</span>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#modal-feedback" class="dropdown-item">
                                    <i class="ni ni-support-16"></i>
                                    <span title="{{ __("Click to send a feedback for the developers") }}">{{ __("Feedback") }}</span>
                                </a>

                                <a href="{{ route('manual.index') }}" class="dropdown-item">
                                    <i class="ni ni-support-16"></i>
                                    <span title="{{ __("Click to see the aplication manual") }}">{{ __("Manual") }}</span>
                                </a>

                                <div class="dropdown-divider"></div>
                                <form class="form-loader" action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="ni ni-user-run"></i>
                                        <span title="{{ __("Click to logout") }}">{{ __("Logout") }}</span>
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="app">
            <!-- conteudo da pagina -->
            @yield('content')
        </div>
        <!-- Footer -->
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
                            <a href="#" class="nav-link" title="{{ __(" Click to know more about the system ") }}" onclick="em_desenvolvimento_alert()" target="_blank">{{ __("About The Project") }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" title="{{ __(" Click to view usage documentation ") }}" class="nav-link" onclick="em_desenvolvimento_alert()" target="_blank">{{ __("How To Use") }}?</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>

        <!--Modal de feedback de erro-->
        <div class="col-md-4">
            <div class="modal fade" id="modal-feedback" tabindex="-1" role="dialog" aria-labelledby="modal-feedback" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card bg-secondary shadow border-0">
                                <div class="card-body px-lg-10 py-lg-10">
                                    @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span class="alert-inner--text"><i class="fas fa-thumbs-down"></i><strong> Ops...</strong>
                                                <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                                </ul>
                                            </span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                    </div>
                                    @endif
                                    <div class="text-center">
                                        <h3>{{ __("Feedback") }}</h3>
                                    </div>
                                    <div class="text-center text-muted mb-4">
                                        <small>{{ __("Help us understand how your system experience is going. If an error has occurred, please describe it.") }}</small>
                                    </div>
                                    <form method="POST" action="{{ route('feedback.create') }}" class="form-loader">
                                        @csrf
                                        <!-- Nome de quem esta reportando o erro -->

                                        <input id="id_usuario" type="hidden" class="form-control @error('id_usuario') is-invalid @enderror" name="id_usuario" value="{{ auth()->user()->id }}" required>

                                        <!-- Removivel -->
                                        <!-- fim do nome de quem esta reportando o erro -->

                                        <!-- detalhes do bug -->
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                                </div>
                                                <textarea title="{{ __(" Fill this field ") }}" id="descricao" required style="min-height: 10em;" placeholder="{{ __(" Enter details here ") }}" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{ old('detalhes') }}"></textarea>
                                            </div>
                                        </div>
                                        <!-- fim do detalhes do bug -->
                                        <!-- submit button -->
                                        <div class="text-center">
                                            <button type="button" class="btn btn-outline-primary  ml-auto" data-dismiss="modal">{{ __("Cancel") }}</button>
                                            <button type="submit" class="btn btn-primary my-4">{{ __("Send") }}</button>
                                        </div>
                                        <!-- fim do submit button -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fim modal de feedback de erro-->
    </div>
    </div>
    <script src="{{ asset('js/loader/main.min.js') }}"></script>
    <script>
        function em_desenvolvimento_alert(){
            alert('{{ __("Developing Functionality") }}')
        }
    </script>
    <script>
        function comeBack(){
            window.history.back();
        }
    </script>
    <!--
    -- Special Scripts
    --
    -->
    @yield('scripts')
</body>

</html>