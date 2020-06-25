@extends('layouts.dashboard')

@section('title', Lang::get('Request Support'))

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Request Support") }}</h6>
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
                <div class="text-center"><h3>{{ __("Request Support") }}</h3></div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Fill in the details below to proceed") }}</small>
                </div>
                <form method="POST" action="{{ route('support.send.request') }}">
                    {{-- Categoria --}}

                    @csrf 
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">

                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-02 mr-2"></i>{{ __("Categorie") }}</span>
                            </div>

                            <select name="demand_id" class="form-control" required>
                                @foreach($demands as $demand)
                                <option value="{{ $demand['id'] }}">{{ $demand['demand'] }}</option>
                                @endforeach
                            </select>
                        
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                            </div>
                            <textarea title="{{ __("Fill this field") }}" name="message" required>{{ __("Details") }}</textarea> 
                        </div>
                    </div>
                
                    <div class="text-center">
                        <button onclick="comeBack();" type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Cancel") }}</button>
                        <button type="submit" class="btn btn-primary my-4">{{ __("Request Support") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection