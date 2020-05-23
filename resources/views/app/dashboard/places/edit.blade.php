@extends('layouts.dashboard')
@section('title', Lang::get('Update Place'))
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Update Place") }}</h6>
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
                <div class="text-center"><h3>{{ __("Update Place") }}</h3></div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Fill in the details below to proceed") }}</small>
                </div>
                <form method="POST" class="form-loader" action="{{ route('places.update', ['id' => $place->id]) }}">
                @csrf
                @method('PUT')

                {{-- nome do local --}}
                <label for="name">{{ __("Place") }}</label>
                <x-input icon="ni ni-building" id="name" name="name" :value="$place->name" :placeholder="__('Place')" :required="true" />

                {{-- lotação --}}
                <label for="capacity">{{ __("Capacity") }}</label>
                <x-input icon="group" id="capacity" name="capacity" :value="str_replace(',', '.', number_format($place->capacity))" :placeholder="__('Capacity')" :required="true" />

                {{-- tamanho em m2 --}}
                <label for="size">{{ __("Square meters") }}</label>
                <x-input icon="fa fa-vector-square" id="size" name="size" :value="str_replace(',', '.', number_format($place->size))" :placeholder="__('Square meters')" :required="true" />

                <div class="form-group">
                    <!--tensão-->
                    {{ __("Outlet voltage") }}:
                    <div class="custom-control custom-radio custom-control-inline ml-2">
                        <input type="radio" id="outletVoltage" name="outletVoltage" class="custom-control-input" @if(!$place->outletVoltage) checked @endif value="0">
                        <label class="custom-control-label" for="outletVoltage">127v</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="outletVoltage220" name="outletVoltage" class="custom-control-input"  @if($place->outletVoltage) checked @endif value="1">
                        <label class="custom-control-label" for="outletVoltage220">220v</label>
                    </div>
               </div>

                <!--projetor-->
                <div class="form-group">
                    <label for="hasProjector"> {{ __("Projectors") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasProjector" name="hasProjector" type="checkbox" @if($place->hasProjector) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>

                <div id="howManyProjectorsDiv" class="form-group" style="@if(!$place->hasProjector) display: none; @endif">
                    <label for="howManyProjectors">{{ __('How many projectors?') }}</label>
                    <x-input icon="ni ni-building" id="howManyProjectors" name="howManyProjectors" :value="$place->howManyProjectors" :placeholder="__('How many projectors?')" />
                </div>
                <!--fim do projetor-->

                <!--cabines de tradução-->
                <div class="form-group">
                    <label for="hasTranslationBooth"> {{ __("Translation booths") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasTranslationBooth" name="hasTranslationBooth" type="checkbox" @if($place->hasTranslationBooth) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>

                <div id="howManyBoothsDiv" class="form-group" style="@if(!$place->hasTranslationBooth) display: none; @endif">
                    <label for="howManyBooths">{{ __('How many booths?') }}</label>
                    <x-input icon="ni ni-building" id="howManyBooths" name="howManyBooths" :value="$place->howManyBooths" :placeholder="__('How many booths?')"/>
                </div>
                <!--fim do cabines de tradução-->

                <!--sonorização-->
                <div class="form-group">
                    <label for="hasSound"> {{ __("Sound") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasSound" name="hasSound" type="checkbox" @if($place->hasSound) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do sonorização-->

                <!--iluminacao-->
                <div class="form-group">
                    <label for="hasLighting"> {{ __("Scenic lighting") }}?</label>
                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasLighting" name="hasLighting" type="checkbox" @if($place->hasLighting) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do iluminacao-->

                <!--wifi-->
                <div class="form-group">
                    <label for="hasWifi"> {{ __("Wifi") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasWifi" name="hasWifi" type="checkbox" @if($place->hasWifi) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do wifi-->

                <!--accessibility-->
                <div class="form-group">
                    <label for="hasAccessibility"> {{ __("Accessibility") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasAccessibility" name="hasAccessibility" type="checkbox" @if($place->hasAccessibility) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do accessibility-->

                <!--estacionamento-->
                <div class="form-group">
                    <label for="hasFreeParking"> {{ __("Free parking") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasFreeParking" name="hasFreeParking" type="checkbox" @if($place->hasFreeParking) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do estacionamento-->

                <!-- submit button -->
                    <div class="text-center">
                        <a href="{{ route('places.index') }}">
                            <button type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Cancel") }}</button>
                        </a>
                        <button type="submit" title="{{ __("Click to update this place") }}" class="btn btn-primary my-4">{{ __("Update Place") }}</button>
                    </div>
                <!-- fim do submit button -->
                </form>
            </div>
        </div>
    </div>
</div>
<input style="display: none" id="sizeOriginalDatabase" value="{{ $place->size }}">
@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
    <script src="{{ asset('js/plugins/maskNumber/dist/jquery.masknumber.min.js') }}"></script>
    <script>
        $(document).ready(function (){
            /**
            * Elements
            * 
            */
            $hasProjector            = $("#hasProjector");
            $howManyProjectors       = $("#howManyProjectorsDiv");
            $hasTranslationBooth     = $("#hasTranslationBooth");
            $howManyBooths           = $("#howManyBoothsDiv");

            /**
            * Verify hasProjectorStatus
            * if true, show howManyProjectorsInput
            *
            */
            $hasProjector.change(function (){
                if(this.checked){
                    return $howManyProjectors.show();
                }
                
                return $howManyProjectors.hide();
            });

            /**
            * Verify hasTranslationBooths status
            * if true, show howManyBoothsInput
            *
            */
            $hasTranslationBooth.change(function (){
                if(this.checked){
                    return $howManyBooths.show();
                }
                
                return $howManyBooths.hide();
            });
        });

        (function( $ ) {
            $(function() {
                $("#capacity").maskNumber({thousands: '.', integer: true});
                $("#size").maskNumber({ thousands: '.', integer: true, });
                $("#howManyProjectors").mask('00');
                $("#howManyBooths").mask('00');
            });
        })(jQuery);
    </script>
@endsection