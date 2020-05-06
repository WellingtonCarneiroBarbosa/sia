@props(['id' => '', 'name' => 'date', 'type' => 'text', 'class' => '', 'icon' => 'fa fa-tag'])

@php
    if(isset($icon))
    {
        if($icon === 'date')
        {
            $icon = 'fa fa-calendar';
        }
    }
@endphp

<div class="form-group">
    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="{{ $icon }}" ></i></span>
        </div>
        <input  title="{{ __("Fill this field") }}" {{ $attributes->merge(['id' => $id, 'name' => $name, 'type' => $type, 'class' => 'form-control '.$class]) }} placeholder="dd/mm/aaaa" @isset($required) required @endisset
        value="{{ $value ?? '' }}" />
    </div>
</div>