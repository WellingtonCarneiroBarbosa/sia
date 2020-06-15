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
                                        <small title="{{ __("Click to go to the calendar") }}">{{ __("Calendar") }}</small>
                                    </a>
                                    <a target="_blank" href="https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=13&ct=1582478452&rver=7.0.6737.0&wp=MBI_SSL&wreply=https%3a%2f%2foutlook.live.com%2fowa%2f%3fnlp%3d1%26RpsCsrfState%3ddeb00056-f05f-7220-28a5-906686de2d85&id=292841&aadredir=1&CBCXT=out&lw=1&fl=dob%2cflname%2cwld&cobrandid=90015"
                                        class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                                <i class="ni ni-email-83"></i>
                                            </span>
                                        <small title="{{ __("Click to go to the microsoft e-mail") }}">{{ __("E-mail") }}</small>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#modal-feedback" onclick="em_desenvolvimento_alert()" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                                <i class="ni ni-support-16"></i>
                                            </span>
                                        <small title="{{ __("Click to send a feedback for the developers") }}">{{ __("Feedback") }}</small>
                                    </a>
                                    <a href="{{route('home')}}" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        <small title="{{ __("Click to manage the appointments") }}">{{ __("Schedules") }}</small>
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
                                        @if(auth()->user()->profile_image != null)
                                        <img style="width: 3.4em; height: 3em;" class="mr-2"  src="{{ url('storage/users/profile_image/'.auth()->user()->profile_image) }}">
                                        @else
                                        <img src="https://www.auctus.com.br/wp-content/uploads/2017/09/sem-imagem-avatar.png">
                                        @endif
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold"> {{ showFirstPieceOfAString(ucFirstNames(auth()->user()->name)) }} </span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">{{ __("System version") }}: {{ config('app.version') }}</h6>
                                </div>
                                <a href="{{route('myProfile.index')}}" class="dropdown-item"  title="{{ __("Click to go to the your profile page") }}">
                                    <i class="ni ni-single-02"></i>
                                    <span>{{ __("My Profile") }}</span>
                                </a>
                                <a href="#!" onclick="em_desenvolvimento_alert()" class="dropdown-item" title="{{ __("Click to go to the settings page") }}">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>{{ __("Settings") }}</span>
                                </a>
                                <a href="{{ route('logs.me') }}" class="dropdown-item"  title="{{ __("Click to go to your logs page") }}">
                                    <i class="ni ni-calendar-grid-58"></i>
                                    <span>{{ __("My Activity") }}</span>
                                </a>
                                <a href="#!" onclick="em_desenvolvimento_alert()" class="dropdown-item" title="{{ __("Click to request help") }}"> 
                                    <i class="ni ni-support-16"></i>
                                    <span>{{ __("Support") }}</span>
                                </a>

                                <a href="#!" onclick="em_desenvolvimento_alert()"  class="dropdown-item" title="{{ __("Click to see the system manual") }}">
                                    <i class="fa fa-book"></i>
                                    <span>{{ __("Manual") }}</span>
                                </a>

                                <a href="#!" data-toggle="modal" data-target="#atualization-notes"  class="dropdown-item" title="{{ __("Click to see the atualization notes") }}">
                                    <i class="fa fa-bookmark"></i>
                                    <span>{{ __("Atualization Notes") }}</span>
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

        <div id="atualization-notes" class="modal h-100" style="overflow-y: auto;" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notas da Atualização {{ config('app.version') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="whats-new-tab" data-toggle="tab" href="#whats-new" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">O que há de novo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="whats-updated-tab" data-toggle="tab" href="#whats-updated" role="tab" aria-controls="whats-updated" aria-selected="false">O que mudou</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="whats-corrected-tab" data-toggle="tab" href="#whats-corrected" role="tab" aria-controls="whats-updated" aria-selected="false">Bugs</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="whats-new" role="tabpanel" aria-labelledby="whats-new">
                                <h3>O que há de novo?</h3>
                                <ul>
                                    <li>Gerenciamento de locais</li>
                                    <li>Gerenciamento de clientes</li>
                                    <li>Gerenciamento de usuários</li>
                                    <li>Histórico de agendamentos</li>
                                    <li>Agendamentos são movidos automaticamente para o histórico quando expiram ou são inválidos</li>
                                    <li>Notificações automatizadas via e-mail</li>
                                    <li>Loader para ações que possam demorar</li>
                                    <li>Painel de estatísticas</li>
                                    <li>Verificar se local está disponível em um período específico</li>
                                    <li>Disponível em Português e Inglês</li>
                                    <li>Conclusão de cadastro em etapas</li>
                                    <li>Mensagem quando não há nada para exibir</li>
                                    <li>Landing Page sobre o sistema</li>
                                    <li>Validação de todos os dados inseridos para evitar equívocos</li>
                                    <li>Visualizar dados do meu perfil</li>
                                    <li>Logs de atividade</li>
                                    <li>Descrição do que o botão faz ao deixar o mouse em cima do botão por 1 segundo</li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="whats-updated" role="tabpanel" aria-labelledby="whats-updated-tab">
                                <h3>O que mudou?</h3>
                                <ul>
                                    <li>Adicionado novos campos em cadastrar local</li>
                                    <li>Adicionado campo participantes em cadastrar agendamento</li>
                                    <li>Quando um agendamento tem a data anterior à atual, ele é movido automaticamente para a seção de histórico</li>
                                    <li>Um agendamento não é mais deletado permanentemente, é movido para a seção de histórico</li>
                                    <li>Ativar/Desativar um usuário</li>
                                    <li>Os usuários não tem acesso à funcionalidades de administradores</li>
                                    <li>Notificação à todos os usuários quando um local está reservado, ou deixou de estar reservado</li>
                                    <li>6 novos status em que um agendamento pode se encontrar:</li>
                                    <ul>
                                        <li>Confirmado</li>
                                        <li>Cancelado</li>
                                        <li>Em progresso</li>
                                        <li>Em orçamento</li>
                                        <li>Finalizado</li>
                                        <li>Expirado</li>
                                    </ul>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="whats-corrected" role="tabpanel" aria-labelledby="whats-corrected">
                                <h3>O que foi corrigido?</h3>
                                <ul>
                                    <li>Quando uma máscara não carregava, o backend não aceitava o dado, mesmo sendo um dado válido</li>
                                    <li>O alerta de erro era ativado quando não haviam erros</li>
                                    <li>Ao editar um local, ocorre um bug informando que ele já foi cadastrado e não atualiza</li>
                                    <li>Estatísticas dos agendamentos cancelados traz dados dos agendamentos confirmados</li>
                                    <li>Ao excluir um cliente, não exclui os agendamentos inválidos</li>
                                    <li>Seção de visualizar clientes deletados traz os clientes ativos também</li>
                                    <li>Backend aceita agendamento com 0 participantes</li>
                                    <li>Sistema permite desativar a si mesmo</li>
                                    <li>Quando a data inserida é inválida, exibe duas vezes o alerta de erro</li>
                                    <li>Não envia e-mail de recuperação de senha</li>
                                    <li>Sistema permite CPFs duplicados</li>
                                    <li>Sistema permitia o usuário trocar sua hierarquia no sistema</li>
                                    <li>Exibe status de agendamento confirmado quando o agendamento está no histórico de agendamentos</li>
                                    <li>Visualizar senha não funciona</li>
                                </ul>
                            </div>
                        </div>                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Okay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <script src="{{ asset('js/loader/main.min.js') }}"></script>

    <script>
        $(document).ready(function (){
            var hasUserAlreadySeenNotes = sessionStorage.getItem("atualization-note");
    
            if(! hasUserAlreadySeenNotes){
                sessionStorage.setItem("atualization-note", "atualization-note");
                $('#atualization-notes').modal();
            }
        });

        function em_desenvolvimento_alert(){
            alert('{{ __("Developing Functionality") }}')
        }

        function comeBack(){
            window.history.back();
        }
    </script>

    
    @yield('scripts')
</body>

</html>