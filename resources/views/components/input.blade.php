@props(['id' => '', 'name' => 'date', 'type' => 'text', 'class' => '', 'icon' => 'fa fa-tag', 'placeholder' => Lang::get('Fill this field')])

@php
    if(isset($icon))
    {
        if($icon === 'date')
        {
            $icon = 'fa fa-calendar';
            if(isset($class))
            {
                if($class === 'date')
                {
                    $placeholder = 'dd/mm/aaaa';
                }else
                {
                    $placeholder = 'dd/mm/aaaa hh:mm';
                }
            }
        }

        if($icon === 'group')
        {
            $icon = 'fa fa-users';
        }
    }
@endphp

<div class="form-group">
    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="{{ $icon }}" ></i></span>
        </div>
        <input  title="{{ __("Fill this field") }}" {{ $attributes->merge(['id' => $id, 'name' => $name, 'type' => $type, 'class' => 'form-control '.$class]) }} @isset($required) required @endisset value="{{ $value ?? '' }}" placeholder="{{ $placeholder ?? '' }}" />
    </div>
</div>