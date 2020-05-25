@extends('layouts.dashboard')

@section('title', 'Ative sua conta')

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-md-12">
                    @if(session('resent'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--text"><i class="ni ni-like-2"></i><strong> {{ __("Success") }}!</strong>{{ __('A fresh verification link has been sent to') }} <strong>{{ auth()->user()->email }}</strong></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                    </div>
                    @endif
                    <!-- alertas -->
                    @component('components.alert')@endcomponent
                    <div class="card">
                        <div class="card-header">{{ __("Please activate your account.") }}</div>
                        <div class="card-body">
                            <span>{{  __("A verification link has been sent to")  }}</span> <strong>{{auth()->user()->email}}</strong>
                            <br>
                            <span>{{ __("If you haven't received any emails, or if the link has expired,") }}</span>
                            <a class="text-primary form-loader" href="{{ route('verification.resend') }}">{{ __('click here to request another') }}.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="espaco"></div>
    <div class="espaco"></div>
    <div class="espaco"></div>
    <div class="espaco"></div>
    <div class="espaco"></div>
    <div class="espaco"></div>
    <div class="espaco"></div>
</div>
@endsection