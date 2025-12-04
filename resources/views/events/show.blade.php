@extends('layouts.app')

@section('content')
    <div class="container">

        <h1 class="mb-4">{{ $event->title }}</h1>

        <p class="text-muted">{{ $event->description }}</p>

        <hr>

        <div class="mt-4">
            <a href="{{ route('inscriptions.create', ['event' => $event->id]) }}" 
               class="btn btn-primary btn-lg">
                Fazer inscrição
            </a>
        </div>

    </div>
@endsection
