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
                    <a href="{{ route('schedules.create') }}" class="btn btn-sm btn-neutral mb-2" id="novo-agendamento">{{ __("New") }}</a>
                    <a href="{{route('schedules.canceled')}}" class="btn btn-sm btn-neutral mb-2">{{ __("Canceled") }}</a>
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
        <span class="alert-inner--text"><i class="ni ni-like-2 mr-2"></i><strong>{{  __("Success") }}!</strong> {{session('status')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-inner--text"><i class="fas fa-thumbs-down mr-2"></i><strong> {{ __("Opps") }}...</strong>
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
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-inner--text"><i class="fas fa-thumbs-down mr-2"></i><strong> {{ __("Opps") }}...</strong>{{session('error')}}</span>
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
                                        <th scope="col" class="sort" data-sort="budget">{{ __("Start Datetime") }} / {{ __("End Datetime") }}</th>
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
                                    
                                    @foreach($schedules as $schedule)
                                    <tr>
                                        <td>
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar avatar-md rounded-circle mr-3">
                                                  <img alt="Image placeholder" src="https://via.placeholder.com/150">
                                                </a>

                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">
                                                        {{ $schedule->schedulingPlace['name'] }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">
                                                        {{ dateTimeBrazilianFormat($schedule->start) }} 
                                                        |
                                                        {{ dateTimeBrazilianFormat($schedule->end) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge badge-dot mr-4">

                                                @if(!$schedule->status)
                                                <i class="bg-danger"></i>
                                                <span class="status">{{ __("On budget") }}</span>
                                                @else
                                                <i class="bg-success"></i>
                                                <span class="status">{{ __("Confirmed") }}</span>
                                                @endif
                                                
                                            </span>
                                        </td>

                                        <td>
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar avatar-sm rounded-circle mr-3">
                                                  <img alt="Image placeholder" src="https://via.placeholder.com/150">
                                                </a>

                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $schedule->schedulingCustomer['corporation'] }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow align-items-center">
                                                    <a class="dropdown-item" href="{{ route('schedules.edit', ['id' => $schedule->id]) }}">{{ __("Edit") }}</a>
                                                    <a class="dropdown-item" href="{{ route('schedules.confirm.cancel', ['id' => $schedule->id]) }}">{{ __("Cancel") }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @else
                                    <!-- se nao houver agendamentos -->

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
                                <br>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-right">
                {{ $schedules->links() }}
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
                                    <form action="{{route('schedules.findPer.dateRange')}}" class="form-loader" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="start_date" class="form-control dateTop" placeholder="{{ __(" From ") }}" type="date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="end_date" class="form-control dateTop" placeholder="{{ __(" To ") }}" type="date">
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
                                                        <input title="{{ __("Fill this field") }}" required name="start_date" placeholder="{{ __(" From ") }}" class="form-control dateTop" type="date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="end_date" class="form-control dateTop" placeholder="{{ __(" To ") }}" type="date">
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

                                                        @if ($hasPlaces)
                                                        <select name="place_id" id="place_id" class="form-control @error('place_id') is-invalid @enderror" required>
                                                            @foreach ($places as $place)
                                                                <option value="{{$place->id}}">{{$place->name}}</option>
                                                            @endforeach
                                                        </select> 
                                                        @else
                                                        <select name="place_id" id="place_id" disabled class="form-control @error('place_id') is-invalid @enderror" required>
                                                            <option selected>{{ __("Please register a place") }}</option>
                                                        </select>
                                                        @endif 

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
                                                        <input title="{{ __("Fill this field") }}" required name="date" id="unica_data" class="form-control dateTop" placeholder="{{ __(" Date ") }}" type="date">
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
@endsection