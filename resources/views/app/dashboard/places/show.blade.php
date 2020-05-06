@extends('layouts.dashboard')

@section('title', Lang::get('View Place'))

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("View Place") }}</h6>
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
    
                <!-- alertas -->
                @component('components.alert')@endcomponent

                <div class="text-center text-danger"><h3>{{ __("More details about") }} <u>{{ $place->name }}</u> </h3></div>
                <hr>
                <div class="text-left text-sm">
                    @component('components.showPlaceBody', ['place' => $place])@endcomponent
                </div>

                <button type="button" onclick="comeBack();" class="btn btn-primary">{{ __("Okay") }}</button>
            </div>
        </div>
    </div>
</div>

@endsection