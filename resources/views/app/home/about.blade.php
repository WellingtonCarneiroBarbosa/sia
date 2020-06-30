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
        <!--inicio do conteudo-->
        <div class="page-header">
            <div class="container shape-container d-flex align-items-center py-lg">
              <div class="col px-0">
                <div class="row align-items-center justify-content-center">
                  <div class="col-lg-6 text-center">
                    <h1 class="text-white display-1">{{ __("SIA Eventos") }}</h1>
                    <h2 class="display-4 font-weight-normal text-white">{{ __("Manage your appointments with a modern and functional application") }}</h2>
                    <div class="btn-wrapper mt-4">
                      <a target="_blank" href="https://www.youtube.com/watch?v=8oELt_TkNe0&feature=youtu.be" class="btn btn-warning btn-icon mt-3 mb-sm-0">
                        <span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
                        <span class="btn-inner--text">{{ __("Watch system trailer") }}</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <!--separador-->
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>

    <!--fim do background-->
    </div>

</div>
      <!--other section-->
      <div class="section features-1">
        <div class="container">
          <div class="row">
            <div class="col-md-8 mx-auto text-center">
              <span class="badge badge-primary badge-pill mb-3">{{ __("The project") }}</span>
              <h3 class="display-3">{{ __("What is SIA Eventos") }}?</h3>
              <p class="lead">  {{ __("SIA Eventos is a project that aims to facilitate the management of rental environments. The system uses technology to keep its team fully integrated and harmonious, so that efficient management of all schedules can be carried out.") }}</p>
            </div>
          </div>
        </p>
          <div class="row">
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle">
                  <i class="ni ni-settings-gear-65"></i>
                </div>
                <h6 class="info-title text-uppercase text-primary">{{ __("Automated emails") }}</h6>
                <p class="description opacity-8">
                  {{ __("Our application automatically notifies all members of your team via email about upcoming events of the week.") }}
                </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-lg icon-shape icon-shape-success shadow rounded-circle">
                  <i class="ni ni-atom"></i>
                </div>
                <h6 class="info-title text-uppercase text-success">{{ __("Real-time notifications") }}</h6>
                <p class="description opacity-8">
                  {{ __("The system has real-time notifications, which help to keep the team integrated about what is happening.") }}
                </p>
                <a href="javascript:;" class="text-primary">
                </a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-lg icon-shape icon-shape-warning shadow rounded-circle">
                  <i class="ni ni-world"></i>
                </div>
                <h6 class="info-title text-uppercase text-warning">{{ __("Avoiding misunderstandings") }}</h6>
                <p class="description opacity-8">
                  {{ __("Your team will not have to worry about registering duplicate schedules in one place, as the system performs all the necessary validations before allowing any type of registration.") }}
                </p>
                <a href="javascript:;" class="text-primary">
                </a>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
    <!--end :) -->
@endsection
 