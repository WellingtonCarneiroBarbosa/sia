@extends('layouts.home') @section('title', 'Login') @section('content')
<!-- background -->
<section class="section section-shaped section-lg">
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
    <div class="container pt-lg-7">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <!-- alertas -->
                        @component('components.alert')@endcomponent
                        <div class="text-center">
                            <h3>{{ __('Login') }}</h3>
                        </div>
                        <div class="text-center text-muted mb-4">
                            <small>{{ __("Fill in the details below to proceed") }}</small>
                        </div>
                        <form class="form-loader" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input id="email" title="{{ __("Fill this field") }}" placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>
                            <div class="form-group focused">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input id="password" title="{{ __("Fill this field") }}" placeholder="{{ __('Password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id="customCheckLogin" name="remember" type="checkbox" {{ old( 'remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" title="{{ __("Click to stay connected to the system") }}" for="customCheckLogin"><span>{{ __('Remember Me') }}</span></label>
                            </div>
                            <div class="text-center">
                                <button type="submit" title="{{ __("Click to login") }}" class="btn btn-primary my-4">{{ __('Login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <a href="{{ route('password.request') }}" title="{{ __("Click to recover your password") }}" class="text-light"><small>{{ __('Forgot Your Password?') }}</small></a>
                    </div>
                </div>
            </div>
</section>

@endsection