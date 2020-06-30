@extends('layouts.dashboard')
@section('title', Lang::get('Edit Profile'))
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Edit Profile") }}</h6>
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
                <div class="text-center"><h3>{{ __("Edit Profile") }}</h3></div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Fill in the details below to proceed") }}</small>
                </div>
                <form method="POST" class="form-loader" action="{{ route('myProfile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    
                {{--  nome do usuario --}}
                <label for="name">{{ __("Name") }}:</label>
                <x-input icon="ni ni-single-02" id="name" name="name" :value="auth()->user()->name" :placeholder="__('User Full Name')" :required="true"/>

                {{--  email do usuario --}}
                <span class="text-sm">{{ __("Unable to edit your email") }}</span>
                <x-input icon="ni ni-email-83" id="email" name="email" type="email" :value="auth()->user()->email" disabled :placeholder="__('User Corporative Email')" :required="true"/>

                <span class="text-sm">{{ __("Unable to edit your CPF") }}</span>
                <x-input icon="ni ni-badge" id="cpf" disabled name="cpf" :value="CPFscore(auth()->user()->cpf)" :required="true"/>

                <label for="cep" id="cep-label">{{ __("CEP") }}:</label>
                <span id="cep-message" class="text-danger"></span>
                <x-input icon="ni ni-map-big"  id="cep" name="cep" :value="CEPscore(auth()->user()->cep)" :required="true"/>

                <label for="complement_number">{{ __("Complement Number") }}:</label>
                <x-input id="complement_number" name="complement_number" :value="auth()->user()->complement_number"  :required="true" />

                {{-- Image input --}}
                <label for="profile_image">{{ __("Profile Image") }}</label>
                <div class="form-group">
                    <x-input icon="fa fa-image" id="profile_image" name="profile_image" type="file" :required="false" />
                </div>

                <!-- submit button -->
                    <div class="text-center">
                        <button onclick="comeBack();" type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Cancel") }}</button>
                        <button type="submit" id="submit-button" title="{{ __("Click to edit") }}" class="btn btn-primary my-4">{{ __("Edit") }}</button>
                    </div>
                <!-- fim do submit button -->
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal-filtros fade" id="modal-action" tabindex="-1" role="dialog" aria-labelledby="modal-action" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="espacol"></div>
                <div class="modal-body">
                  
                    <label for="state">{{ __("State") }}</label>
                    <x-input id="state" class="disabled" :placeholder="__('This will be completed automatically')" disabled /> 

                    <label for="city">{{ __("City") }}</label>
                    <x-input id="city" class="disabled" :placeholder="__('This will be completed automatically')" disabled />

                    <label for="neighborhood">{{ __("Neighborhood") }}</label>
                    <x-input id="neighborhood" class="disabled" :placeholder="__('This will be completed automatically')" disabled />

                    <label for="address">{{ __("Address") }}</label>
                    <x-input id="address" class="disabled" :placeholder="__('This will be completed automatically')" disabled />
                    
                    <center>
                        <button id="close-modal" type="button" class="btn btn-outline-primary  ml-auto" data-dismiss="modal">{{ __("Okay") }}</button>
                    </center>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts') 
{{-- Input masks --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{ asset('dashboard/assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script>

$(document).ready(function ($){
    $("#cep").mask('00000-000')

    $loader = $("#pageloader");
    $cepLabel = $("#cep-label");
    $cepMessage = $("#cep-message");
    $submitButton = $("#submit-button");

    $("#cep").keyup(function(){
        if($(this).val().length === 9) {
            var endpoint = "https://viacep.com.br/ws/" + $(this).val() + "/json/unicode/";

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

                // Scroll to the modal
                window.scrollTo(0, 0);

                $loader.hide();

                $('#modal-action').modal();

                $("#close-modal").click(function (){
                    $complementNumber.focus();
                });  
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
    });
});
</script>

@endsection
