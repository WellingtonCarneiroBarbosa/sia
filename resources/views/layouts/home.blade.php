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
    <link href="{{ asset('home/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/argon-design-system.min.css?v=1.2.0') }}" rel="stylesheet" />
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
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>-->

    <!-- Fonts -->
    <!--
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    -->
</head>

<body>
    <div id="app">
        <!-- Navbar -->
        <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
            <div class="container">
                <a class="navbar-brand mr-lg-5" title="{{  __("Click here to return to the home page") }}" href="{{route('inicio')}}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                    <span title="{{ __("Hide / Show options") }}" class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbar_global">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="{{route('inicio')}}">
                                    <img alt="{{ config('app.name', 'Laravel') }}" alt="{{  __("Click here to return to the home page") }}" src="{{asset('home/assets/img/brand/siaLogo.png')}}"> {{ config('app.name', 'Laravel') }}
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <button type="button"  class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button">
                                <i class="ni ni-atom d-lg-none"></i>
                                <span class="nav-link-inner--text" title="{{ __("Click to know more about the system") }}">{{ __("About the project") }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" role="button">
                                <i class="ni ni-collection d-lg-none"></i>
                                <span class="nav-link-inner--text" title="{{ __("Click to view usage documentation") }}">{{ __("How to use") }}?</span>
                            </a>
                        </li>
                    </ul>
                </div>
                @if(request()->routeIs('inicio'))
                @php
                    $locale = session()->get('locale');
                @endphp
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ml-auto">
                        @switch($locale)
                        @case('us')
                        <li class="nav-item">
                            <a class="nav-link" title="Click here to change the language" href="{{ config('app.url') }}en">{{ __("English") }}</a>
                        </li>
                        @break
                        
                        @case('pt-BR')
                        <li class="nav-item">
                            <a class="nav-link" title="Clique aqui para alterar o idioma" href="{{ config('app.url') }}pt-BR">{{ __("Portuguese") }}</a>
                        </li>
                        @break
                        @endswitch
                    </ul>
                </div> 
                @endif
            </div>
        </nav>

        <!-- fim do background header -->

        <!--page loader-->
        <div id="pageloader">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>

        <!-- inicio do conteudo  -->
        @yield('content')

    </div>
    </div>
    <!-- fim do conteudo -->

    <!-- footer -->
    <footer class="footer has-cards">
        <div class="container">
            <div class="row row-grid align-items-center my-md">
                <div class="col-lg-6">
                    <h3 class="text-primary font-weight-light mb-2">{{ __("Thank you for supporting us") }}!</h3>
                    <h4 class="mb-0 font-weight-light">{{ __("Follow the developers on these platforms") }}.</h4>
                </div>
                <div class="col-lg-6 text-lg-center btn-wrapper">
                    <h4 class="mb-0 font-weight-light" title="Wellington Barbosa">Wellington Barbosa</h4>
                    <a target="_blank" href="https://www.linkedin.com/in/wellington-barbosa-596596197/">
                        <button rel="nofollow" class="btn btn-icon-only btn-twitter rounded-circle" title="Follow Us!">
                            <span class="btn-inner--icon"><i class="fab fa-linkedin"></i></span>
                        </button>
                    </a>
                    <a target="blank" href="https://www.facebook.com/wellington.carneirobarbosa.3">
                        <button rel="nofollow" class="btn-icon-only rounded-circle btn btn-facebook" title="Follow Us!">
                            <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
                        </button>
                    </a>
                    <a target="blank" href="https://www.instagram.com/wellcomdoisl">
                        <button rel="nofollow" class="btn btn-icon-only btn-dribbble rounded-circle" title="Follow Us!">
                            <span class="btn-inner--icon"><i class="fab fa-instagram"></i></span>
                        </button>
                    </a>
                    <a target="blank" href="https://github.com/WellingtonCarneiroBarbosa">
                        <button rel="nofollow" class="btn btn-icon-only btn-github rounded-circle" title="Follow Us!">
                            <span class="btn-inner--icon"><i class="fab fa-github"></i></span>
                        </button>
                    </a>
                    <hr>
                    <h4 class="mb-0 font-weight-light" title="Elgson Gabriel">Elgson Gabriel</h4>
                    <a target="_blank" href="https://www.linkedin.com/in/elgson-gabriel-santos-do-nascimento-0459441a2/">
                        <button rel="nofollow" class="btn btn-icon-only btn-twitter rounded-circle" title="Follow Us!">
                            <span class="btn-inner--icon"><i class="fab fa-linkedin"></i></span>
                        </button>
                    </a>
                    <a target="blank" href="https://www.facebook.com/elgshow.nascimento.3">
                        <button rel="nofollow" class="btn-icon-only rounded-circle btn btn-facebook" title="Follow Us!"/>
                            <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
                        </button>
                    </a>
                    <a target="blank" href="https://www.instagram.com/elgson_gabriel">
                        <button rel="nofollow" class="btn btn-icon-only btn-dribbble rounded-circle" title="Follow Us!">
                            <span class="btn-inner--icon"><i class="fab fa-instagram"></i></span>
                        </button>
                    </a>
                    <a target="blank" href="https://github.com/EueEuEuEu">
                        <button rel="nofollow" class="btn btn-icon-only btn-github rounded-circle" title="Follow Us!">
                            <span class="btn-inner--icon"><i class="fab fa-github"></i></span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- fim do footer -->

    </div>

    <!-- scripts -->
    <script src="{{ asset('home/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('js/loader/main.min.js') }}"></script>
    <!--<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>-->
    <script>
        function scrollToDownload() {
            if ($('.section-download').length != 0) {
                $("html, body").animate({
                    scrollTop: $('.section-download').offset().top
                }, 1000);
            }
        }
    </script>
    @yield('scripts')
</body>

</html>