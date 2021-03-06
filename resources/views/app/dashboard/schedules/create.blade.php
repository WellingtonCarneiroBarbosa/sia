@extends('layouts.dashboard')

@section('title', 'Cadastrar Agendamento')

@section('content')

{{-- background --}}
<div class="header bg-primary pb-6">
    {{-- header --}}
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Schedule Event") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a onclick="comeBack()" class="btn btn-sm btn-neutral">{{ __("Come Back") }}</a>
                </div>
            </div>
        </div>
    </div>
    {{-- fim do header --}}

    {{-- alertas --}}
    @component('components.alert')@endcomponent

        {{-- formulario --}}
        <div class="row justify-content-center fadeInTransition" >
            <div class="card col-6 bg-secondary shadow border-0">
                <div class="card-body px-lg-10 py-lg-10">
                    <div class="text-center">
                        <h3>{{ __("Schedule Event") }}</h3>
                    </div>
                    <div class="text-center text-muted mb-4">
                        <small>{{ __("Fill in the details below to proceed") }}</small>
                    </div>
                    <form method="POST" action="{{ route('schedules.store') }}" class="form-loader">
                        @csrf
                        
                        {{-- Título do agendamento --}}
                        <x-input id="title" name="title" :value="old('title')" :placeholder="__('Schedule title')" :required="true" />


                        {{-- Select de locais --}}
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-sm"><i class="fa fa-map mr-2"></i>{{ __("Place") }}</span>
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
                            @if($hasPlaces)
                            <div class="float-right mb-2">
                                <a href="#" class="text-sm" id="viewPlace" title="{{ __("The link will open in a new tab") }}">{{ __("More details of this location") }}</a>
                            </div>
                            @endif
                        </div>
                        
                        {{-- participantes --}}
                        <x-input icon="group" id="participants" name="participants" :value="old('participants')" :placeholder="__('Expected number of participants')" :required="true" />

                        {{-- inicio do agendamento --}}
                        <label for="start">{{ __("Start Datetime") }}</label>
                        <x-input icon="date" class="datetime" id="start" name="start" :value="old('start')" :required="true" />

                        {{-- término do agendamento --}}
                        <label for="end">{{ __("End Datetime") }}</label>
                        <x-input icon="date" class="datetime" id="end" name="end" :value="old('end')" :required="true" />

                        <!-- cliente do agendamento -->
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02 mr-2"></i>{{ __("Customer") }}</span>
                                </div>

                                @if ($hasCustomers)
                                <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                    @foreach ($customers as $customer)
                                      <option value="{{$customer->id}}">{{$customer->corporation}}</option>
                                    @endforeach
                                  </select>
                                @else
                                <select name="customer_id" id="customer_id" disabled class="form-control @error('customer_id') is-invalid @enderror" required>
                                    <option selected>{{ __("Please register a customer") }}</option>
                                </select> 
                                @endif 
                                
                            </div>
                        </div>
                        <!-- fim do cliente do agendamento -->

                        <!-- detalhes do agendamento -->
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                </div>
                                <textarea title="{{ __("Fill this field") }}"  id="details" placeholder="{{ __("Scheduling Details") }}" class="form-control @error('details') is-invalid @enderror" name="details">{{ old('details') }}</textarea> 
                            </div>
                        </div>
                        <!-- fim do details do agendamento -->

                        <!-- em orçamento -->

                        <label for="status">{{ __("On budget") }}</label>
    
                        <label class="custom-toggle ml-2">
                            <input name="status" id="status" type="checkbox" @if(old('status') == 'on') checked @endif>
                            <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                        </label>
                     
                        <!-- fim em orçamento -->

                        <!-- submit button -->
                        <div class="text-center">
                            <button onclick="comeBack();" type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Cancel") }}</button>
                            
                            <button type="submit" id="agendar-submit" @if(!$hasPlaces || !$hasCustomers) disabled @endif class="btn btn-primary my-4">{{ __("Schedule") }}</button> 
                        </div>
                        <!-- fim do submit button -->
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <!--plugins-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
    <script src="{{ asset('js/plugins/maskNumber/dist/jquery.masknumber.min.js') }}"></script>
    <script>
        /**
         * Masks
         * 
         */
        (function( $ ) {
            $(function() {
                $("#participants").maskNumber({thousands: '.', integer: true});
                $('.datetime').mask('00/00/0000 00:00');
            });
        })(jQuery);

        $(document).ready(function (){
            /**view place*/
            $("#viewPlace").click(function (){
                var placeID = $("#place_id").val();
                /**url to show places */
                <?php echo "var showPlaceUrl = " . "'" . url("/dash/places/show") . "';";  ?>
                var url =  showPlaceUrl + '/' + placeID;
                window.open(url, '_blank');
            });
        });
    </script>

@endsection