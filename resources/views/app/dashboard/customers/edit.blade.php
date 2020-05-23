@extends('layouts.dashboard')
@section('title', Lang::get('Edit Customer'))
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Edit Customer") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a onclick="comeBack()" class="btn btn-sm btn-neutral">{{ __("Come Back") }}</a>
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
                <div class="text-center"><h3>{{ __("Edit Customer") }}</h3></div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Fill in the details below to proceed") }}</small>
                </div>
                <form method="POST" class="form-loader" action="{{ route('customers.update', ['id' => $customer->id]) }}">
                @csrf
                @method('PUT')
                <!--nome da empresa-->
                <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-building"></i></span>
                        </div>

                        <input id="corporation" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("Corporation") }}"  class="form-control " name="corporation" value="{{ $customer->corporation }}" required>
                    
                    </div>
                </div>
                <!--fim do nome da empresa-->

                <!-- submit button -->
                    <div class="text-center">
                        <button type="submit" title="{{ __("Click to edit this costumer") }}" class="btn btn-primary my-4">{{ __("Edit Customer") }}</button>
                    </div>
                <!-- fim do submit button -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
