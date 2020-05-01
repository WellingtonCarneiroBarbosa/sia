@extends('layouts.home')

@section('title', Lang::get('About The System'))

@section('content')
<!-- background -->
<div class="wrapper">
    <div class="section section-hero section-shaped">
        <div class="shape shape-style-1 shape-primary">
            <span id="shape1" class="span-150"></span>
            <span id="shape2" class="span-50"></span>
            <span id="shape3" class="span-50"></span>
            <span id="shape4" class="span-75"></span>
            <span id="shape5" class="span-100"></span>
            <span id="shape6" class="span-75"></span>
            <span id="shape7" class="span-50"></span>
            <span id="shape8" class="span-100"></span>
            <span id="shape9" class="span-50"></span>
            <span id="shape10" class="span-100"></span>
        </div>
        <!-- fim do background -->
        <div class="page-header">
            <div class="container shape-container d-flex align-items-center py-lg">
                <div class="col px-0">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-6 text-center">
                            <img src="{{asset('home/assets/img/brand/siaLogo.png')}}" style="width: 10.5em; height: 10.5em;" class="img-fluid">                                
                            <span class="lead text-white">
                                <div class="mt-5">
                                        <div class="container shape-container d-flex align-items-center py-lg">
                                            {{ __('Bem vindo ao SIA eventos um sistema interno de agendamentos de eventos do sistema
                                            FIEP, um sistema sendo produzido desde o ano de 2019 para facilitar todo o trabalho da equipe de eventos,
                                            fazendo assim o trabalho da equipe mais agil, eficiente. O sistema pode se utlizado no PC ou em SMARTPHONES.
                                            Sem ocupar espaco em seu PC, pois os arquivos relacionados a agendamentos estao armazenados no sistema.') }}</span>
                                            </div>
                                            <center>    
                        </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
 