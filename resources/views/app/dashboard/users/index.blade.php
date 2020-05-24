@extends('layouts.dashboard')
@section('title', Lang::get('Users'))
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __("Users") }}</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    @if(auth()->user()->role_id == 5)
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-neutral mb-2" id="novo-usuario">{{ __("New") }}</a>
                    @endif
                    <a href="#" data-toggle="modal" data-target="#modal-filter" id="filtros-usuario" class="btn btn-sm btn-neutral mb-2 mr-2">{{ __("Filters") }}</a>
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
            @if($hasUsers)
                @component('components.userTable', ['users' => $users])@endcomponent
            @else
                @component('components.noData', ['message' => Lang::get("It looks like you're already here. Click new and register as a user")])@endcomponent
            @endif
        </div>
    </div>

   {{--  @component('components.modals.findSchedule', ['hasPlaces' => $hasPlaces, 'places' => $places])@endcomponent --}}

@endsection
