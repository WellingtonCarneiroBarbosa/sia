@extends('layouts.dashboard')

@section('title', 'Usuários')

@section('content')
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
