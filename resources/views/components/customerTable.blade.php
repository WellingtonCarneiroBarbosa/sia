<div class="card bg-default">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <!-- inicio cabecalho da tabela -->
            <div class="col">
                <h5 class="text-light text-uppercase ls-1 mb-1">{{ __("Customers List") }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                        <tr>
                            <!-- agendamento 01 -->
                            <th scope="col" class="sort" data-sort="name">{{ __("Enterprise") }}</th>
                            <th scope="col" class="sort" data-sort="trade">{{ __("Trade Representative") }}</th>
                            <th scope="col" class="sort" data-sort="phone">{{ __("Phone") }}</th>
                            <th scope="col" class="sort" data-sort="completion">{{ __("Actions") }}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <!-- fim do cabeçalho da tabela -->
                    <tbody class="list">
                        @foreach($customers as $customer)
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <i class="avatar avatar-md rounded-circle mr-3 popover-primary fa fa-building"></i>

                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">
                                            {{ $customer->corporation }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="media align-items-center">
                                    <i class="avatar avatar-sm rounded-circle mr-3 popover-primary fa fa-user"></i>

                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">
                                            {{ $customer->name }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="phone">
                                @if(strlen($customer->phone) == 10)
                                {{ mask("(##) ####-####", $customer->phone) }}
                                @else 
                                {{ mask("(##) # ####-####", $customer->phone) }}
                                @endif
                                
                            </td>

                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow align-items-center">
                                        <a class="dropdown-item" href="{{ route('customers.show', ['id' => $customer->id]) }}">{{ __("View more") }}</a>
                                        <a class="dropdown-item" href="{{ route('customers.edit', ['id' => $customer->id]) }}">{{ __("Edit") }}</a>
                                        <a class="dropdown-item" href="{{ route('customers.confirm.delete', ['id' => $customer->id]) }}">{{ __("Delete") }}</a>
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
{{-- Table's List --}}
<div class="float-right">

    @if(isset($dataAppends))
    {{ $customers->appends($dataAppends)->links() }}
    @else 
    {{ $customers->links() }}
    @endif
    
</div>


