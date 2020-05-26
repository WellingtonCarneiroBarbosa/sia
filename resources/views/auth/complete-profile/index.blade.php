@extends('layouts.dashboard')

@section('title', Lang::get('Complete Register'))

@section('content')

<!-- Header -->
<div class="header bg-primary pb-6">
    @component('components.progressBar', ['progress' => '0'])@endcomponent
    <div class="container-fluid">
        <div class="header-body">
            <!-- alertas -->
            @component('components.alert')@endcomponent

            <div class="row">
                <div class="col-xl-12">
                    <center class="fadeInTransition">
                        <hr>
                        <span class="text-white h2">
                            {{ __("Welcome to SIA Events.") }}
                            <br>
                            {{ __("We're almost done, click the button below to complete your registration") }}
                        </span>
                        <hr>
                        <div class="espacol"></div>
                        <a href="{{ route('complete.profile.stageOne') }}">
                            <button class="btn btn-secondary">{{ __("Complete Register") }}</button>
                        </a>
                        <div class="espaco"></div>
                        <img style="width: 70%; " src="{{ asset('dashboard/assets/img/brand/team/semdados.png') }}" alt="{{ __("team") }}">
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
<div class="espaco"></div>

@endsection
