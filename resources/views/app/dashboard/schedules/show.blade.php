@extends('layouts.dashboard')

@section('title', Lang::get('View Schedule'))

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("View Schedule") }}</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="#" onclick="comeBack();" class="btn btn-sm btn-neutral">{{ __("Come Back") }}</a>
                </div>
            </div>
        <!-- fim do header -->
        </div>
    </div>

        <!-- animacao de entrada -->
        <div class="row justify-content-center fadeInTransition" >
            <div class="card col-6 bg-secondary shadow border-0">
                <div class="card-body px-lg-10 text-center py-lg-10">
    
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
                
                <div class="text-center text-danger"><h3>{{ __("More details about") }} <u>{{ $schedule->title }}</u></h3></div>
                <hr>
                <div class="text-left text-sm">
                    <!-- identificador do agendamento -->
                    <div class="form-group mb-3">
                        <span>{{ __("Identifier number") }}:</span>
                        <strong>{{ $schedule->id }}</strong>
                    </div>

                    <!-- titulo do agendamento -->
                    <div class="form-group mb-3">
                        <span>{{ __("Title") }}:</span>
                        <strong>{{ $schedule->title }}</strong>
                    </div>

                    <!-- local do agendamento -->
                    <div class="form-group mb-3">
                        <span>{{ __("Place") }}:</span>
                        <strong>{{ $schedule->schedulingPlace['name'] }}</strong>
                    </div>

                    <!--participantes do evento-->
                    <div class="form-group mb-3">
                        <span>{{ __("Expected number of participants") }}:</span>
                        <strong>{{ $schedule->participants }} {{ __("peoples") }} </strong> 
                    </div>
    
                    <!-- datahora inicio -->
                    <div class="form-group mb-3">
                       <span>{{ __("Start") }}:</span>
                       <strong>{{dateBrazilianFormat($schedule->start)}} {{ __("at") }}  {{ timeBrazilianFormat($schedule->start) }}</strong>
                   </div>

                    <!-- datahora final -->
                    <div class="form-group mb-3">
                        <span>{{ __("End") }}:</span>
                        <strong>{{dateBrazilianFormat($schedule->end)}} {{ __("at") }}  {{ timeBrazilianFormat($schedule->end) }}</strong>
                    </div>

                    <!-- cliente -->
                    <div class="form-group mb-3">
                        <span>{{ __("Customer") }}:</span>
                        <strong>{{$schedule->schedulingCustomer['corporation'] }}</strong>
                    </div>

                    <!-- status -->
                    <div class="form-group mb-3">
                        <span>{{ __("Status") }}:</span>

                        @if($now > $schedule->start && $now < $schedule->end)
                            <i class="bg-success"></i>
                            <strong class="status">{{ __("In progress") }}</strong>
                        @elseif($now > $schedule->start && $now >= $schedule->end)
                            <i class="bg-danger"></i>
                            <strong class="status">{{ __("Finalized") }}</strong>
                        @elseif(!$schedule->place_id)
                            <i class="bg-danger"></i>
                            <strong class="status">{{ __("Expired") }}</strong>
                        @elseif($schedule->deleted_at != null)
                            <i class="bg-danger"></i>
                            <strong class="status">{{ __("canceled") }}</strong>
                        @elseif (!$schedule->status)
                            <i class="bg-warning"></i>
                            <strong class="status">{{ __("On budget") }}</strong>
                        @elseif($schedule->status)
                            <i class="bg-success"></i>
                            <strong class="status">{{ __("Confirmed") }}</strong>
                        @endif

                    </div>

                    <!-- detalhes -->
                    <div class="form-group mb-3">
                        <span>{{ __("Details") }}:</span>
                        @if($schedule->details == null)
                            <strong>{{ __("Nothing to show") }}</strong>
                        @else
                            {{ $schedule->details }}
                        @endif
                    </div>

                    <!-- agendado em - por -->
                    <div class="form-group mb-3">
                        <span>{{ __("Scheduled on") }}:</span>
                        <strong>{{dateBrazilianFormat($schedule->created_at)}} {{ __("at") }} {{ timeBrazilianFormat($schedule->created_at) }}</strong>
                    </div>


                    <!-- criado em -->
                    @if ($schedule->created_at)
                        <div class="form-group mb-3">
                            <span>{{ __("Created at") }}:</span>
                            <strong>{{dateBrazilianFormat($schedule->created_at)}} {{ __("at") }} {{ timeBrazilianFormat($schedule->created_at) }}</strong>
                        </div>
                    @endif

                    <!-- editado em -->
                    @if ($schedule->created_at != $schedule->updated_at)
                        <div class="form-group mb-3">
                            <span>{{ __("Updated") }}:</span>
                            <strong>{{dateBrazilianFormat($schedule->updated_at)}} {{ __("at") }} {{ timeBrazilianFormat($schedule->updated_at) }}</strong>
                        </div>
                    @endif

                    <!--cancelado em-->
                    @if ($schedule->deleted_at)
                    <div class="form-group mb-3">
                        <span>{{ __("Canceled at") }}:</span>
                        <strong>{{dateBrazilianFormat($schedule->deleted_at)}} {{ __("at") }} {{ timeBrazilianFormat($schedule->deleted_at) }}</strong>
                    </div>
                    @endif 
                </div>

                <button type="button" onclick="comeBack();" class="btn btn-primary">{{ __("Okay") }}</button>
            </div>
        </div>
    </div>
</div>

@endsection