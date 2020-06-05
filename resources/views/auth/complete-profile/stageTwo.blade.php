@extends('layouts.dashboard')
@section('title', Lang::get('Complete Register'))

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    @component('components.progressBar', ['progress' => '60'])@endcomponent
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Stage 2") }}</h6>
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
                    <small>{{ __("Choose your profile image") }}</small>
                </div>
                <form method="POST" class="form-loader" action="{{ route('complete.profile.storeStageTwo') }}" enctype="multipart/form-data">
                @csrf

                {{-- Image input --}}
                <div class="form-group">
                    <x-input icon="fa fa-image" id="profile_image" name="profile_image" type="file" :required="false" />
                    <div class="float-right">
                        <a class="btn btn-sm btn-primary" href="{{ route('complete.profile.stageThree') }}">
                            <span class="text-white">Pular etapa</span>
                        </a>
                    </div>
                </div>


                <div class="espaco"></div>

                <!-- submit button -->
                    <div class="text-center">
                        <a href="{{ route('complete.profile.stageOne') }}">
                            <button type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Come Back") }}</button>
                        </a>
                        <button type="submit" title="{{ __("Click to go to last stage") }}" class="btn btn-primary my-4">{{ __("Go to last stage") }}</button>
                    </div>
                <!-- fim do submit button -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
