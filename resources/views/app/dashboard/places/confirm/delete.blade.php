@extends('layouts.dashboard')

@section('title', Lang::get('Confirm Delete'))

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Do you really want to delete permanently this place") }}?</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a onclick="comeBack();" class="btn btn-sm btn-neutral">{{ __("No, go back to locations table") }}</a>
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
                
                <div class="text-center text-danger"><h3>{{ __("Caution") }}!</h3></div>
                <div class="text-left mb-4">
                    <strong>
                        *
                        <span class="text-muted">
                            {{ __("Permanently delete modifies the statistics for canceled schedules") }}.
                            <br>
                            <br>
                            {{ __("Besides that, it will be ") }}<u class="text-danger">{{ __("impossible") }}</u>
                            {{ __("to restore this schedule and see his logs") }}
                        </span>
                        *
                    </strong>
                </div>
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
                        @if($schedule->deleted_at != null)
                            <strong>{{ __("canceled") }}</strong>
                        @elseif ($schedule->status == null)
                            <strong>{{ __("On budget") }}</strong>
                        @elseif($schedule->status == 1)
                            <strong>{{ __("Confirmed") }}</strong>
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



                    <!-- editado em -->
                    @if ($schedule->created_at != $schedule->updated_at)
                        <div class="form-group mb-3">
                            <span>{{ __("Updated") }}:</span>
                            <strong>{{dateBrazilianFormat($schedule->updated_at)}} {{ __("at") }} {{ timeBrazilianFormat($schedule->updated_at) }}</strong>
                        </div>
                    @endif

                </div>

                <form action="{{ route('schedules.permanentlyDelete', $schedule->id)}}" class="form-loader"  method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="comeBack();" type="button" class="btn btn-outline-success">{{ __("Come Back") }}</button>
                    <button type="submit" class="btn btn-danger">{{ __("I understand the consequences") }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection