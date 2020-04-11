@extends('layouts.dashboard') @section('title', 'Dashboard') @section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Schedules") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="#" class="btn btn-sm btn-neutral mb-2" id="novo-agendamento" data-toggle="modal" data-target="#modal-form">{{ __("New") }}</a>
                    <a href="{{route('schedules.canceled.index')}}" class="btn btn-sm btn-neutral mb-2">{{ __("Canceled") }}</a>
                    <a href="#" data-toggle="modal" data-target="#modal-filter" id="filtros-agendamento" class="btn btn-sm btn-neutral mb-2 mr-2">{{ __("Filters") }}</a>
                </div>
            </div>
            <!-- fim do header -->
        </div>
    </div>
</div>

<!-- tabela de agendamentos -->

<div class="container-fluid mt--6">
    <!-- conteudo da pagina -->

    @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-inner--text"><i class="ni ni-like-2"></i><strong>{{  __("Success") }}!</strong> {{session('status')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
    </div>
    @endif @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-inner--text"><i class="fas fa-thumbs-down"></i><strong> {{ __("Opps") }}...</strong>
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
    @endif @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-inner--text"><i class="fas fa-thumbs-down"></i><strong> {{ __("Opps") }}...</strong>{{session('error')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
    </div>
    @endif

    <div class="row">
        <!-- inicio da tabela de agendamentos -->
        <div class="col-xl-12">
            <div class="card bg-default">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <!-- inicio cabecalho da tabela -->
                        <div class="col">
                            <h5 class="text-light text-uppercase ls-1 mb-1">{{ __("Schedule's Table") }}</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-dark table-flush">
                                <thead class="thead-dark">
                                    <tr>
                                        <!-- agendamento 01 -->
                                        <th scope="col" class="sort" data-sort="name">{{ __("Place") }}</th>
                                        <th scope="col" class="sort" data-sort="budget">{{ __("Start DateTime") }} / {{ __("End DateTime") }}</th>
                                        <th scope="col" class="sort" data-sort="status">{{ __("Status") }}</th>
                                        <th scope="col">{{ __("Customer") }}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{ __("Actions") }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <!-- fim do cabeçalho da tabela -->
                                <tbody class="list">
                                    <!-- inicio corpo da tabela -->
                                    @if ($hasSchedules)
                                    <tr>
                                        <td>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ __("Without Data") }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ __("Without Data") }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge badge-dot mr-4">
                          <i class="bg-danger"></i>
                          <span class="status">{{ __("Without Data") }}</span>
                                            </span>
                                        </td>

                                        <td>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ __("Without Data") }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="#!">{{ __("No Options Available") }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- fim do agendamento 01 -->

                                    @else
                                    <!-- se houver agendamentos -->

                                    <tr>
                                        <td class="budget">
                                            {{ __("Without Data") }}
                                        </td>
                                        <td class="budget">
                                            {{ __("Without Data") }} | {{ __("Without Data") }}
                                        </td>
                                        <td>
                                            <span class="badge badge-dot mr-4">
                            <i class="bg-danger"></i>
                            <span class="status">{{ __("Without Data") }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ __("Without Data") }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="#!">{{ __("No Options Available") }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- fim do agendamento 01 -->
                                    @endif
                                </tbody>
                                <!-- fim do corpo da tabela -->
                                <div class="float-right">
                                    {{ $schedules->links() }}
                                </div>

                                <br>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fim da tabela de agendamentos -->

    <!-- fim do conteudo da pagina -->

    <!-- filtros -->
    <div class="modal-filtros fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-filter" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="espacol"></div>
                <div class="text-center">
                    <h3>{{ __("Search Filters") }}</h3>
                </div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Choose one of the methods below to proceed") }}</small>
                </div>
                <div class="modal-body">
                    <!--options-->
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="form-intervalo-data-tab" data-toggle="tab" href="#form-intervalo-data" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa fa-calendar mr-2"></i>Inter. de Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="form-data-local-tab" data-toggle="tab" href="#form-data-local" role="tab" aria-controls="form-data-local" aria-selected="false"><i class="fa fa-map-marker-alt mr-2"></i>Data e Local</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="form-unica-data-tab" data-toggle="tab" href="#form-unica-data" role="tab" aria-controls="form-unica-data" aria-selected="false"><i class="fa fa-calendar mr-2"></i>Única Data</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="form-intervalo-data" role="tabpanel" aria-labelledby="form-intervalo-data">
                                    <h3>{{ __("Search by date range") }}</h3>
                                    <form action="{{route('schedules.findPer.date')}}" class="form-loader" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="inicio" class="form-control dateTop" placeholder="{{ __(" From ") }}" type="date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="fim" class="form-control dateTop" placeholder="{{ __(" To ") }}" type="date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- btn pesquisar -->
                                        <div class="float-right">
                                            <button title="{{ __(" Click to Search ") }}" class="btn btn-primary" type="submit">
                                                {{ __("Search") }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="form-data-local" role="tabpanel" aria-labelledby="form-data-local-tab">
                                    <h3>{{ __("Search by date and place") }}</h3>
                                    <form action="{{route('schedules.findPer.dateAndPlace')}}" class="form-loader" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="inicio" placeholder="{{ __(" From ") }}" class="form-control dateTop" type="date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="fim" class="form-control dateTop" placeholder="{{ __(" To ") }}" type="date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="local">{{ __("Place") }}</label>

                                                    <div class="input-group mb-4">

                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-map"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="espaco"></div>
                                                <div class="float-right">
                                                    <button title="{{ __(" Click to Search ") }}" class="btn btn-primary" type="submit">
                                            {{ __("Search") }}
                                        </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="form-unica-data" role="tabpanel" aria-labelledby="form-unica-data">
                                    <h3>{{ __("Search by single date") }}</h3>
                                    <form action="{{route('schedules.findPer.specificDate')}}" class="form-loader" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="data" id="unica_data" class="form-control dateTop" placeholder="{{ __(" Date ") }}" type="date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <!-- btn pesquisar -->
                                                    <div class="float-right">
                                                        <button title="{{ __(" Click to Search ") }}" class="btn btn-primary" type="submit">
                                                    {{ __("Search") }}
                                                </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
    <!-- fim do modal filtros -->

    <!-- modal create -->
    <div class="col-md-4">
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary shadow border-0">
                            <div class="card-body px-lg-10 py-lg-10">
                                <div class="text-center">
                                    <h3>{{ __("Schedule Event") }}</h3>
                                </div>
                                <div class="text-center text-muted mb-4">
                                    <small>{{ __("Fill in the details below to proceed") }}</small>
                                </div>
                                <form method="POST" action="{{ route('schedules.create') }}" class="form-loader">
                                    @csrf
                                    <!-- titulo do agendamento -->
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                            </div>
                                            <input id="title" title="{{ __("Fill this field") }}"  placeholder="{{ __("Schedule title") }}" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus> 
                                        </div>
                                    </div>
                                    <!-- fim do titulo do agendamento -->

                                    <!-- local do agendamento -->
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><i class="fa fa-map mr-2"></i>{{ __("Place") }}</span>
                                            </div>
                                            @if ($hasPlaces)
                                            <select name="local" id="local" class="form-control @error('local') is-invalid @enderror" required>
                                                @foreach ($places as $place)
                                                    <option value="{{$place->id}}">{{$place->name}}</option>
                                                @endforeach
                                            </select> 
                                            @else
                                            <select name="local" id="local" disabled class="form-control @error('local') is-invalid @enderror" required>
                                                <option selected>{{ __("Please register a place") }}</option>
                                            </select>
                                            @endif 

                                        </div>
                                    </div>
                                    <!-- fim local do agendamento -->

                                    <!-- data inicial do agendamento -->
                                    <div class="form-group focused">
                                        <label for="date-final">{{ __("Start DateTime") }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input title="{{ __("Fill this field") }}"  id="start_date" type="date" class="form-control" name="start_date" required> 

                                            <!--hora inicial do agendamento-->
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                            </div>

                                            <input title="{{ __("Fill this field") }}"  id="start_time" type="time" class="form-control " name="start_time" required> 
                                        </div>
                                    </div>
                                    <!-- fim da data inicial do agendamento -->

                                    <!-- data final do agendamento -->
                                    <div class="form-group focused">
                                        <label for="date-final">{{ __("End DateTime") }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input title="{{ __("Fill this field") }}"  id="end_date" type="date" class="form-control" name="end_date" required> 

                                            <!--hora final do agendamento-->
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                            </div>

                                            <input title="{{ __("Fill this field") }}"  id="end_time" type="time" class="form-control " name="end_time" required>
                                        </div>
                                    </div>
                                    <!-- fim da data final do agendamento -->

                                    <!-- cliente do agendamento -->
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02 mr-2"></i>{{ __("Customer") }}</span>
                                            </div>

                                            @if ($hasCustomers)
                                            <select name="cliente" id="cliente" class="form-control @error('cliente') is-invalid @enderror" required>
                                                @foreach ($customers as $customer)
                                                  <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                @endforeach
                                              </select>
                                            @else
                                            <select name="cliente" id="cliente" disabled class="form-control @error('cliente') is-invalid @enderror" required>
                                                <option selected>{{ __("Please register a customer") }}</option>
                                            </select> 
                                            @endif 
                                            
                                        </div>
                                    </div>
                                    <!-- fim do cliente do agendamento -->

                                    <!-- detalhes do agendamento -->
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                            </div>
                                            <textarea title="{{ __("Fill this field") }}"  id="detalhes" placeholder="Detalhes do Agendamento" class="form-control @error('detalhes') is-invalid @enderror" name="detalhes" value="{{ old('detalhes') }}"></textarea> 
                                        </div>
                                    </div>
                                    <!-- fim do detalhes do agendamento -->

                                    <!-- pendente ou nao -->

                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="customCheckLogin" name="status" type="checkbox">
                                        <label class="custom-control-label" for="customCheckLogin"><span>{{ __("Waiting confirmation") }}</span></label>
                                    </div>
                                    <!-- fim do pendente ou nao -->

                                    <!-- submit button -->
                                    <div class="text-center">
                                        <button type="button" class="btn btn-outline-primary  ml-auto" data-dismiss="modal">{{ __("Cancel") }}</button>
                                        @if($hasPlaces && $hasCustomers)
                                        <button type="submit" id="agendar-submit" disabled class="btn btn-primary my-4">{{ __("Schedule") }}</button> 
                                        @else
                                        <button type="submit" class="btn btn-primary my-4" disabled>{{ __("Schedule") }}</button>
                                        @endif
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
    <!-- fim do modal create -->


    @endsection