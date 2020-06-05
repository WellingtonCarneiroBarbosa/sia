{{-- customer's id --}}
 <div class="form-group mb-3">
    <span>{{ __("Identifier number") }}:</span>
    <strong>{{ $customer->id }}</strong>
</div>

{{-- customer's corporation --}}
<div class="form-group mb-3">
    <span>{{ __("Enterprise") }}:</span>
    <strong>{{ $customer->corporation }}</strong> 
</div>

<div class="form-group mb-3">
    <span>{{ __("Created at") }}:</span>
    <strong>{{dateBrazilianFormat($customer->created_at)}} {{ __("at") }} {{ timeBrazilianFormat($customer->created_at) }}</strong>
</div>

<!-- editado em -->
@if ($customer->created_at != $customer->updated_at && $customer->updated_at != $customer->deleted_at)
    <div class="form-group mb-3">
        <span>{{ __("Updated") }}:</span>
        <strong>{{dateBrazilianFormat($customer->updated_at)}} {{ __("at") }} {{ timeBrazilianFormat($customer->updated_at) }}</strong>
    </div>
@endif

<!--cancelado em-->
@if ($customer->deleted_at)
<div class="form-group mb-3">
    <span>{{ __("Deleted at") }}:</span>
    <strong>{{dateBrazilianFormat($customer->deleted_at)}} {{ __("at") }} {{ timeBrazilianFormat($customer->deleted_at) }}</strong>
</div>
@endif 