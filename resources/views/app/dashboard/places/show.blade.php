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
                
                <div class="text-center text-danger"><h3>{{ __("More details about") }} <u>{{ $place->name }}</u> </h3></div>
                <hr>
                <div class="text-left text-sm">
                    <!-- identificador do local -->
                    <div class="form-group mb-3">
                        <span>{{ __("Identifier number") }}:</span>
                        <strong>{{ $place->id }}</strong>
                    </div>

                    <!-- nome do local -->
                    <div class="form-group mb-3">
                        <span>{{ __("Name") }}:</span>
                        <strong>{{ $place->name }}</strong> 
                    </div>

                    <!-- capacidade do ambiente -->
                    <div class="form-group mb-3">
                        <span>{{ __("Capacity") }}:</span>
                        <strong>{{ $place->capacity }} {{ __("peoples") }}</strong>
                    </div>

                    <!-- tamanho do ambiente -->
                    <div class="form-group mb-3">
                       <span>{{ __("Size") }}:</span>
                       <strong>{{ $place->size }} m<sup>2</sup> </strong>
                   </div>

                   <!--tensao-->
                    <div class="form-group mb-3">
                        <span>{{ __("Outlet voltage") }}:</span>
                        <strong>
                        @if($place->outletVoltage)
                            220v
                        @else
                            127v
                        @endif
                        </strong>
                    </div>

                    @if($place->hasProjector)
                    <!-- qtd projetores -->
                    <div class="form-group mb-3">
                        <span>{{ __("Projectors") }}:</span>
                        <strong>
                            {{ $place->howManyProjectors }}
                        </strong>
                    </div>
                    @endif

                    @if($place->hasTranslationBooth)
                    <!-- qtd projetores -->
                    <div class="form-group mb-3">
                        <span>{{ __("Translation booths") }}:</span>
                        <strong>
                            {{ $place->howManyBooths }}
                        </strong>
                    </div>
                    @endif

                    <!-- qtd projetores -->
                    <div class="form-group mb-3">
                        <span>{{ __("Sound") }}?</span>
                        <strong>
                        @if($place->hasSound)
                            {{ __("Yes") }}
                        @else
                            {{ __("No") }}
                        @endif
                        </strong>
                    </div>
                  
                    <!-- tem iluminação -->
                    <div class="form-group mb-3">
                        <span>{{ __("Scenic lighting") }}?</span>
                        <strong>
                        @if($place->hasLighting)
                           {{ __("Yes") }}
                        @else
                           {{ __("No") }}
                        @endif
                        </strong>
                    </div>

                    <!-- tem wifi -->
                    <div class="form-group mb-3">
                        <span>{{ __("Wifi") }}?</span>
                        <strong>
                        @if($place->hasWifi)
                           {{ __("Yes") }}
                        @else
                           {{ __("No") }}
                        @endif
                        </strong>
                    </div>

                    <!-- tem wifi -->
                    <div class="form-group mb-3">
                        <span>{{ __("Accessibility") }}?</span>
                        <strong>
                        @if($place->hasAccessibility)
                           {{ __("Yes") }}
                        @else
                           {{ __("No") }}
                        @endif
                        </strong>
                    </div>

                    <!-- tem estacionamento gratis -->
                    <div class="form-group mb-3">
                        <span>{{ __("Free parking") }}?</span>
                        <strong>
                        @if($place->hasFreeParking)
                            {{ __("Yes") }}
                        @else
                            {{ __("No") }}
                        @endif
                        </strong>
                    </div>

                     <!-- criado em -->
                     @if ($place->created_at)
                        <div class="form-group mb-3">
                            <span>{{ __("Created at") }}:</span>
                            <strong>{{dateBrazilianFormat($place->created_at)}} {{ __("at") }} {{ timeBrazilianFormat($place->created_at) }}</strong>
                        </div>
                    @endif

                    <!-- editado em -->
                    @if ($place->created_at != $place->updated_at)
                        <div class="form-group mb-3">
                            <span>{{ __("Updated") }}:</span>
                            <strong>{{dateBrazilianFormat($place->updated_at)}} {{ __("at") }} {{ timeBrazilianFormat($place->updated_at) }}</strong>
                        </div>
                    @endif

                    <!--deletado em-->
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