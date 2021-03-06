<!-- identificador do agendamento -->
<div class="form-group mb-3">
    <span>{{ __("Identifier number") }}:</span>
    <strong>{{ $schedule->id }}</strong>
</div>

<!-- titulo do agendamento -->
<div class="form-group mb-3">
    <span>{{ __("Title") }}:</span>
    <strong>{{ $schedule->title }}</strong>
</div>

<!-- local do agendamento -->
<div class="form-group mb-3">
    <span>{{ __("Place") }}:</span>
    <strong>
        @if(isset($schedule->schedulingPlace['name']))
            {{ $schedule->schedulingPlace['name'] }}
        @elseif(isset($schedule->historicSchedulingPlace['name'])) 
            {{ $schedule->historicSchedulingPlace['name'] }}
        @else 
            {{ __("Undefined") }}
        @endif
    </strong>
</div>

<!--participantes do evento-->
<div class="form-group mb-3">
    <span>{{ __("Expected number of participants") }}:</span>
    <strong>{{ $schedule->participants }} {{ __("peoples") }} </strong> 
</div>

<!-- datahora inicio -->
<div class="form-group mb-3">
   <span>{{ __("Start") }}:</span>
   <strong>{{dateBrazilianFormat($schedule->start)}} {{ __("at") }}  {{ timeBrazilianFormat($schedule->start) }}</strong>
</div>

<!-- datahora final -->
<div class="form-group mb-3">
    <span>{{ __("End") }}:</span>
    <strong>{{dateBrazilianFormat($schedule->end)}} {{ __("at") }}  {{ timeBrazilianFormat($schedule->end) }}</strong>
</div>

<!-- cliente -->
<div class="form-group mb-3">
    <span>{{ __("Customer") }}:</span>
    <strong>
        @if(isset($schedule->schedulingCustomer['corporation'])) 
            {{ $schedule->schedulingCustomer['corporation'] }}
        @elseif(isset($schedule->historicSchedulingCustomer['corporation']))
            {{ $schedule->historicSchedulingCustomer['corporation'] }}
        @else 
            {{ __("Undefined") }}
        @endif
    </strong>
</div>

<!-- status -->
<div class="form-group mb-3">
    <span>{{ __("Status") }}:</span>
    @if(isset($schedule->schedule_id))
        <i class="bg-danger"></i>
        <strong class="status">{{ __("Expired") }}</strong>
    @elseif($now > $schedule->start && $now < $schedule->end)
        <i class="bg-success"></i>
        <strong class="status">{{ __("In progress") }}</strong>
    @elseif($now > $schedule->start && $now >= $schedule->end)
        <i class="bg-danger"></i>
        <strong class="status">{{ __("Finalized") }}</strong>
    @elseif(!$schedule->place_id)
        <i class="bg-danger"></i>
        <strong class="status">{{ __("Expired") }}</strong>
    @elseif($schedule->deleted_at != null)
        <i class="bg-danger"></i>
        <strong class="status">{{ __("canceled") }}</strong>
    @elseif (!$schedule->status)
        <i class="bg-warning"></i>
        <strong class="status">{{ __("On budget") }}</strong>
    @elseif($schedule->status)
        <i class="bg-success"></i>
        <strong class="status">{{ __("Confirmed") }}</strong>
    @endif

</div>

<!-- detalhes -->
<div class="form-group mb-3">
    <span>{{ __("Details") }}:</span>
    @if($schedule->details == null)
        <strong>{{ __("Nothing to show") }}</strong>
    @else
        {{ $schedule->details }}
    @endif
</div>

<!-- agendado em - por -->
<div class="form-group mb-3">
    <span>{{ __("Scheduled on") }}:</span>
    <strong>{{dateBrazilianFormat($schedule->created_at)}} {{ __("at") }} {{ timeBrazilianFormat($schedule->created_at) }}</strong>
</div>

<!-- editado em -->
@if ($schedule->created_at != $schedule->updated_at && $schedule->updated_at != $schedule->deleted_at)
    <div class="form-group mb-3">
        <span>{{ __("Updated") }}:</span>
        <strong>{{dateBrazilianFormat($schedule->updated_at)}} {{ __("at") }} {{ timeBrazilianFormat($schedule->updated_at) }}</strong>
    </div>
@endif

<!--cancelado em-->
@if ($schedule->deleted_at)
<div class="form-group mb-3">
    <span>{{ __("Canceled at") }}:</span>
    <strong>{{dateBrazilianFormat($schedule->deleted_at)}} {{ __("at") }} {{ timeBrazilianFormat($schedule->deleted_at) }}</strong>
</div>
@endif 