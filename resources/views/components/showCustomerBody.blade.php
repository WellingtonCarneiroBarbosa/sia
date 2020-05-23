{{-- customer's id --}}
 <div class="form-group mb-3">
    <span>{{ __("Identifier number") }}:</span>
    <strong>{{ $customer->id }}</strong>
</div>

{{-- customer's corporation --}}
<div class="form-group mb-3">
    <span>{{ __("Corporation") }}:</span>
    <strong>{{ $customer->corporation }}</strong> 
</div>
