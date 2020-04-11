@extends('layouts.home')

@section('title', 'Redefinir Senha')

@section('content')


<section class="section section-shaped section-lg">
    <!-- background -->
    <div class="shape shape-style-1 bg-gradient-default">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- fim do background -->

    <!-- inicio do conteudo-->
    <div class="container pt-lg-7">
        <div class="row justify-content-center">
            <div class="alert alert-warning alert-dismissible fade show mr-2" role="alert">
                <span class="alert-inner--text"><i class="fa fa-warning mr-2"></i>
                    <strong>{{ __("Attention to our password policy") }}:</strong>
                </span>

                <br>

                <li class="ml-3">{{ __("The password must be between 8 and 16 characters") }};</li>
                <li class="ml-3">{{ __("At least 1 numeric character") }};</li>
                <li class="ml-3">{{ __("At least 1 uppercase character") }};</li>
                <li class="ml-3">{{ __("At least 1 lowercase character") }};</li>
                <li class="ml-3">{{ __("At least 1 special character") }}.</li>
                <span class="alert-inner--text"><i class="fa fa-arrow-right"></i>
                    {{ __("Exemple") }}: "<strong>Minha12Senha!</strong>"
                </span>

                <!--
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                -->
            </div>
            <div class="col-lg-5">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">

                        @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--text"><i class="ni ni-like-2"></i><strong>{{  __("Success") }}!</strong> {{session('status')}}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endif
                
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-inner--text"><i class="fas fa-thumbs-down"></i><strong> {{ __("Opps") }}...</strong>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endif

                        <div class="text-center"><h3>{{ __('Reset Password') }}</h3></div>
                        <div class="text-center text-muted mb-4">
                            <small>{{ __("Fill in the details below to proceed") }}</small>
                        </div>
                        <!-- form reset password -->
                        <form class="form-loader" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <input id="email"  type="hidden" name="email" value="{{ $email ?? old('email') }}" required>

                        <div class="form-group focused">

                            
                            <label for="password" id="labelSenha"></label>
                            <label id="labelSenhaConfirm" style="display: none;">{{ __("Passwords are not the same") }}.</label>

                            <div class="input-group input-group-alternative">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>

                                <!-- nova senha-->
                                <input id="password" title="{{ __("Fill this field") }}" type="password" placeholder="{{ __('New password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group focused">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>

                                <!-- confirmar nova senha -->
                                <input id="password-confirm" title="{{ __("Fill this field") }}" placeholder="{{ __('Confirm Password') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                            </div>

                            <a href="#!" class="float-right text-sm"  id="visualizarSenhas">{{ __("Show Passwords") }}</a>
                            <label class="float-right" id="contadorPassword"></label>

                        </div>

                        <br>

                        <div class="text-center">
                            <button type="submit" id="completar_perfil" class="btn btn-primary my-4"> {{ __('Reset Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <a href="{{ route('login') }}" class="text-light" title="{{ __("Click to cancel") }}"><small>{{ __("Cancel") }}</small></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script src="{{asset('js/password/validate.min.js')}}"></script>

@endsection
