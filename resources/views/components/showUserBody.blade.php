{{-- Identificador --}}
 <div class="form-group mb-3">
    <span>{{ __("Identifier number") }}:</span>
    <strong>{{ $user->id }}</strong>
</div>

{{-- Nome --}}
<div class="form-group mb-3">
    <span>{{ __("Name") }}:</span>
    <strong>{{ ucFirstNames($user->name) }}</strong> 
</div>

{{-- Email --}}
<div class="form-group mb-3">
    <span>{{ __("Email") }}:</span>
    <strong>{{ $user->email }}</strong> 
</div>

@if(auth()->user()->profile_completed_at)
<div class="form-group mb-3">
    <span>{{ __("State") }}:</span>

</div>

<div class="form-group mb-3">
    <span >{{ __("City") }}:</span>
</div>

<div class="form-group mb-3">
    <span>{{ __("Neighborhood") }}:</span>
</div>

<div class="form-group mb-3">
    <span>{{ __("Address") }}:</span>
</div>

<div class="form-group mb-3">
    <span id="cep">CEP:</span>
    <Strong>{{CEPscore(auth()->user()->cep)}}</Strong>
    <input type="text" id="cep-value" style="display: none;" value="{{ auth()->user()->cep }}">
</div>

<div class="form-group mb-3">
    <span>CPF:</span>
    <strong>{{ CPFscore(auth()->user()->cpf) }}</strong>
</div>
@endif
{{-- Status --}}
<div class="form-group mb-3">
    <span>{{ __("Status") }}:</span>
    @if($user->deleted_at)
    <strong>{{ ucfirst(__("disabled") )}}</strong>
    @else 
    <strong>{{ ucfirst(__("activated") )}}</strong>
    @endif
</div>

{{-- Conta verificada --}}
<div class="form-group mb-3">
    <span>{{ __("Account verified") }}:</span>
    <strong>
    @if($user->email_verified_at)
    {{ __("Yes") }}
    @else 
    {{ __("No") }}
    @endif
    </strong>
</div>

{{-- Conta completa --}}
<div class="form-group mb-3">
    <span>{{ __("Account completed") }}:</span>
    <strong>
    @if($user->profile_completed_at)
    {{ __("Yes") }}
    @else 
    {{ __("No") }}
    @endif
    </strong>
</div>

<div class="form-group mb-3">
    <span>{{ __("Registered at") }}:</span>
    <strong>{{dateBrazilianFormat($user->created_at)}} {{ __("at") }} {{ timeBrazilianFormat($user->created_at) }}</strong>
</div>

{{-- Conta verificada em --}}
@if($user->email_verified_at)
<div class="form-group mb-3">
    <span>{{ __("Verified account on") }}:</span>
    <strong>{{ dateBrazilianFormat($user->email_verified_at) }} {{ __("at") }} {{ timeBrazilianFormat($user->email_verified_at) }}</strong>
</div>
@endif

{{-- Conta completa em --}}
@if($user->profile_completed_at)
<div class="form-group mb-3">
    <span>{{ __("Last update on profile at") }}:</span>
    <strong>{{dateBrazilianFormat($user->profile_completed_at)}} {{ __("at") }} {{ timeBrazilianFormat($user->profile_completed_at) }}</strong>
</div>
@endif

{{-- editado em --}}
@if (auth()->user()->created_at != auth()->user()->updated_at && auth()->user()->updated_at != auth()->user()->deleted_at && auth()->user()->updated_at != auth()->user()->profile_completed_at)
    <div class="form-group mb-3">
        <span>{{ __("Last update on profile at") }}:</span>
        <strong>{{dateBrazilianFormat($user->updated_at)}} {{ __("at") }} {{ timeBrazilianFormat($user->updated_at) }}</strong>
    </div>
@endif

{{-- deletado em --}}
@if ($user->deleted_at)
<div class="form-group mb-3">
    <span>{{ __("Disabled at") }}:</span>
    <strong>{{dateBrazilianFormat($user->deleted_at)}} {{ __("at") }} {{ timeBrazilianFormat($user->deleted_at) }}</strong>
</div>
@endif 