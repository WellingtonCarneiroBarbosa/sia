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
                <div class="text-center"><h3>{{ __("Register Customer") }}</h3></div>
                <div class="text-center text-muted mb-4">
                    <small>{{ __("Fill in the details below to proceed") }}</small>
                </div>
                <form method="POST" class="form-loader" action="{{ route('customers.update', [$customer->id]) }}">
                    @csrf
                    @method('PUT')

                    {{-- Representante --}}
                    <label for="representative">{{ __("Trade Representative") }}:</label>
                    <x-input id="representative" icon="fa fa-user" name="name" :value="$customer->name" :required="true" />

                    {{-- Nome da Empresa --}}
                    <label for="corporation">{{ __("Enterprise") }}:</label>
                    <x-input id="corporation" icon="ni ni-building" name="corporation" :value="$customer->corporation" :required="true" />
                
                    {{-- CNPJ --}}
                    <label for="cnpj">{{ __('CNPJ') }}:</label>
                    <x-input icon="ni ni-badge" id="cnpj" name="cnpj" :value="mask('##.###.###\####-##', $customer->cnpj)" :required="true"/>

                    {{-- Phone --}}
                    <label for="phone">{{ __("Phone") }}:</label>
                    @if(strlen($customer->phone) == 10)
                    @php
                        $phone = mask("(##) ####-####", $customer->phone) 
                    @endphp
                    @else 
                    @php
                        $phone = mask("(##) # ####-####", $customer->phone) 
                    @endphp
                    @endif
                    <x-input id="phone" icon="fa fa-phone" name="phone" :value="$phone" :required="true" />

                    {{-- Email --}}
                    <label for="email">{{ __("Email") }}:</label>
                    <x-input icon="ni ni-email-83" id="email" name="email" type="email" :value="$customer->email" :required="true"/>

                    <div class="text-center">
                        <button type="submit" title="{{ __("Click to register this costumer") }}" class="btn btn-primary my-4">{{ __("Register Customer") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
    <script src="{{ asset('js/plugins/maskNumber/dist/jquery.masknumber.min.js') }}"></script>
    <script>
        /**
        * Masks
        * 
        */
        (function( $ ) {
            $(function() {
                $('#cnpj').mask('00.000.000/0000-00');
                
                    var SPMaskBehavior = function (val) {
                      return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
                    },
                    spOptions = {
                      onKeyPress: function(val, e, field, options) {
                          field.mask(SPMaskBehavior.apply({}, arguments), options);
                        }
                    };
                  
                    $('#phone').mask(SPMaskBehavior, spOptions);
                 
            });
        })(jQuery);
    </script>
@endsection
