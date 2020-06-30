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
  @component('components.alert')@endcomponent
  <a href="#" data-toggle="modal" data-target="#modal-filter" id="filtros-locais" class="btn btn-sm btn-neutral mb-2 mr-2">{{ __("Filter") }}</a>
  {{-- Card Stats --}}
  <div class="row">
    {{-- Left --}}
    <div class="col-xl-6 col-md-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">@if(isset($lastMonth)) {{ __("New appointments this month") }} @else {{ __("New appointments") }} @endif</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $howManyNewSchedules }}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                            <i class="ni ni-check-bold"></i>
                        </div>
                    </div>
                </div>
                @if(isset($lastMonth))
                <p class="mt-3 mb-0 text-sm">
                  @if($goodConfirmedStatistic)
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ $confirmedStatistic }}%</span>
                  @elseif($goodConfirmedStatistic == false && $confirmedStatistic != 0)
                  <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{ $confirmedStatistic }}%</span>
                  @else
                  <span class="text-primary mr-2"><i class="ni ni-fat-delete"></i> 0.00%</span>
                  @endif
            
                  <span class="text-nowrap">
                    {{ __("Since ") }}
                    {{ ucfirst(__($lastMonth)) }}
                  </span>
                </p>
                @else 
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-nowrap">{{ __("From") }}
                      {{ dateBrazilianFormat($startDate) }}
                      {{ __("To") }}
                      {{ dateBrazilianFormat($endDate) }}
                    </span>
                </p>
                @endif
            </div>
        </div>
    </div>

    {{-- Right --}}
    <div class="col-xl-6 col-md-6">
      <div class="card card-stats">
          <div class="card-body">
              <div class="row">
                  <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">@if(isset($lastMonth)) {{ __("Canceled appointments this month") }} @else {{ __("Canceled appointments") }} @endif</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $howManyCanceledSchedules }}</span>
                  </div>
                  <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="fa fa-exclamation"></i>
                      </div>
                  </div>
              </div>
              @if(isset($lastMonth))
              <p class="mt-3 mb-0 text-sm">
                @if($goodCanceledStatistic)
                <span class="text-success mr-2"><i class="fa fa-arrow-down"></i> {{ $canceledStatistic }}%</span>
                @elseif($goodCanceledStatistic == false && $canceledStatistic != 0)
                <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> {{ $canceledStatistic }}%</span>
                @else
                <span class="text-primary mr-2"><i class="ni ni-fat-delete"></i> 0.00%</span>
                @endif
          
                <span class="text-nowrap">
                    {{ __("Since ") }} {{  ucfirst(__($lastMonth)) }}
                </span>
              </p>
              @else 
              <p class="mt-3 mb-0 text-sm">
                <span class="text-nowrap">{{ __("From") }}
                    {{ dateBrazilianFormat($startDate) }}
                    {{ __("To") }}
                    {{ dateBrazilianFormat($endDate) }}
                  </span>
              </p>
              @endif
          </div>
      </div>
    </div>
  </div>
  {{-- End Cards --}}

  @if($howManyNewSchedules > 0)
  {{-- Schedules Per Place Stats Table --}}
  <center>
    <h1>@if(isset($lastMonth)) {{ __("Most booked places this month") }} @else {{ __('Relationship between places and schedules') }} @endif</h1>
    <div id="placeChart"></div>
  </center>
  {{-- End Table Stats --}}
  @endif

  @component('components.modals.statistics')@endcomponent
@endsection

@section('scripts')
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawPlaceChart);

  function drawPlaceChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Local');
    data.addColumn('number', 'Quantidade');
    data.addRows([
      @foreach ($places as $place)
          ['{{ $place->name }}', {{ $appointmentsPerPlace[$place->id] }}],
      @endforeach
    ]);

    var options = {
      title: @if(isset($lastMonth)) "{{ __('Most booked places this month') }}" @else "{{ __('Relationship between places and schedules') }}" @endif,
      legend: {position: "right"}
    };

    var chart = new google.visualization.PieChart(document.getElementById("placeChart"));
    chart.draw(data, options);
  }
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
  <script src="{{ asset('js/plugins/maskNumber/dist/jquery.masknumber.min.js') }}"></script>
  <script>
  (function( $ ) {
      $(function() {
          $('.date').mask('00/00/0000');
      });
  })(jQuery);
  </script>

@endsection
