{{-- Identificador --}}
 <div class="form-group mb-3">
    <span>{{ __("Identifier number") }}:</span>
    <strong>{{ $user->id }}</strong>
</div>

{{-- Nome --}}
<div class="form-group mb-3">
    <span>{{ __("Name") }}:</span>
    <strong>{{ $user->name }}</strong> 
</div>

{{-- Email --}}
<div class="form-group mb-3">
    <span>{{ __("Email") }}:</span>
    <strong>{{ $user->email }}</strong> 
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

{{-- criado em --}}
 @if ($user->created_at)
    <div class="form-group mb-3">
        <span>{{ __("Joined on") }}:</span>
        <strong>{{dateBrazilianFormat($user->created_at)}} {{ __("at") }} {{ timeBrazilianFormat($user->created_at) }}</strong>
    </div>
@endif

{{-- Conta verificada em --}}
@if($user->email_verified_at)
<div class="form-group mb-3">
    <span>{{ __("Verified account on") }}:</span>
    <strong>{{ dateBrazilianFormat($user->email_verified_at) }} {{ __("at") }} {{ timeBrazilianFormat($user->email_verified_at) }}</strong>
</div>
@endif

{{-- editado em --}}
@if ($user->created_at != $user->updated_at && $user->updated_at != $user->deleted_at)
    <div class="form-group mb-3">
        <span>{{ __("Updated") }}:</span>
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