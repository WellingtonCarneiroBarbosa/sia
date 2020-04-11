@extends('layouts.home') @section('title', 'Recuperar Senha') @section('content')
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
                            <span class="alert-inner--text"><i class="fas fa-thumbs-down"></i><strong> Ops...</strong>
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

                        <div class="text-center">
                            <h3>{{ __('Reset Password') }}</h3>
                        </div>
                        <div class="text-center text-muted mb-4">
                            <small>{{ __("Fill in the details below to proceed") }}</small>
                        </div>
                        <form method="POST" action="{{ route('password.email') }}" id="form">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input id="email" title="{{ __(" Fill this field ") }}" placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control @error('email') form-control-alternative is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                                        autofocus>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" title="{{ __(" Click to receive the password reset link ") }}" class="btn btn-primary my-4">{{ __('Send Password Reset Link') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <a href="{{ route('login') }}" class="text-light" title="{{ __(" Click to cancel ") }}"><small>{{ __("Cancel") }}</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection