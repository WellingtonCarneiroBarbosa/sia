@extends('layouts.dashboard')
@section('title', Lang::get('Complete Register'))

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    @component('components.progressBar', ['progress' => '90'])@endcomponent
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Last stage") }}</h6>
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
                <form method="POST" class="form-loader" action="{{ route('complete.profile.storeStageThree') }}">
                @csrf

              
                {{-- User passs --}}
                <div class="form-group">
                    <label for="password">{{ __("Choose your password") }}</label>
                    <x-input icon="fa fa-lock" id="password" name="password" type="password" :required="false" />
                </div>

                <div class="form-group">
                    <label for="confirm-password">{{ __("Confirm your password") }}</label>
                    <x-input icon="fa fa-lock" id="confirm-password" name="password_confirmation" type="password" :required="false" />
                </div>

                <div class="float-right">
                    <a class="btn btn-sm btn-primary" id="showPasswords" href="#">
                        <span class="text-white"><i class="fa fa-eye mr-2"></i> {{ __("Show Passwords") }}</span>
                    </a>
                </div>

                <div class="espaco"></div>
                <div class="espaco"></div>

                <!-- submit button -->
                    <div class="text-center">
                        <a href="{{ route('complete.profile.stageTwo') }}">
                            <button type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Come Back") }}</button>
                        </a>
                        <button type="submit" title="{{ __("Click to complete your register") }}" class="btn btn-primary my-4">{{ __("Complete Register") }}</button>
                    </div>
                <!-- fim do submit button -->
                </form>
            </div>
        </div>
    </div>
</div>
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