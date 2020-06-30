@extends('layouts.dashboard')
@section('title', Lang::get('Complete Register'))
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    @component('components.progressBar', ['progress' => '30'])@endcomponent
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Stage 1") }}</h6>
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
                <div class="text-center"><h3>{{ __("Complete Register") }}</h3></div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Fill in the details below to proceed") }}</small>
                </div>
                <form method="POST" class="form-loader" action="{{ route('complete.profile.storeStageOne') }}">
                @csrf

                {{--  cpf do usuario --}}
                <label for="cpf">{{ __('What is your CPF?') }}</label>
                <x-input icon="ni ni-badge" id="cpf" name="cpf" :value="auth()->user()->cpf ?: old('cpf')" :required="true"/>

                {{--  cep do usuario --}}
                <label for="cep" id="cep-label">{{ __("And your CEP?") }}</label>
                <span id="cep-message" class="text-danger"></span>
                <x-input icon="ni ni-map-big" id="cep" name="cep" :value="auth()->user()->cep ?: old('cep')" :required="true"/>

                <label for="state">{{ __("State") }}</label>
                <x-input id="state" class="disabled" :placeholder="__('This will be completed automatically')" disabled /> 

                <label for="city">{{ __("City") }}</label>
                <x-input id="city" class="disabled" :placeholder="__('This will be completed automatically')" disabled />

                <label for="neighborhood">{{ __("Neighborhood") }}</label>
                <x-input id="neighborhood" class="disabled" :placeholder="__('This will be completed automatically')" disabled />
      
                <label for="address">{{ __("Address") }}</label>
                <x-input id="address" class="disabled" :placeholder="__('This will be completed automatically')" disabled />
          
                <label for="complement_number">{{ __("Complement Number") }}</label>
                <x-input id="complement_number" name="complement_number" :value="auth()->user()->complement_number ?: old('complement_number')"  :required="true" />

                <!-- submit button -->
                    <div class="text-center">
                        <button id="submit-button" type="submit" title="{{ __("Click to go to stage 2") }}" class="btn btn-primary my-4" disabled>{{ __("Go to stage 2") }}</button>
                    </div>
                <!-- fim do submit button -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts') 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{ asset('dashboard/assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script>

$(document).ready(function ($){
    $("#cpf").mask('000.000.000-00')
    $("#cep").mask('00000-000')

    $submitButton = $("#submit-button");
    $loader = $("#pageloader");
    $cepLabel = $("#cep-label");
    $cepMessage = $("#cep-message");
    
    
    function getCep(cep) {
        var endpoint = "https://viacep.com.br/ws/" + cep + "/json/unicode/";

        function exceptionCEP () {
            $submitButton.prop('disabled', true);
            $cepLabel.hide();
            $cepMessage.html("{{ __('Please, enter a valid CEP') }}")
            $cepMessage.show();
            $(this).focus();
            $loader.hide();
        }

        function successCEP (response) {
            $state = $("#state").val(response.uf);
            $city = $("#city").val(response.localidade);
            $neighborhood = $("#neighborhood").val(response.bairro);
            $address = $("#address").val(response.logradouro);
            $complementNumber = $("#complement_number");

            $submitButton.prop('disabled', false);
            $cepLabel.show();
            $cepMessage.hide()

            $complementNumber.focus();
            $loader.hide();
        }

        $.ajax({
            url: endpoint,
            dataType: 'json',

            beforeSend: function () {
                $loader.show()
            }, 

            success: function (response) {
                if(response.erro) {
                    exceptionCEP()
                    return;
                }

                successCEP(response);
                return;
            },

            error: function () {
                exceptionCEP()
                return;
            }
        });
    }

    if($("#cep").val().length === 9) {
        $submitButton.prop('disabled', false);
        getCep($("#cep").val());
    }

    $("#cep").keyup(function(){
        if($(this).val().length === 9) {
            var cep = $(this).val();

            getCep(cep);
        }
    });
});
</script>
@endsection

