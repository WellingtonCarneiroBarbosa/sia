@if(count($schedules_log) > 0)
    <hr>
    <ul>
        @foreach ($schedules_log as $log)
        <li>{{ $user }}
            <strong>{{ $log->action }}</strong>
            {{ __("a schedule") }} <u>{{ $log->created_at->diffForHumans() }}</u>
            -
            @if(isset($log->schedule_id) && isset($log->schedule_log['id']))
                <a href="{{ route('schedules.show', ['id' => $log->schedule_id]) }}">Visualizar agendamento</a>
            @elseif(isset($log->schedule_id))
                <a href="{{ route('schedules.historic.show', ['id' => $log->schedule_id]) }}">Visualizar agendamento</a>
            @else
                <i>Visualização não disponível</i>
            @endif
        </li>
        @endforeach
    </ul>
@endif

@if(count($customers_log) > 0)
    <hr>
    <ul>
        @foreach ($customers_log as $log)
        <li>{{ $user }}
            <strong>{{ $log->action }}</strong>
            {{ __("a customer") }} <u>{{ $log->created_at->diffForHumans() }}</u>
            -
            <a href="{{ route('customers.show', ['id' => $log->customer_id]) }}">Visualizar cliente</a>
        </li>
        @endforeach
    </ul>
@endif
    
@if(count($places_log) > 0)
    <hr>
    <ul>
        @foreach ($places_log as $log)
        <li>{{ $user }}
            <strong>{{ $log->action }}</strong>
            {{ __("a place") }} <u>{{ $log->created_at->diffForHumans() }}</u>
            -
            @if(isset($log->place_id))
                <a href="{{ route('places.show', ['id' => $log->place_id]) }}">Visualizar local</a>
            @else
                <i>Visualização não disponível</i>
            @endif
            @endforeach
        </li>   
    </ul>
@endif

@if(count($users_log) > 0)
    <hr>
    <ul>
        @foreach ($users_log as $log)
        <li>{{ $user }}
            <strong>{{ $log->action }}</strong>
            {{ __("a user") }} <u>{{ $log->created_at->diffForHumans() }}</u>
            -
            <a href="{{ route('users.show', ['id' => $log->user_id]) }}">Visualizar usuário</a>
            @endforeach
        </li>   
    </ul>
@endif