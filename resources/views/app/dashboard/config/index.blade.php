@extends('layouts.dashboard')

@section('title', Lang::get('System Configurations'))

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-12">
                    @component('components.alert')@endcomponent
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Settings") }}</h6>
                    <div class="espaco"></div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">{{ __("Language") }}</div>
                                <div class="card-body">
                                    <h4>{{ __("Select a language") }}</h4>
                                    <center>
                                        <a href="{{ route('config.language', ['pt-BR']) }}">
                                            <button title="{{ __('Click here to change the language') }}" class="btn btn-primary">Português</button>
                                        </a>
                                        
                                        <a href="{{ route('config.language', ['en']) }}">
                                            <button title="{{ __('Click here to change the language') }}" class="btn btn-primary">English</button> 
                                        </a>
                                         
                                    </center>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">{{ __("Email") }}</div>
                                <div class="card-body">
                                    <form class="form-loader" action="{{ route('config.email.notification') }}" method="GET">
                                        <div class="form-group">
                                            <label for="email-notification"> {{ __("Email notifications") }}</label>
                        
                                            <label class="custom-toggle ml-2 mt-2">
                                                <input id="email-notification" name="dont_email_notification" type="checkbox"  @if(! auth()->user()->dont_email_notification) checked @endif>
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                                            </label>

                                            <button type="submit" id="email-notification-submit" class="d-none btn btn-primary">{{ __("Save") }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="espaco"></div>
    <div class="espaco"></div>
    <div class="espaco"></div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#email-notification").change(function () {
                $("#email-notification-submit").removeClass('d-none').addClass('d-block');
            })
        });
    </script>
@endsection