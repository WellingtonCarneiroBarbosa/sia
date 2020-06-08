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

{{-- User Type --}}
<div class="form-group mb-3">
    <span>{{ __("User Type") }}:</span>
    @if($user->role_id == 5)
        <Strong>{{ __("Administrator") }}</Strong>
    @else
        <Strong>{{ __("Standart") }}</Strong>
    @endif
</div>

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
@if ($user->created_at != $user->updated_at && $user->updated_at != $user->deleted_at && $user->updated_at != $user->profile_completed_at)
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