@extends('layouts.dashboard')

@section('title', Lang::get('My Profile'))

@section('content')
{{-- Header --}}
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("My Profile") }}</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="#" class="btn btn-sm btn-neutral" onclick="em_desenvolvimento_alert()" data-toggle="modal" data-target="#modal-form">{{ __("Edit Profile") }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Header --}}

<!-- Page content -->
<div class="container-fluid mt--6">
    {{-- Alerts --}}
    @component('components.alert')@endcomponent
    <div class="row">
        <div class="col-xl-12 order-xl-2">
            <div class="card card-profile">
                {{-- Profile Image --}}
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            @if(auth()->user()->profile_image != null)
                            <img style="width: 9em; height: 9em" src="{{ url('storage/users/profile_image/'.auth()->user()->profile_image) }}">
                            @else
                            <img src="https://www.auctus.com.br/wp-content/uploads/2017/09/sem-imagem-avatar.png">
                            @endif
                        </div>
                    </div>
                </div>
                {{-- End Profile Image --}}

                {{-- Choose what data see --}}
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                        <a  href="#!" class="btn btn-sm btn-default mr-4" id="show-system-data">{{ __("System Data") }}</a>
                        <a href="#!" class="btn btn-sm btn-info float-right" id="show-personal-data">{{ __("Personal Data") }}</a>
                    </div>
                </div>
                {{-- End what data see --}}

                {{-- User Name --}}
                <div class="text-center">
                    <h5 class="h3">{{ ucFirstNames(auth()->user()->name) }}</h5>
                </div>

                {{-- Personal Data --}}
                <div class="card-body pt-0">
                    <div class="text-center" id="personal-data">
                        <div class="pb-3">
                            <span class="font-weight-light">{{ __("Personal Data") }}</span>
                            <br>
                            <i><span class="font-weight-light text-sm">{{ __("Only you can see your personal data") }}</span></i>
                        </div>
                        
                        <div class="pb-3">
                            <span class="font-weight-light">{{ __("State") }}:</span>
                            <strong id="state"></strong>
                        </div>
                        
                        <div class="pb-3">
                            <span class="font-weight-light">{{ __("City") }}:</span>
                            <strong id="city"></strong>
                        </div>
                        
                        <div class="pb-3">
                            <span class="font-weight-light">{{ __("Neighborhood") }}:</span>
                            <strong id="neighborhood"></strong>
                        </div>
                        
                        <div class="pb-3">
                            <span class="font-weight-light">{{ __("Address") }}:</span>
                            <strong id="address"></strong><strong>, {{ auth()->user()->complement_number }}</strong>
                        </div>
                        
                        <div class="pb-3">
                            <span class="font-weight-light">CEP:</span>
                            <strong id="user-cep">{{ CEPscore(auth()->user()->cep) }}</strong>
                        </div>

                        <div class="pb-3">
                            <span class="font-weight-light">CPF:</span>
                            <strong>{{ CPFscore(auth()->user()->cpf) }}</strong>
                        </div>
                </div>
                {{-- End Personal Data --}}

                {{-- System Data --}}
                <div class="text-center" id="system-data" >
                    <div class="pb-3">
                        <span class="font-weight-light">{{ __("System Data") }}</span>
                    </div>

                    <div class="pb-2">
                        <span class="font-weight-light">E-mail:</span> <Strong>{{auth()->user()->email}}</Strong>
                    </div>

                    <div class="pb-2">
                        <span class="font-weight-light">{{ __("User Type") }}:</span>
                        @if(auth()->user()->role_id == 5)
                            <Strong>{{ __("Administrator") }}</Strong>
                        @else
                            <Strong>{{ __("Standart") }}</Strong>
                        @endif
                    </div>
                    
                    <div class="pb-2">
                        <span class="font-weight-light">{{ __("Registered at") }}:</span>
                        <strong>{{dateBrazilianFormat(auth()->user()->created_at)}} {{ __("at") }} {{ timeBrazilianFormat(auth()->user()->created_at) }}</strong>
                    </div>

                    {{-- Conta verificada em --}}
                    <div class="pb-2">
                        <span class="font-weight-light">{{ __("Verified account on") }}:</span>
                        <strong>{{ dateBrazilianFormat(auth()->user()->email_verified_at) }} {{ __("at") }} {{ timeBrazilianFormat(auth()->user()->email_verified_at) }}</strong>
                    </div>

                    {{-- conta completa em --}}
                    <div class="pb-2">
                        <span class="font-weight-light">{{ __("Account completed at") }}:</span>
                        <strong>{{ dateBrazilianFormat(auth()->user()->profile_completed_at) }} {{ __("at") }} {{ timeBrazilianFormat(auth()->user()->email_verified_at) }}</strong>
                    </div>

                    {{-- editado em --}}
                    @if (auth()->user()->created_at != auth()->user()->updated_at && auth()->user()->updated_at != auth()->user()->deleted_at && auth()->user()->updated_at != auth()->user()->profile_completed_at)
                        <div class="pb-2">
                            <span class="font-weight-light">{{ __("Last update on profile at") }}:</span>
                            <strong>{{dateBrazilianFormat(auth()->user()->updated_at)}} {{ __("at") }} {{ timeBrazilianFormat(auth()->user()->updated_at) }}</strong>
                        </div>
                    @endif

                </div>
                {{-- End System data --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
@section('scripts')
{{-- Show/Hide Profile Data --}}
<script>

    $(document).ready(function (){
        $systemData = $("#system-data");
        $personalData = $("#personal-data");

        $systemDataButton = $("#show-system-data");
        $personalDataButton = $("#show-personal-data");

        $systemData.hide();
        $personalData.show();

        $systemDataButton.click(function (){
            $personalData.hide(500);
            $systemData.show();
        });

        $personalDataButton.click(function(){
            $systemData.hide(500);
            $personalData.show();
        });
    });

</script>

{{-- Get User Location By His Cep --}}
<script>
    $(document).ready(function (){
        $cep = $("#user-cep").html();
        /**
        * Elements
        *
        */
        $state = $("#state");
        $city = $("#city");
        $neighborhood = $("#neighborhood");
        $address = $("#address");
        $loader = $("#pageloader");

        /**
        * Get Data By ViaCep
        * Provider 
        *
        */
        $.ajax({
            url: 'https://viacep.com.br/ws/' + $cep + '/json/unicode/',
            dataType: 'json',

            /**/
            beforeSend: function () {
                $loader.show();
            },

            /**/
            success: function (response) {
                $state.html(response.uf);
                $city.html(response.localidade);
                $neighborhood.html(response.bairro);
                $address.html(response.logradouro);
                $loader.hide();
            },

            error: function () {
                alert("{{ __('Something went wrong. Please refresh the page!') }}");
            },
        });

    });
</script>
@endsection