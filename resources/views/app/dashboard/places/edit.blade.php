@extends('layouts.dashboard')
@section('title', Lang::get('Update Place'))
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Update Place") }}</h6>
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
                <div class="text-center"><h3>{{ __("Update Place") }}</h3></div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Fill in the details below to proceed") }}</small>
                </div>
                <form method="POST" class="form-loader" action="{{ route('places.update', ['id' => $place->id]) }}">
                @csrf
                @method('put')
                <!--nome do local-->
                <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-building"></i></span>
                        </div>

                        <input id="name" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("Place") }}"  class="form-control " value="{{ $place->name }}" name="name" required>
                    
                    </div>
                </div>
                <!--fim do nome do local-->

                <!--lotação-->
                <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-users"></i></span>
                        </div>

                        <input id="capacity" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("Capacity") }}"  class="form-control " value="{{ $place->capacity }}" name="capacity" required>
                    
                    </div>
                </div>
                <!--fim da lotação-->

                <!--espaco em m2-->
                <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-vector-square"></i></span>
                        </div>

                        <input id="size" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("Square meters") }}"  class="form-control " value="{{ $place->size }}" name="size" required>
                        
                    </div>
                </div>
                <!--fim da espaco em m2-->

                <!--projetor-->
                <div class="form-group">
                    <label for="hasProjector"> {{ __("Projectors") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasProjector" name="hasProjector" type="checkbox" @if($place->hasProjector == 1) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>

                <div id="howManyProjectorsDiv" class="form-group">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-building"></i></span>
                        </div>

                        <input id="howManyProjectors" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("How many projectors?") }}"  class="form-control" value="{{ $place->howManyProjectors }}" name="howManyProjectors">
                    
                    </div>
                </div>
                <!--fim do projetor-->

                <!--cabines de tradução-->
                <div class="form-group">
                    <label for="hasTranslationBooth"> {{ __("Translation booths") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasTranslationBooth" name="hasTranslationBooth" type="checkbox" @if($place->hasTranslationBooth == 1) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>

                <div id="howManyBoothsDiv" class="form-group">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-building"></i></span>
                        </div>

                        <input id="howManyBooths" type="text" title="{{ __("Fill this field") }}"  placeholder="{{ __("How many booths?") }}"  value="{{ $place->howManyBooths }}" class="form-control " name="howManyBooths">
                    
                    </div>
                </div>
                <!--fim do cabines de tradução-->

                <!--sonorização-->
                <div class="form-group">
                    <label for="hasSound"> {{ __("Sound") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasSound" name="hasSound" type="checkbox" @if($place->hasSound == 1) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do sonorização-->

                <!--iluminacao-->
                <div class="form-group">
                    <label for="hasLighting"> {{ __("Scenic lighting") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasLighting" name="hasLighting" type="checkbox" @if($place->hasSound == 1) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do iluminacao-->

                <!--wifi-->
                <div class="form-group">
                    <label for="hasWifi"> {{ __("Wifi") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasWifi" name="hasWifi" type="checkbox" @if($place->hasWifi == 1) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do wifi-->

                <!--accessibility-->
                <div class="form-group">
                    <label for="hasAccessibility"> {{ __("Accessibility") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasAccessibility" name="hasAccessibility" type="checkbox" @if($place->hasAccessibility == 1) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do accessibility-->

                <!--estacionamento-->
                <div class="form-group">
                    <label for="hasFreeParking"> {{ __("Free parking") }}?</label>

                    <label class="custom-toggle ml-2 mt-2">
                        <input id="hasFreeParking" name="hasFreeParking" type="checkbox" @if($place->hasFreeParking == 1) checked @else unchecked @endif>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                    </label>
                </div>
                <!--fim do estacionamento-->

                <!-- submit button -->
                    <div class="text-center">
                        <a href="{{ route('places.index') }}">
                            <button type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Cancel") }}</button>
                        </a>
                        <button type="submit" title="{{ __("Click to update this place") }}" class="btn btn-primary my-4">{{ __("Update Place") }}</button>
                    </div>
                <!-- fim do submit button -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
