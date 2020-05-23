@extends('layouts.dashboard')

@section('title', 'Confirmar Cancelamento')

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Do you really want to delete permanently this scheduling") }}?</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a onclick="comeBack();" class="btn btn-sm btn-neutral">{{ __("No, go back to canceled appointments") }}</a>
                </div>
            </div>
        <!-- fim do header -->
        </div>
    </div>

        <!-- animacao de entrada -->
        <div class="row justify-content-center fadeInTransition" >
            <div class="card col-6 bg-secondary shadow border-0">
                <div class="card-body px-lg-10 text-center py-lg-10">
    
                <!-- alertas -->
                @component('components.alert')@endcomponent
                
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
                    @component('components.showScheduleBody', ['schedule' => $schedule, 'now' => $now])@endcomponent
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