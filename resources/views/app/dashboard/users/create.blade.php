@extends('layouts.dashboard')
@section('title', Lang::get('Register User'))
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Register User") }}</h6>
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
                <div class="text-center"><h3>{{ __("Register User") }}</h3></div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Fill in the details below to proceed") }}</small>
                </div>
                <form method="POST" class="form-loader" action="{{ route('users.store') }}">
                @csrf

                {{--  nome do usuario --}}
                <x-input icon="ni ni-single-02" id="name" name="name" :value="old('name')" :placeholder="__('User Full Name')" :required="true"/>

                {{--  email do usuario --}}
                <x-input icon="ni ni-email-83" id="email" name="email" type="email" :value="old('email')" :placeholder="__('User Corporative Email')" :required="true"/>

                {{-- tipo do usuário --}}
                <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text text-sm"><i class="ni ni-badge mr-2"></i>{{ __("Type") }}</span>
                        </div>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="3">{{ __("User") }}</option>
                            <option value="5">{{ __("Administrator") }}</option>
                            <option value="7">{{ __("Support") }}</option>
                        </select>
                    </div>
                </div>
                <!--fim do tipo do usuário-->

                <!-- submit button -->
                    <div class="text-center">
                        <button onclick="comeBack();" type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Cancel") }}</button>
                        <button type="submit" title="{{ __("Click to register this user") }}" class="btn btn-primary my-4">{{ __("Register User") }}</button>
                    </div>
                <!-- fim do submit button -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

