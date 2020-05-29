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
                              <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="8"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="9"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="10"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="11"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="12"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="13"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="14"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="15"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="16"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="17"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="18"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="20"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="21"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="22"></li>

                            </ol>
                            <div class="carousel-inner">
                                
                                {{-- Item 01--}}
                                <div class="carousel-item active">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo01.jpeg') }}" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 01</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>

                                {{-- Item 02--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo02.jpeg') }}" alt="Second slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 02</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>
                                
                                {{-- Item 03--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo03.jpeg') }}" alt="Third slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 03</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>

                                {{-- Item 04--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo04.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 04</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>

                                {{-- Item 05--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo05.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 05</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>

                                {{-- Item 06--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo06.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 06</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>

                                {{-- Item 07--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo07.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 07</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>

                                {{-- Item 08--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo08.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 08</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>
                            
                                {{-- Item 09--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo09.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 09</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>

                                {{-- Item 10--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo10.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 10</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>                                

                                {{-- Item 11--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo11.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 11</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>              
                                
                                {{-- Item 12--}}
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo12.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 12</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>              
                                
                                 {{-- Item 13--}}
                                 <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo13.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 13</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>             
                                
                                  {{-- Item 14--}}
                                  <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo14.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 14</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>                                            

                                  {{-- Item 15--}}
                                  <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo15.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 15</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>              
                                
                                  {{-- Item 16--}}
                                  <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo16.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 16</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>              
                                
                                  {{-- Item 17--}}
                                  <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo17.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 17</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>               
                                
                                  {{-- Item 18--}}
                                  <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo18.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 18</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>              
                                
                                  {{-- Item 19--}}
                                  <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo19.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 19</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>
                                
                                  {{-- Item 20--}}
                                  <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo20.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 20</h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>              
                                
                                  {{-- Item 21--}}
                                  <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo21.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 21    </h5>
                                        <p>Apenas 1 texto</p>
                                    </div>
                                </div>              

                                   {{-- Item 22--}}
                                   <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('manual/schedules/create/passo22.jpeg') }}" alt="Fourth slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Passo 22</h5>
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