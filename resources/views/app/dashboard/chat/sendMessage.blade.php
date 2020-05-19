@extends('layouts.dashboard')

@section('title', 'Send Message')

@section('content')
    <h1>Digite sua mensagem ae e tals</h1>
    <br>
    <form action="{{ route('chat.sendMessage') }}" method="POST">
        @csrf
        <input type="text" name="message" id="message">
        <br>
        <input type="submit" value="Enviar Mensagem">
    </form>
@endsection