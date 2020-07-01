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
            <div class="col-lg-6">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">

                        <!-- alertas -->
                        @component('components.alert')@endcomponent

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
                                <input id="confirm-password" title="{{ __("Fill this field") }}" placeholder="{{ __('Confirm Password') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                            </div>

                                        
                            <div class="float-right">
                                <div class="mb-2"></div>
                                <a class="btn btn-sm btn-primary" id="showPasswords" href="#">
                                    <span class="text-white"><i class="fa fa-eye mr-2"></i> {{ __("Show Passwords") }}</span>
                                </a>
                            </div>

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

@endsection


@section('scripts')
<script>
    $(document).ready(function (){
        $password = $("#password");
        $confirmPassword = $("#confirm-password");

        $showPasswords = $("#showPasswords");

        $showPasswords.click(function (){
            $type = $password.attr('type');

            if($type == "password"){
                $password.attr('type', 'text');
                $confirmPassword.attr('type', 'text');
            }else{
                $password.attr('type', 'password');
                $confirmPassword.attr('type', 'password');
            }
        });
    });
</script>
@endsection