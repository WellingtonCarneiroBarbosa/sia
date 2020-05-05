
    <div class="modal-filtros fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-filter" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="espacol"></div>
                <div class="text-center">
                    <h3>{{ __("Search Filters") }}</h3>
                </div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Choose one of the methods below to proceed") }}</small>
                </div>
                <div class="modal-body">
                    <!--options-->
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="form-intervalo-data-tab" data-toggle="tab" href="#form-intervalo-data" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa fa-calendar mr-2"></i>Inter. de Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="form-data-local-tab" data-toggle="tab" href="#form-data-local" role="tab" aria-controls="form-data-local" aria-selected="false"><i class="fa fa-map-marker-alt mr-2"></i>Data e Local</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="form-unica-data-tab" data-toggle="tab" href="#form-unica-data" role="tab" aria-controls="form-unica-data" aria-selected="false"><i class="fa fa-calendar mr-2"></i>Única Data</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="form-intervalo-data" role="tabpanel" aria-labelledby="form-intervalo-data">
                                    <h3>{{ __("Search by date range") }}</h3>
                                    <form action="{{route('schedules.findPer.dateRange')}}" class="form-loader" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="">{{ __("From") }}</label>
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="start" class="form-control date" placeholder="dd/mm/aaaa" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="">{{ __("To") }}</label>
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="end" class="form-control date" placeholder="dd/mm/aaaa" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- btn pesquisar -->
                                        <div class="float-right">
                                            <button title="{{ __("Click to Search") }}" class="btn btn-primary" type="submit">
                                                {{ __("Search") }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="form-data-local" role="tabpanel" aria-labelledby="form-data-local-tab">
                                    <h3>{{ __("Search by date and place") }}</h3>
                                    <form action="{{route('schedules.findPer.dateAndPlace')}}" class="form-loader" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="">{{ __("From") }}</label>
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="start" placeholder="dd/mm/aaaa" class="form-control date" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="">{{ __("To") }}</label>
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="end" class="form-control date" placeholder="dd/mm/aaaa" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="local">{{ __("Place") }}</label>

                                                    <div class="input-group mb-4">

                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-map"></i></span>
                                                        </div>

                                                        @if ($hasPlaces)
                                                        <select name="place_id" id="place_id" class="form-control @error('place_id') is-invalid @enderror" required>
                                                            @foreach ($places as $place)
                                                                <option value="{{$place->id}}">{{$place->name}}</option>
                                                            @endforeach
                                                        </select> 
                                                        @else
                                                        <select name="place_id" id="place_id" disabled class="form-control @error('place_id') is-invalid @enderror" required>
                                                            <option selected>{{ __("Please register a place") }}</option>
                                                        </select>
                                                        @endif 

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="espaco"></div>
                                                <div class="float-right">
                                                    <button title="{{ __("Click to Search") }}" class="btn btn-primary" type="submit">
                                                        {{ __("Search") }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="form-unica-data" role="tabpanel" aria-labelledby="form-unica-data">
                                    <h3>{{ __("Search by single date") }}</h3>
                                    <form action="{{route('schedules.findPer.specificDate')}}" class="form-loader" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required name="date" id="unica_data" class="form-control date" placeholder="dd/mm/aaaa" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <!-- btn pesquisar -->
                                                    <div class="float-right">
                                                        <button title="{{ __("Click to Search") }}" class="btn btn-primary" type="submit">
                                                    {{ __("Search") }}
                                                </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end options-->


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary  ml-auto" data-dismiss="modal">{{ __("Close") }}</button>
                </div>
            </div>
        </div>
    </div>