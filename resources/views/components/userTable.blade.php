<div class="card bg-default">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <!-- inicio cabecalho da tabela -->
            <div class="col">
                <h5 class="text-light text-uppercase ls-1 mb-1">{{ __("Users List") }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                        <tr>
                            <!-- agendamento 01 -->
                            <th scope="col" class="sort" data-sort="name">{{ __("Name") }}</th>
                            <th scope="col" class="sort" data-sort="budget">{{ __("Email") }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __("Status") }}</th>
                            <th scope="col" class="sort" data-sort="completion">{{ __("Actions") }}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <!-- fim do cabeçalho da tabela -->
                    <tbody class="list">
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <a href="#" class="avatar avatar-md rounded-circle mr-3">
                                        <img alt="Image User" src="https://via.placeholder.com/150">
                                    </a>

                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">
                                            {{ ucFirstNames($user->name) }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">
                                            {{ $user->email }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge badge-dot mr-4">
                                    @if($user->deleted_at)
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-danger"></i>
                                        <span class="status">{{ ucfirst(__("disabled") )}}</span>
                                    </span>
                                    @else 
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-success"></i>
                                        <span class="status">{{ ucfirst(__("activated")) }}</span>
                                    </span>
                                    @endif
                                </span>
                            </td>

                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow align-items-center">
                                        <a class="dropdown-item" href="{{ route('users.show', ['id' => $user->id]) }}">{{ __("View more") }}</a>
                                        @if(auth()->user()->role_id == 5)
                                            <a class="dropdown-item" href="{{ route('logs.user', ['id' => $user->id]) }}">{{ __("Show Activity") }}</a>
                                            <a class="dropdown-item" href="{{ route('users.edit', ['id' => $user->id]) }}">{{ __("Edit") }}</a>
                                            @if($user->deleted_at)
                                            <a class="dropdown-item" href="{{ route('users.confirmRestore', ['id' => $user->id]) }}">{{ __("Activate") }}</a>
                                            @else 
                                            <a class="dropdown-item" href="{{ route('users.confirmDestroy', ['id' => $user->id]) }}">{{ __("Disable") }}</a>
                                            @endif
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
    {{ $users->links() }}
</div>
