@extends('layouts.dashboard')

@section('title', Lang::get('View Place'))

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("View Place") }}</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="#" onclick="comeBack();" class="btn btn-sm btn-neutral">{{ __("Come Back") }}</a>
                </div>
            </div>
        <!-- fim do header -->
        </div>
    </div>

        <!-- animacao de entrada -->
        <div class="row justify-content-center fadeInTransition" >
            <div class="card col-6 bg-secondary shadow border-0">
                <div class="card-body px-lg-10 text-center py-lg-10">
    
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-inner--text"><i class="fas fa-thumbs-down mr-2"></i><strong> {{ __("Opps") }}...</strong>
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
                
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-inner--text"><i class="fas fa-thumbs-down mr-2"></i><strong> {{ __("Opps") }}...</strong>{{session('error')}}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                
                <div class="text-center text-danger"><h3>{{ __("More details about the place") }}</h3></div>
                <hr>
                <div class="text-left text-sm">
                    <!-- identificador do agendamento -->
                    <div class="form-group mb-3">
                        <span>{{ __("Identifier number") }}:</span>
                        <strong>{{ $place->id }}</strong>
                    </div>

                    <!-- titulo do agendamento -->
                    <div class="form-group mb-3">
                        <span>{{ __("Name") }}:</span>
                        <strong>{{ $place->name }}</strong> 
                    </div>

                    <!-- local do agendamento -->
                    <div class="form-group mb-3">
                        <span>{{ __("Capacity") }}:</span>
                        <strong>{{ $place->capacity }} {{ __("peoples") }}</strong>
                    </div>

                    <!-- datahora inicio -->
                    <div class="form-group mb-3">
                       <span>{{ __("Size") }}:</span>
                       <strong>{{ $place->size }} m<sup>2</sup> </strong>
                   </div>

                    <!-- datahora final -->
                    <div class="form-group mb-3">
                        <span>{{ __("End") }}:</span>
                        <strong></strong>
                    </div>

                    <!-- cliente -->
                    <div class="form-group mb-3">
                        <span>{{ __("Customer") }}:</span>
                        <strong></strong>
                    </div>

                    <!-- status -->
                    <div class="form-group mb-3">
                        <span>{{ __("Status") }}:</span>


                    </div>

                    <!-- detalhes -->
                    <div class="form-group mb-3">
                        <span>{{ __("Details") }}:</span>
     
                    </div>

                    <!-- agendado em - por -->
                    <div class="form-group mb-3">
                        <span>{{ __("Scheduled on") }}:</span>
                        <strong></strong>
                    </div>



                    <!-- editado em -->
                    @if ($place->created_at != $place->updated_at)
                        <div class="form-group mb-3">
                            <span>{{ __("Updated") }}:</span>
                            <strong>{{dateBrazilianFormat($place->updated_at)}} {{ __("at") }} {{ timeBrazilianFormat($place->updated_at) }}</strong>
                        </div>
                    @endif

                    <!--cancelado em-->
                    @if ($place->deleted_at)
                    <div class="form-group mb-3">
                        <span>{{ __("Deleted at") }}:</span>
                        <strong>{{dateBrazilianFormat($place->deleted_at)}} {{ __("at") }} {{ timeBrazilianFormat($place->deleted_at) }}</strong>
                    </div>
                    @endif 
                </div>

                <button type="button" onclick="comeBack();" class="btn btn-primary">{{ __("Okay") }}</button>
            </div>
        </div>
    </div>
</div>

@endsection