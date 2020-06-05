@extends('layouts.dashboard')

@section('title', Lang::get('Deleted Customers'))

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Deleted Customers") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('customers.index') }}" class="btn btn-sm btn-neutral mb-2" id="new-place">{{ __("Come back to customers list") }}</a>
                    <a href="#" data-toggle="modal" data-target="#modal-filter" id="filtros-locais" class="btn btn-sm btn-neutral mb-2 mr-2">{{ __("Filters") }}</a>
                </div>
            </div>
            <!-- fim do header -->
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <!-- alertas -->
    @component('components.alert')@endcomponent

    <div class="row">
        <div class="col-xl-12">
            @if($hasCustomers)
                @component('components.deletedCustomerTable', ['customers' => $customers])@endcomponent
            @else
                @component('components.noData', ['message' => Lang::get("We still have nothing to display. Here, you can see the deleted customers list")])@endcomponent
            @endif
        </div>
    </div>

    @component('components.modals.findDeletedCustomer', ['hasCustomers' => $hasCustomers])@endcomponent

@endsection