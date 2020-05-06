@extends('layouts.dashboard')

@section('title', 'Usuários')

@section('content')
    <!-- alertas -->
    @component('components.alert')@endcomponent

    <h1>Users</h1>
    @foreach($usuarios as $user)
    {{-- conteudo a ser impresso --}}

        {{ $user->name }}
        <br>
        {{ $user->email }}
        <br>
        <hr>

    @endforeach
@endsection
