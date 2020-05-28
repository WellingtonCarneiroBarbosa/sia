@extends('layouts.manual')

@section('title', Lang::get('Application Manual'))

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <!-- alertas -->
            @component('components.alert')@endcomponent

            <div class="row">
                <div class="col-xl-12">
                    <center class="fadeInTransition">
                        <hr>
                        <span class="text-white h2">
                            {{ __("Welcome to application manual.") }}
                            <br>
                            {{ __("Use the left menu to find what you need") }}
                        </span>
                        <hr>
                        <div class="espacol"></div>
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