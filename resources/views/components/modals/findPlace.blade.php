<div class="modal-filtros fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-filter" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="espacol"></div>
            <div class="text-center">
                <h3>{{ __("Check availability") }}</h3>
            </div>
            <div class="modal-body">
                <!--options-->

                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                                <h3>{{ __("Check by date and place") }}</h3>
                                <form action="{{route('places.availability')}}" class="form-loader" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="startFindPerDateAndPlace">{{ __("From") }}</label>
                                            <x-input id="startFindPerDateAndPlace" icon="date" name="start" class="date" :value="old('start')" :required="true" />
                                        </div>
                                        <div class="col-6">
                                            <label for="endFindPerDateAndPlace">{{ __("To") }}</label>
                                            <x-input id="endFindPerDateAndPlace" icon="date" name="end" class="date" :value="old('end')" :required="true" />
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
                                                            <option value="{{$place->id}}" @if(old('place_id') == $place->id) selected @endif>{{$place->name}}</option>
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
                                                <button title="{{ __("Click to Search") }}" @if (!$hasPlaces) disabled @endif class="btn btn-primary" type="submit">
                                                    {{ __("Consult") }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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