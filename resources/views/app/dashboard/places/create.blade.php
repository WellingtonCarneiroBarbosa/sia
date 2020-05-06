@extends('layouts.dashboard')
@section('title', 'Cadastrar Local')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Register Place") }}</h6>
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
                <div class="text-center"><h3>{{ __("Register Place") }}</h3></div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Fill in the details below to proceed") }}</small>
                </div>
                <form method="POST" class="form-loader" action="{{ route('places.store') }}">
                @csrf

                <!--nome do local-->
                <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-building"></i></span>
                        </div>

                        <input id="name" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("Place") }}"  class="form-control " value="{{ old('name') }}" name="name" required>
                    
                    </div>
                </div>
                <!--fim do nome do local-->

                <!--lotação-->
                <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-users"></i></span>
                        </div>

                        <input id="capacity" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("Capacity") }}"  class="form-control " name="capacity" value="{{ old('capacity') }}" required>
                    
                    </div>
                </div>
                <!--fim da lotação-->

                <!--espaco em m2-->
                <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-vector-square"></i></span>
                        </div>

                        <input id="size" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("Square meters") }}"  class="form-control " name="size" value="{{ old('size') }}" required>
                        
                    </div>
                </div>
                <!--fim da espaco em m2-->

               <div class="form-group">
                    <!--tensão-->
                    <label for="outletVoltage">{{ __("Outlet voltage") }}:</label>
                    <div class="custom-control custom-radio custom-control-inline ml-2">
                        <input type="radio" id="outletVoltage" name="outletVoltage" class="custom-control-input" @if(old('outletVoltage') == '0') checked @endif value="0">
                        <label class="custom-control-label" for="outletVoltage">127v</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="outletVoltage220" name="outletVoltage" class="custom-control-input" @if(old('outletVoltage') == '1') checked @endif value="1">
                        <label class="custom-control-label" for="outletVoltage220">220v</label>
                    </div>
               </div>

                <!--projetor-->
                <div class="form-group">
                    <label for="hasProjector"> {{ __("Projectors") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasProjector" name="hasProjector" type="checkbox" @if(old('hasProjector') == 'on') checked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>

                <div id="howManyProjectorsDiv" class="form-group" @if(old('hasProjector') != 'on') style="display: none" @endif>
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-building"></i></span>
                        </div>

                        <input id="howManyProjectors" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("How many projectors?") }}"  class="form-control " value="@if(old('hasProjector') == 'on') {{ old('howManyProjectors') }} @endif" name="howManyProjectors">
                    
                    </div>
                </div>
                <!--fim do projetor-->

                <!--cabines de tradução-->
                <div class="form-group">
                    <label for="hasTranslationBooth"> {{ __("Translation booths") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasTranslationBooth" name="hasTranslationBooth" type="checkbox" @if(old('hasTranslationBooth') == 'on') checked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>

                <div id="howManyBoothsDiv" class="form-group" @if(old('hasTranslationBooth') != 'on') style="display: none;" @endif>
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-building"></i></span>
                        </div>

                        <input id="howManyBooths" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("How many booths?") }}"  class="form-control " value="@if(old('hasTranslationBooth') == 'on') {{ old('howManyBooths') }} @endif" name="howManyBooths">
                    
                    </div>
                </div>
                <!--fim do cabines de tradução-->

                <!--sonorização-->
                <div class="form-group">
                    <label for="hasSound"> {{ __("Sound") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasSound" name="hasSound" type="checkbox"  @if(old('hasSound')) checked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do sonorização-->

                <!--iluminacao-->
                <div class="form-group">
                    <label for="hasLighting"> {{ __("Scenic lighting") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasLighting" name="hasLighting" type="checkbox" @if(old('hasLighting')) checked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do iluminacao-->

                <!--wifi-->
                <div class="form-group">
                    <label for="hasWifi"> {{ __("Wifi") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasWifi" name="hasWifi" type="checkbox"  @if(old('hasWifi')) checked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do wifi-->

                <!--accessibility-->
                <div class="form-group">
                    <label for="hasAccessibility"> {{ __("Accessibility") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasAccessibility" name="hasAccessibility" type="checkbox"  @if(old('hasAccessibility')) checked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do accessibility-->

                <!--estacionamento-->
                <div class="form-group">
                    <label for="hasFreeParking"> {{ __("Free parking") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasFreeParking" name="hasFreeParking" type="checkbox"  @if(old('hasFreeParking')) checked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do estacionamento-->

                <!-- submit button -->
                    <div class="text-center">
                        <button onclick="comeBack();" type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Cancel") }}</button>
                        <button type="submit" title="{{ __("Click to register this place") }}" class="btn btn-primary my-4">{{ __("Register Place") }}</button>
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
