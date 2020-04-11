@extends('layouts.home')
@section('title', 'Início')

<!-- inicio do header -->
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
                            <p class="lead text-white">{{ __('Manage your appointments with a modern and functional application') }}</p>
                            <div class="btn-wrapper mt-5">
                                <a href="{{route('login')}}" class="btn btn-lg btn-white btn-icon mb-3 mb-sm-0">
                                    <span title="{{ __("Click here to access the system") }}" class="btn-inner--text">{{ __('Enter Now') }}</span>
                                </a>
                            </div>
                   
                            <div class="mt-5">
                                <span class="text-white">{{ __('Developed with') }}</span>
                                <span class="btn-inner--icon text-red"><i class="fa fa-heart"></i></span>
                                <span class="text-white">{{ __('by Evolue IT') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        <!-- fim do header -->