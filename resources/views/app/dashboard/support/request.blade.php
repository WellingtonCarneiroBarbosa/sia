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
                <form method="POST" action="#" id="openTicket">
                    {{-- Categoria --}}

                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">

                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-02 mr-2"></i>{{ __("Categorie") }}</span>
                            </div>

                            <select id="demands"> class="form-control" required>
                                <option>{{ __("Loading categories") }}...</option>
                            </select>
                            
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                            </div>
                            <textarea title="{{ __("Fill this field") }}" id="details" required>{{ __("Details") }}</textarea> 
                        </div>
                    </div>
                
                    <div class="text-center">
                        <button onclick="comeBack();" type="button" class="btn btn-outline-primary  ml-auto" >{{ __("Cancel") }}</button>
                        <button type="submit" title="{{ __("Click to register this user") }}" class="btn btn-primary my-4">{{ __("Request Support") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {{-- Get Demands From API --}}
    <script>
        $(document).ready(function (){
            $url = "{{ config('app.support_api') }}";
            $endpoint = $url + "/demands";
            $loader = $("#pageloader");

            function reloadIfStatusCodeIsNotExpected(data, expected) {
                if(data != expected) {
                    alert("{{ __("Something went wrong. Please refresh the page!") }}");
                    location.reload();
                    return;
                }
            }

            $.ajax({
                url: $endpoint,

                beforeSend: function () {
                    $loader.show();
                },

                success: function (response) {
                    reloadIfStatusCodeIsNotExpected(response.code, 200);

                    var categoriesSelectBox = $("#demands");
                    categoriesSelectBox.find('option').remove();
                    $.each(response.data, function (i, d) {
                        $('<option>').val(d.id).text(d.demand).appendTo(categoriesSelectBox);
                    });

                    $loader.hide();
                },

                error: function () {
                    reloadIfStatusCodeIsNotExpected(response.code, 200);
                }
            });
        });
    </script>

    {{-- Send Ticket Request --}}
    <script>
        $(document).ready(function (){
            $("#openTicket").submit(function (e){
                e.preventDefault();

                $url = "{{ config('app.support_api') }}";
                $endpoint = $url + "/tickets";
                $loader = $("#pageloader");

                $user_name = "{{ ucFirstNames(Auth()->user()->name) }}";
                $user_system = "{{ config('app.name') }}";
                $description = $("#details").val();
                $demand = $("#demands").val();

                function reloadIfStatusCodeIsNotExpected(data, expected) {
                    if(data != expected) {
                        alert("{{ __("Something went wrong. Please refresh the page!") }}");
                        location.reload();
                        return;
                    }
                }

                $.ajax({
                    url: $endpoint,
                    data:{user_name: $user_name, user_system: $user_system, description: $description, demand_id: $demand},
                    method: "POST",

                    beforeSend: function () {
                        $loader.show();
                    },

                    success: function (response) {
                        if(response.code != 201) {
                            alert('algo deu errado');
                            console.log(response)
                            return;
                        }
                         
                        console.log(response);
                        alert('Ticket aberto com sucesso!');
                        $loader.hide();
                    },

                    error: function () {
                        alert('algo deu errado!');
                    }
                })


            
            });
        });
    </script>

    {{-- 
         $.ajax(
                url: $url,
                data: 
            );
            'user_name', 'user_system', 'description',
            'responsible_id', 'demand_id'
             --}}
@endsection