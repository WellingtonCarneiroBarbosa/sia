@extends('layouts.dashboard')

@section('title', 'Editar Agendamento')

@section('content')

<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Edit Schedule") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-neutral mb-2">{{ __("Come back to schedules") }}</a>
                </div>
            </div>
            <!-- fim do header -->
        </div>
    </div>
    <!-- alertas -->
    @component('components.alert')@endcomponent
    
        <!-- animacao de entrada -->
        <div class="row justify-content-center fadeInTransition" >
            <div class="card col-6 bg-secondary shadow border-0">
                <div class="card-body px-lg-10 py-lg-10">
                    <div class="text-center">
                        <h3>{{ __("Edit Schedule") }}</h3>
                    </div>
                    <div class="text-center text-muted mb-4">
                        <small>{{ __("Fill in the details below to proceed") }}</small>
                    </div>
                    <form method="POST" action="{{ route('schedules.update', ['id' => $schedule->id]) }}" class="form-loader">
                        @csrf
                        @method('PUT')

                        {{-- Título do agendamento --}}
                        <label for="title">{{ __("Schedule title") }}</label>
                        <x-input id="title" name="title" :value="$schedule->title" :placeholder="__('Schedule title')" :required="true" />

                        <!-- local do agendamento -->
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-sm"><i class="fa fa-map mr-2"></i>{{ __("Place") }}</span>
                                </div>

                                @if ($hasPlaces)
                                <select name="place_id" id="place_id" class="form-control @error('place_id') is-invalid @enderror" required>
                                    @foreach ($places as $place)
                                        <option value="{{$place->id}}"
                                        @if($place->id == $schedule->place_id)
                                        selected='selected'
                                        @endif 
                                        >{{$place->name}}</option>
                                    @endforeach
                                </select> 
                                @else
                                <select name="place_id" id="place_id" disabled class="form-control @error('place_id') is-invalid @enderror" required>
                                    <option selected>{{ __("Please register a place") }}</option>
                                </select>
                                @endif 
            
                            </div>
                            @if($hasPlaces)
                            <div class="float-right">
                                <a href="#" class="text-sm" id="viewPlace" title="{{ __("The link will open in a new tab") }}">{{ __("More details of this location") }}</a>
                            </div>
                            @endif
                        </div>
                        <!-- fim local do agendamento -->

                        {{-- participantes --}}
                        <label for="participants">{{ __("Expected number of participants") }}</label>
                        <x-input icon="group" id="participants" name="participants" :value="$schedule->participants" :placeholder="__('Expected number of participants')" :required="true" />

                        {{-- inicio do agendamento --}}
                        <label for="start">{{ __("Start Datetime") }}</label>
                        <x-input icon="date" class="datetime" id="start" name="start" :value="dateTimeBrazilianFormat($schedule->start)" :required="true" />

                        {{-- término do agendamento --}}
                        <label for="end">{{ __("End Datetime") }}</label>
                        <x-input icon="date" class="datetime" id="end" name="end" :value="dateTimeBrazilianFormat($schedule->end)" :required="true" />


                        <!-- cliente do agendamento -->
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02 mr-2"></i>{{ __("Customer") }}</span>
                                </div>

                                @if ($hasCustomers)
                                <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                    @foreach ($customers as $customer)
                                      <option value="{{$customer->id}}" 
                                        @if($customer->id == $schedule->customer_id)
                                        selected='selected'
                                        @endif   
                                      >{{$customer->corporation}}</option>
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
                            <label for="details">{{ __("Scheduling Details") }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                </div>
                                <textarea title="{{ __("Fill this field") }}"  id="details" placeholder="{{ __("Scheduling Details") }}" class="form-control @error('details') is-invalid @enderror" name="details" value="{{ old('details') }}">
                                {{ $schedule->details }}
                                </textarea> 
                            </div>
                        </div>
                        <!-- fim do details do agendamento -->

                        <!-- pendente ou nao -->

                        <label for="status">{{ __("On budget") }}</label>
    
                        <label class="custom-toggle ml-2">
                            <input name="status" id="status" type="checkbox" 
                            @if($schedule->status == null) 
                                checked
                            @else 
                                unchecked
                            @endif>
                            <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                        </label>
                        <!-- fim do pendente ou nao -->

                        <!-- submit button -->
                        <div class="text-center">
                            <a href="{{ route('home') }}">
                                <button type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Cancel") }}</button>
                            </a>
                            <button @if(!$hasPlaces || !$hasCustomers) disabled @endif type="submit" id="agendar-submit" class="btn btn-primary my-4">{{ __("Edit") }}</button> 
                        </div>
                        <!-- fim do submit button -->
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>

<script>
    (function( $ ) {
        $(function() {
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