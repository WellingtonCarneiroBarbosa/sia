<div class="card bg-default">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <!-- inicio cabecalho da tabela -->
            <div class="col">
                <h5 class="text-light text-uppercase ls-1 mb-1">{{ __("Places List") }}</h5>
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
                        @foreach($places as $place)
                        <tr>
                            <td>
                                <div class="media align-items-center">

                                   <i class="avatar avatar-md rounded-circle mr-3 popover-primary fa fa-building"></i>

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
                                        @if(auth()->user()->role_id >= 5)
                                        <a class="dropdown-item" href="{{ route('places.edit', ['id' => $place->id]) }}">{{ __("Edit") }}</a>
                                        <a class="dropdown-item" href="{{ route('places.confirm.delete', ['id' => $place->id]) }}">{{ __("Delete") }}</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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
