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
                <div class="float-right">
                    <button type="button" id="validate" class="btn btn-sm mb-3 btn-primary mt-0">{{ __("Validate") }}</button>
                </div>

                <div class="espaco"></div>

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
{{-- Input masks --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<script>
    $(document).ready(function ($){
        $("#cpf").mask('000.000.000-00')
        $("#cep").mask('00000-000')
    })
</script>

{{-- Get User Location By His Cep --}}
<script>
    $(document).ready(function (){

        $submitButton = $("#submit-button");
        $submitButton.prop('disabled', true);

        $("#validate").click(function (){
            $cepElement = $("#cep");
            $cepLabel = $("#cep-label");
            $cepMessage = $("#cep-message");
            $cep = $cepElement.val();

            /**
            * Elements
            *
            */
            $state = $("#state");
            $city = $("#city");
            $neighborhood = $("#neighborhood");
            $address = $("#address");
            $complementNumber = $("#complement_number");
            $loader = $("#pageloader");

            function errorMessage(){
                $submitButton.prop('disabled', true);
                $loader.hide();
                $cepLabel.hide();
                $cepMessage.html("{{ __('Please, enter a valid CEP') }}")
                $cepMessage.show();
                $cepElement.focus();
            }
    
            /**
            * Get Data By ViaCep
            * Provider 
            *
            */
            
            return;
            $.ajax({
                url: 'https://viacep.com.br/ws/' + $cep + '/json/unicode/',
                dataType: 'json',
    
                /**/
                beforeSend: function () {
                    $loader.show();
                },
    
                /**/
                success: function (response) {
                    $cepMessage.hide();
                    $cepLabel.show();
                    $submitButton.prop('disabled', false);

                    if(! response.uf ){
                        errorMessage()
                    }else {
                        $state.val(response.uf);
                        $city.val(response.localidade);
                        $neighborhood.val(response.bairro);
                        $address.val(response.logradouro);
                        $loader.hide();
                        $complementNumber.focus();
                    }
                },
    
                error: function () {
                    errorMessage()
                },
            });
        });
    });
    
</script>
@endsection

