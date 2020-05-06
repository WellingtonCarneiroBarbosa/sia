 <!-- identificador do local -->
 <div class="form-group mb-3">
    <span>{{ __("Identifier number") }}:</span>
    <strong>{{ $place->id }}</strong>
</div>

<!-- nome do local -->
<div class="form-group mb-3">
    <span>{{ __("Name") }}:</span>
    <strong>{{ $place->name }}</strong> 
</div>

<!-- capacidade do ambiente -->
<div class="form-group mb-3">
    <span>{{ __("Capacity") }}:</span>
    <strong>{{ str_replace(',', '.', number_format($place->capacity)) }} {{ __("peoples") }}</strong>
</div>

<!-- tamanho do ambiente -->
<div class="form-group mb-3">
   <span>{{ __("Size") }}:</span>
   <strong>{{ str_replace(',', '.', number_format($place->size)) }} m<sup>2</sup> </strong>
</div>

<!--tensao-->
<div class="form-group mb-3">
    <span>{{ __("Outlet voltage") }}:</span>
    <strong>
    @if($place->outletVoltage)
        220v
    @else
        127v
    @endif
    </strong>
</div>

@if($place->hasProjector)
<!-- qtd projetores -->
<div class="form-group mb-3">
    <span>{{ __("Projectors") }}:</span>
    <strong>
        {{ $place->howManyProjectors }}
    </strong>
</div>
@endif

@if($place->hasTranslationBooth)
<!-- qtd projetores -->
<div class="form-group mb-3">
    <span>{{ __("Translation booths") }}:</span>
    <strong>
        {{ $place->howManyBooths }}
    </strong>
</div>
@endif

<!-- qtd projetores -->
<div class="form-group mb-3">
    <span>{{ __("Sound") }}?</span>
    <strong>
    @if($place->hasSound)
        {{ __("Yes") }}
    @else
        {{ __("No") }}
    @endif
    </strong>
</div>

<!-- tem iluminação -->
<div class="form-group mb-3">
    <span>{{ __("Scenic lighting") }}?</span>
    <strong>
    @if($place->hasLighting)
       {{ __("Yes") }}
    @else
       {{ __("No") }}
    @endif
    </strong>
</div>

<!-- tem wifi -->
<div class="form-group mb-3">
    <span>{{ __("Wifi") }}?</span>
    <strong>
    @if($place->hasWifi)
       {{ __("Yes") }}
    @else
       {{ __("No") }}
    @endif
    </strong>
</div>

<!-- tem wifi -->
<div class="form-group mb-3">
    <span>{{ __("Accessibility") }}?</span>
    <strong>
    @if($place->hasAccessibility)
       {{ __("Yes") }}
    @else
       {{ __("No") }}
    @endif
    </strong>
</div>

<!-- tem estacionamento gratis -->
<div class="form-group mb-3">
    <span>{{ __("Free parking") }}?</span>
    <strong>
    @if($place->hasFreeParking)
        {{ __("Yes") }}
    @else
        {{ __("No") }}
    @endif
    </strong>
</div>

 <!-- criado em -->
 @if ($place->created_at)
    <div class="form-group mb-3">
        <span>{{ __("Created at") }}:</span>
        <strong>{{dateBrazilianFormat($place->created_at)}} {{ __("at") }} {{ timeBrazilianFormat($place->created_at) }}</strong>
    </div>
@endif

<!-- editado em -->
@if ($place->created_at != $place->updated_at)
    <div class="form-group mb-3">
        <span>{{ __("Updated") }}:</span>
        <strong>{{dateBrazilianFormat($place->updated_at)}} {{ __("at") }} {{ timeBrazilianFormat($place->updated_at) }}</strong>
    </div>
@endif

<!--deletado em-->
@if ($place->deleted_at)
<div class="form-group mb-3">
    <span>{{ __("Deleted at") }}:</span>
    <strong>{{dateBrazilianFormat($place->deleted_at)}} {{ __("at") }} {{ timeBrazilianFormat($place->deleted_at) }}</strong>
</div>
@endif 