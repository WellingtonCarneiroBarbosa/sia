<!DOCTYPE html>
<html>
    <head>
        <title>{{ __("User Activity Report") }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

        {{-- Font CSS --}}
        <style>
            html {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Relatório gerado automaticamente em {{ dateTimeBrazilianFormat(now()) }}</h3>

                {{-- User Informations --}}
                <div class="card">
                    <div class="card-header">
                        Informações do Usuário
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Nome: <b>{{ $user->name }}</b></li>
                            <li>E-mail: <b>{{ $user->email }}</b></li>
                            <li>Status:
                                <b>
                                @if ($user->deleted_at)
                                    Desativado
                                @else
                                    Ativado
                                @endif
                                </b>
                            </li>
                            <li>Tipo: 
                            <b>
                                @if($user->role_id == 3)
                                    Usuário Comum
                                @else
                                    Administrador Geral
                                @endif
                            </b>
                            </li>
                            <li>E-mail verificado:
                                <b>
                                @if (! $user->email_verified_at)
                                    Não
                                @else
                                    Sim
                                @endif
                                </b>
                            </li>
                            <li>Conta completada:
                                <b>
                                @if (! $user->profile_completed_at)
                                    Não
                                @else
                                    Sim
                                @endif
                                </b>
                            </li>
                            <li>Cadastrado em: <b>{{ dateTimeBrazilianFormat($user->created_at) }}</b></li>
                            @if($user->created_at != $user->updated_at)
                            <li>Última edição no perfil em: <b>{{ dateTimeBrazilianFormat($user->updated_at) }}</b></li>
                            @endif
                            @if($user->deleted_at)
                            <li>Desativado em: <b>{{ dateTimeBrazilianFormat($user->deleted_at) }}</b></li>
                            @endif
                        </ul>
                    </div>
                </div>

                {{-- Schedule Logs --}}
                <div class="card">
                    <div class="card-header">Agendamentos</div>
                    <div class="card-body">
                        <ul>
                            @forelse($logs['schedule_logs'] as $log)
                                <li>{{ ucfirst($log['action']) }} um agendamento em {{ dateTimeBrazilianFormat($log['created_at']) }}
                                -
                                @if(isset($log->schedule_id) && isset($log->schedule_log['id']))
                                    <a href="{{ route('schedules.show', ['id' => $log->schedule_id]) }}">{{ __("View Schedule") }}</a>
                                @elseif(isset($log->schedule_id))
                                    <a href="{{ route('schedules.historic.show', ['id' => $log->schedule_id]) }}">{{ __("View Schedule") }}</a>
                                @else
                                    <i>{{ __("Preview not available") }}</i>
                                @endif
                                </li>
                            @empty
                                <li>Nenhuma atividade encontrada.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                {{-- Place Logs --}}
                <div class="card" id="logs1">
                    <div class="card-header">Locais</div>
                    <div class="card-body">
                        <ul>
                            @forelse($logs['place_logs'] as $log)
                                <li>{{ ucfirst($log['action']) }} um local em {{ dateTimeBrazilianFormat($log['created_at']) }}
                                -
                                @if(isset($log->place_id))
                                    <a href="{{ route('places.show', ['id' => $log->place_id]) }}">{{ __("View Place") }}</a>
                                @else
                                    <i>{{ __("Preview not available") }}</i>
                                @endif
                                </li>
                            @empty
                                <li>Nenhuma atividade encontrada.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                
                {{-- Customer Logs --}}
                <div class="card">
                    <div class="card-header">Clientes</div>
                    <div class="card-body">
                        <ul>
                            @forelse($logs['customer_logs'] as $log)
                                <li>{{ ucfirst($log['action']) }} um cliente em {{ dateTimeBrazilianFormat($log['created_at']) }}
                                -
                                <a href="{{ route('customers.show', ['id' => $log->customer_id]) }}">{{ __("View Customer") }}</a>
                                </li>
                            @empty
                                <li>Nenhuma atividade encontrada.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                {{-- Users --}}
                <div class="card">
                    <div class="card-header">Usuários</div>
                    <div class="card-body">
                        <ul>
                            @forelse($logs['user_logs'] as $log)
                                <li>{{ ucfirst($log['action']) }} um usuário em {{ dateTimeBrazilianFormat($log['created_at']) }}
                                -
                                <a href="{{ route('users.show', ['id' => $log->user_id]) }}">{{ __("View User") }}</a>
                                </li>
                            @empty
                                <li>Nenhuma atividade encontrada.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
