@extends('layouts.dashboard')
@section('title', 'Cadastrar Local')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Register Place") }}</h6>
                </div>
            </div>
            <!-- fim do header -->
            </div>
        </div>

        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--text"><i class="ni ni-like-2"></i><strong>{{  __("Success") }}!</strong> {{session('status')}}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
        </div>
        @endif @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-inner--text"><i class="fas fa-thumbs-down"></i><strong> {{ __("Opps") }}...</strong>
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
        @endif @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-inner--text"><i class="fas fa-thumbs-down"></i><strong> {{ __("Opps") }}...</strong>{{session('error')}}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
        </div>
        @endif

        <!-- animacao de entrada -->
        <div class="row justify-content-center fadeInTransition" >
            <div class="card col-6 bg-secondary shadow border-0">
                <div class="card-body px-lg-10 py-lg-10">
                <div class="text-center"><h3>{{ __("Register Place") }}</h3></div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Fill in the details below to proceed") }}</small>
                </div>
                <form method="POST" class="form-loader" action="{{ route('places.store') }}">
                @csrf

                <!--nome da empresa-->
                <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-building"></i></span>
                        </div>

                        <input id="name" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("Place") }}"  class="form-control " name="name" required>
                    
                    </div>
                </div>
                <!--fim do nome da empresa-->

                <!-- submit button -->
                    <div class="text-center">
                        <button type="submit" title="{{ __("Click to register this place") }}" class="btn btn-primary my-4">{{ __("Register Place") }}</button>
                    </div>
                <!-- fim do submit button -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
