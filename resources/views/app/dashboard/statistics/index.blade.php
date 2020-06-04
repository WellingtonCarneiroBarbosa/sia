@extends('layouts.dashboard')

@section('title', Lang::get('Statistics'))

@section('styles')

@endsection

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Statistics") }}</h6>
                </div>
            </div>
            <!-- fim do header -->
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
  {{-- Card Stats --}}
  <div class="row">
    {{-- Left --}}
    <div class="col-xl-6 col-md-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __("New appointments this month") }}</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $howManyNewSchedules }}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                            <i class="ni ni-check-bold"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  @if($goodConfirmedStatistic)
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ $confirmedStatistic }}%</span>
                  @elseif($goodConfirmedStatistic == false && $confirmedStatistic != 0)
                  <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{ $confirmedStatistic }}%</span>
                  @else
                  <span class="text-primary mr-2"><i class="ni ni-fat-delete"></i> 0.00%</span>
                  @endif
            
                  <span class="text-nowrap">{{ __("Since ") }}
                    {{ ucfirst($lastMonth) }}
                  </span>
                </p>
            </div>
        </div>
    </div>

    {{-- Right --}}
    <div class="col-xl-6 col-md-6">
      <div class="card card-stats">
          <div class="card-body">
              <div class="row">
                  <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">{{ __("Canceled appointments this month") }}</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $howManyNewSchedules }}</span>
                  </div>
                  <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="fa fa-exclamation"></i>
                      </div>
                  </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                @if($goodCanceledStatistic)
                <span class="text-success mr-2"><i class="fa fa-arrow-down"></i> {{ $canceledStatistic }}%</span>
                @elseif($goodCanceledStatistic == false && $canceledStatistic != 0)
                <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> {{ $canceledStatistic }}%</span>
                @else
                <span class="text-primary mr-2"><i class="ni ni-fat-delete"></i> 0.00%</span>
                @endif
          
                <span class="text-nowrap">{{ __("Since ") }}
                  {{ ucfirst($lastMonth) }}
                </span>
              </p>
          </div>
      </div>
    </div>
  </div>
  {{-- End Cards --}}


      {{-- Table Stats Start--}}
      <div class="row">
        <div class="col-xl-12">
          <div class="card bg-default">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                  <h5 class="h3 text-white mb-0">Sales value</h5>
                </div>
                <div class="col">
                  <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                      <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                        <span class="d-none d-md-block">Month</span>
                        <span class="d-md-none">M</span>
                      </a>
                    </li>
                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                      <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                        <span class="d-none d-md-block">Week</span>
                        <span class="d-md-none">W</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- End Table Stats --}}
@endsection

@section('scripts')
    <script src="{{ asset('dashboard/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/chart.js/dist/Chart.extension.js') }}"></script> 
    <script src="{{ asset('dashboard/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>   
    <script src="{{ asset('dashboard/assets/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/argon.min.js?v=1.2.0') }}"></script>
@endsection