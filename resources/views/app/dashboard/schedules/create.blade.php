@extends('layouts.dashboard')

@section('title', 'Cadastrar Agendamento')

@section('content')

<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Schedule Event") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a onclick="comeBack()" class="btn btn-sm btn-neutral">{{ __("Come Back") }}</a>
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
    @endif
    
    @if ($errors->any())
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
    @endif
    
    @if(session('error'))
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
                    <div class="text-center">
                        <h3>{{ __("Schedule Event") }}</h3>
                    </div>
                    <div class="text-center text-muted mb-4">
                        <small>{{ __("Fill in the details below to proceed") }}</small>
                    </div>
                    <form method="POST" action="{{ route('schedules.store') }}" class="form-loader">
                        @csrf
                        <!-- titulo do agendamento -->
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                </div>
                                <input id="title" title="{{ __("Fill this field") }}"  placeholder="{{ __("Schedule title") }}" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus> 
                            </div>
                        </div>
                        <!-- fim do titulo do agendamento -->

                        <!-- local do agendamento -->
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-sm"><i class="fa fa-map mr-2"></i>{{ __("Place") }}</span>
                                </div>
                                @if ($hasPlaces)
                                <select name="place_id" id="place_id" class="form-control @error('place_id') is-invalid @enderror" required>
                                    @foreach ($places as $place)
                                        <option value="{{$place->id}}">{{$place->name}}</option>
                                    @endforeach
                                </select> 
                                @else
                                <select name="place_id" id="place_id" disabled class="form-control @error('place_id') is-invalid @enderror" required>
                                    <option selected>{{ __("Please register a place") }}</option>
                                </select>
                                @endif 

                            </div>
                        </div>
                        <!-- fim local do agendamento -->

                        <!-- data inicial do agendamento -->
                        <div class="form-group focused">
                            <label for="start">{{ __("Start Datetime") }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input title="{{ __("Fill this field") }}" placeholder="dd/mm/aaaa hh:mm"  id="start" type="text" class="form-control datetime" name="start" required> 


                            </div>
                        </div>
                        <!-- fim da data inicial do agendamento -->

                        <!-- data final do agendamento -->
                        <div class="form-group focused">
                            <label for="end">{{ __("End Datetime") }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input title="{{ __("Fill this field") }}" placeholder="dd/mm/aaaa hh:mm" id="end" type="text" class="form-control datetime" name="end" required> 
                            </div>
                        </div>
                        <!-- fim da data final do agendamento -->

                        <!-- cliente do agendamento -->
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02 mr-2"></i>{{ __("Customer") }}</span>
                                </div>

                                @if ($hasCustomers)
                                <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                    @foreach ($customers as $customer)
                                      <option value="{{$customer->id}}">{{$customer->corporation}}</option>
                                    @endforeach
                                  </select>
                                @else
                                <select name="customer_id" id="customer_id" disabled class="form-control @error('customer_id') is-invalid @enderror" required>
                                    <option selected>{{ __("Please register a customer") }}</option>
                                </select> 
                                @endif 
                                
                            </div>
                        </div>
                        <!-- fim do cliente do agendamento -->

                        <!-- detalhes do agendamento -->
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                </div>
                                <textarea title="{{ __("Fill this field") }}"  id="details" placeholder="{{ __("Scheduling Details") }}" class="form-control @error('details') is-invalid @enderror" name="details" value="{{ old('details') }}"></textarea> 
                            </div>
                        </div>
                        <!-- fim do details do agendamento -->

                        <!-- em orçamento -->

                        <label for="status">{{ __("On budget") }}</label>
    
                        <label class="custom-toggle ml-2">
                            <input name="status" id="status" type="checkbox">
                            <span class="custom-toggle-slider rounded-circle" data-label-off="{{ __("No") }}" data-label-on="{{ __("Yes") }}"></span>
                        </label>
                     
                        <!-- fim em orçamento -->

                        <!-- submit button -->
                        <div class="text-center">
                            <button onclick="comeBack();" type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Cancel") }}</button>
                            @if($hasPlaces && $hasCustomers)
                            <button type="submit" id="agendar-submit" class="btn btn-primary my-4">{{ __("Schedule") }}</button> 
                            @else
                            <button type="submit" class="btn btn-primary my-4" disabled>{{ __("Schedule") }}</button>
                            @endif
                        </div>
                        <!-- fim do submit button -->
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>

<script>
    (function( $ ) {
        $(function() {
            $('.datetime').mask('00/00/0000 00:00');
        });
    })(jQuery);
</script>

@endsection