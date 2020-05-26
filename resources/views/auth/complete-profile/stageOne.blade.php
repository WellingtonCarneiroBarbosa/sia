@extends('layouts.dashboard')
@section('title', Lang::get('Complete Register'))
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    @component('components.progressBar', ['progress' => '30'])@endcomponent
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Stage 1") }}</h6>
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
                <form method="POST" class="form-loader" action="{{ route('complete.profile.storeStageOne') }}">
                @csrf

                {{--  cpf do usuario --}}
                <label for="cpf">{{ __('What is your CPF?') }}</label>
                <x-input icon="ni ni-badge" id="cpf" name="cpf" :value="auth()->user()->cpf ?: old('cpf')" :required="false"/>

                {{--  cep do usuario --}}
                <label for="cep">{{ __("And your CEP?") }}</label>
                <x-input icon="ni ni-map-big" id="cep" name="cep" :value="auth()->user()->cep ?: old('cep')" :required="false"/>

                
                <!-- submit button -->
                    <div class="text-center">
                        <button type="submit" title="{{ __("Click to go to stage 2") }}" class="btn btn-primary my-4">{{ __("Go to stage 2") }}</button>
                    </div>
                <!-- fim do submit button -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

