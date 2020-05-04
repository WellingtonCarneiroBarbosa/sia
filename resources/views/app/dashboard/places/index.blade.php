@extends('layouts.dashboard')

@section('title', Lang::get('Places'))

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Places") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('places.create') }}" class="btn btn-sm btn-neutral mb-2" id="new-place">{{ __("New") }}</a>
                    <a href="#" data-toggle="modal" data-target="#modal-filter" id="filtros-locais" class="btn btn-sm btn-neutral mb-2 mr-2">{{ __("Check availability") }}</a>
                </div>
            </div>
            <!-- fim do header -->
        </div>
    </div>
</div>

<!-- tabela de agendamentos -->

<div class="container-fluid mt--6">
    <!-- conteudo da pagina -->

    @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-inner--text"><i class="ni ni-like-2 mr-2"></i><strong>{{  __("Success") }}!</strong> {{session('status')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    
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


    <!--tabela de agendamentos-->
    <div class="row">
        <!-- inicio da tabela de agendamentos -->
        <div class="col-xl-12">
            <div class="card bg-default">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <!-- inicio cabecalho da tabela -->
                        <div class="col">
                            <h5 class="text-light text-uppercase ls-1 mb-1">{{ __("Place's Table") }}</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-dark table-flush">
                                <thead class="thead-dark">
                                    <tr>
                                        <!-- agendamento 01 -->
                                        <th scope="col" class="sort" data-sort="name">{{ __("Place") }}</th>
                                        <th scope="col" class="sort" data-sort="budget">{{ __("Capacity") }}</th>
                                        <th scope="col" class="sort" data-sort="status">{{ __("Size") }}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{ __("Actions") }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <!-- fim do cabeçalho da tabela -->
                                <tbody class="list">
                                    <!-- inicio corpo da tabela -->
                                    @if ($hasPlaces)
                                    
                                    @foreach($places as $place)
                                    <tr>
                                        <td>
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar avatar-md rounded-circle mr-3">
                                                  <img alt="Image placeholder" src="https://via.placeholder.com/150">
                                                </a>

                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">
                                                        {{ $place->name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">
                                                        {{  str_replace(',', '.', number_format($place->capacity)) }} {{ __("peoples")}}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge badge-dot mr-4">

                                                {{ str_replace(',', '.', number_format($place->size)) }} m<sup>2</sup>

                                            </span>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow align-items-center">
                                                    <a class="dropdown-item" href="{{ route('places.show', ['id' => $place->id]) }}">{{ __("View more") }}</a>
                                                    <a class="dropdown-item" href="{{ route('places.edit', ['id' => $place->id]) }}">{{ __("Edit") }}</a>
                                                    <a class="dropdown-item" href="{{ route('places.confirm.delete', ['id' => $place->id]) }}">{{ __("Delete") }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @else
                                    <!-- se nao houver agendamentos -->

                                    <tr>
                                        <td class="budget">
                                            {{ __("Without Data") }}
                                        </td>
                                       
                                        <td>
                                            <span class="badge badge-dot mr-4">
                                                <span class="status">{{ __("Without Data") }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ __("Without Data") }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="#!">{{ __("No Options Available") }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- fim do agendamento 01 -->
                                    @endif
                                </tbody>
                                <!-- fim do corpo da tabela -->
                                <br>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-right">
                {{ $places->links() }}
            </div>
        </div>
    </div>

    
    <!--modal de busca-->

    <div class="modal-filtros fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-filter" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="espacol"></div>
                <div class="text-center">
                    <h3>{{ __("Check availability") }}</h3>
                </div>
                <div class="modal-body">
                    <!--options-->

                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                    <h3>{{ __("Check by date and place") }}</h3>
                                    <form action="{{route('places.availability')}}" class="form-loader" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="">{{ __("From") }}</label>
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" value="{{ old('start') }}" required name="start" placeholder="dd/mm/aaaa" class="form-control date" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="">{{ __("To") }}</label>
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input title="{{ __("Fill this field") }}" required value="{{ old('end') }}" name="end" class="form-control date" placeholder="dd/mm/aaaa" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="local">{{ __("Place") }}</label>

                                                    <div class="input-group mb-4">

                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-map"></i></span>
                                                        </div>

                                                        @if ($hasPlaces)
                                                        <select name="place_id" id="place_id" class="form-control @error('place_id') is-invalid @enderror" required>
                                                            @foreach ($places as $place)
                                                                <option value="{{$place->id}}" @if(old('place_id') == $place->id) selected @endif>{{$place->name}}</option>
                                                            @endforeach
                                                        </select> 
                                                        @else
                                                        <select name="place_id" id="place_id" disabled class="form-control @error('place_id') is-invalid @enderror" required>
                                                            <option selected>{{ __("Please register a place") }}</option>
                                                        </select>
                                                        @endif 

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="espaco"></div>
                                                <div class="float-right">
                                                    <button title="{{ __("Click to Search") }}" @if (!$hasPlaces) disabled @endif class="btn btn-primary" type="submit">
                                                        {{ __("Consult") }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <!--end options-->


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary  ml-auto" data-dismiss="modal">{{ __("Close") }}</button>
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
            $('.date').mask('00/00/0000');
        });
    })(jQuery);
</script>

@endsection