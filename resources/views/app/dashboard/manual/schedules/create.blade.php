@extends('layouts.manual')

@section('title', Lang::get('How to register a schedule'))

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
                            {{ __("How to register a schedule") }}?
                        </span>
                        <hr>
                        <div class="espacol"></div>
                        <div class="espaco"></div>
                        {{-- Manual --}}

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                            </ol>
                            <div class="carousel-inner">
                                
                                {{-- Item 01 ta dando certo--}}
                                <div class="carousel-item active">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo01.jpeg') }}" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 01</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>

                                {{-- Item 02 ta dando certo--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo02.jpeg') }}" alt="Second slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 02</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>
                                
                                {{-- Item 03 >:( a original n mostra--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo03.jpeg') }}" alt="Third slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 03</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>

                                {{-- Item 04 pq ta dando erro >:(--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo04.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 04</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">{{ __("pagination.previous") }}</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">{{ __("pagination.next") }}</span>
                            </a>
                        </div>

                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
<div class="espaco"></div>
@endsection