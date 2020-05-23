<div class="card bg-default">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <!-- inicio cabecalho da tabela -->
            <div class="col">
                <h5 class="text-light text-uppercase ls-1 mb-1">{{ __("Schedule's List") }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                        <tr>
                            <!-- agendamento 01 -->
                            <th scope="col" class="sort" data-sort="name">{{ __("Place") }}</th>
                            <th scope="col" class="sort" data-sort="budget">{{ __("Start Datetime") }} / {{ __("End Datetime") }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __("Status") }}</th>
                            <th scope="col">{{ __("Customer") }}</th>
                            <th scope="col" class="sort" data-sort="completion">{{ __("Actions") }}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <!-- fim do cabeçalho da tabela -->
                    <tbody class="list">
                        <!-- inicio corpo da tabela -->
                        
                        @foreach($schedules as $schedule)
                        <tr>
                            <td>
                                @if($schedule->schedulingPlace['name'])
                                <div class="media align-items-center">
                                    <a href="#" class="avatar avatar-md rounded-circle mr-3">
                                        <img alt="Image placeholder" src="https://via.placeholder.com/150">
                                    </a>

                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">
                                    {{ $schedule->schedulingPlace['name'] }}
                                        </span>
                                    </div>
                                </div>
                                @else
                                <span class="badge badge-dot mr-4">
                                    <i class="bg-danger"></i>
                                    <span class="status">{{ __("Undefined") }}</span>
                                </span>
                                @endif
                            </td>

                            <td>
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">
                                            {{ dateTimeBrazilianFormat($schedule->start) }} 
                                            |
                                            {{ dateTimeBrazilianFormat($schedule->end) }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge badge-dot mr-4">

                                    @if($now > $schedule->start && $now < $schedule->end)
                                        <i class="bg-success"></i>
                                        <span class="status">{{ __("In progress") }}</span>
                                    @elseif($now > $schedule->start && $now >= $schedule->end)
                                        <i class="bg-danger"></i>
                                        <span class="status">{{ __("Finalized") }}</span>
                                    @elseif(!$schedule->place_id)
                                        <i class="bg-danger"></i>
                                        <span class="status">{{ __("Expired") }}</span>
                                    @elseif($schedule->deleted_at != null)
                                        <i class="bg-danger"></i>
                                        <span class="status">{{ __("canceled") }}</span>
                                    @elseif (!$schedule->status)
                                        <i class="bg-warning"></i>
                                        <span class="status">{{ __("On budget") }}</span>
                                    @elseif($schedule->status)
                                        <i class="bg-success"></i>
                                        <span class="status">{{ __("Confirmed") }}</span>
                                    @endif
                                    
                                </span>
                            </td>

                            <td>
                                @if($schedule->customer)
                                <div class="media align-items-center">
                                    <a href="#" class="avatar avatar-sm rounded-circle mr-3">
                                        <img alt="Image placeholder" src="https://via.placeholder.com/150">
                                    </a>

                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">{{ $schedule->schedulingCustomer['corporation'] }}</span>
                                    </div>
                                </div>
                                @else 
                                <span class="badge badge-dot mr-4">
                                    <i class="bg-danger"></i>
                                    <span class="status">{{ __("Undefined") }}</span>
                                </span>
                                @endif
                            </td>

                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow align-items-center">
                                        <a class="dropdown-item" href="{{ route('schedules.show', ['id' => $schedule->id]) }}">{{ __("View more") }}</a>
                                        @if($now <= $schedule->start || $now <= $schedule->end && $schedule->place_id && $now <= $schedule->start &&  $now >= $schedule->end)
                                        <a class="dropdown-item" href="{{ route('schedules.edit', ['id' => $schedule->id]) }}">{{ __("Edit") }}</a>
                                        <a class="dropdown-item" href="{{ route('schedules.confirm.cancel', ['id' => $schedule->id]) }}">{{ __("Cancel") }}</a>
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
    @if(isset($data))
        {{ $schedules->appends($data)->links() }}
    @else
        {{ $schedules->links() }}
    @endif
</div>