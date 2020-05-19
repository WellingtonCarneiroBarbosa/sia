@extends('layouts.dashboard')

@section('title', 'Chat')

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">Chat</div>

            {{-- Corpo do chat --}}
            <div class="card-body">
                <chat-app :user="{{ auth()->user() }}"></chat-app>
            </div>
            {{-- Fim do corpo do chat --}}
        </div>

    </div>
</div>
@endsection
