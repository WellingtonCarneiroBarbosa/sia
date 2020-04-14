@extends('layouts.dashboard') @section('title', 'Resultado da Pesquisa') @section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Schedules") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-neutral mb-2">{{ __("Come back to schedules") }}</a>
                </div>
            </div>
            <!-- fim do header -->
        </div>
    </div>
</div>

<!-- tabela de agendamentos -->

<div class="container-fluid mt--6">
    <!-- conteudo da pagina -->

    @if(!$hasSchedules)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-inner--text"><i class="fas fa-thumbs-down mr-2"></i><strong> {{ __("Opps") }}...</strong>{{ $response }}</span>
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
                                                        {{ dateBrazilianFormat($schedule->start_date) }} {{ timeBrazilianFormat($schedule->start_time) }} 
                                                        |
                                                        {{ dateBrazilianFormat($schedule->end_date) }} {{ timeBrazilianFormat($schedule->end_time) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge badge-dot mr-4">

                                                @if(!$schedule->status)
                                                <i class="bg-danger"></i>
                                                <span class="status">{{ __("Waiting confirmation") }}</span>
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
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="#!">{{ __("No Options Available") }}</a>
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
                {{ $schedules->appends($data)->links() }}
            </div>
        </div>
    </div>
    <!-- fim da tabela de agendamentos -->
@endsection