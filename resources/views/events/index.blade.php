@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold mb-6">Lista de Eventos</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($events as $event)
                <div class="bg-gray-800 rounded-xl shadow p-5">

                    {{-- Imagem --}}
                    @if ($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-40 object-cover rounded-lg mb-3">
                    @else
                        <div class="w-full h-40 bg-gray-700 rounded-lg flex items-center justify-center mb-3">
                            <span class="text-gray-400 text-sm">Sem imagem</span>
                        </div>
                    @endif

                    <h2 class="text-lg font-semibold">{{ $event->title }}</h2>

                    <p class="text-gray-300 text-sm mb-1">{{ $event->local }}</p>

                    <p class="text-gray-400 text-sm mb-3">
                        <strong>Data:</strong>
                        @if ($event->date)
                            {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                        @else
                            <span class="text-gray-400">Sem data</span>
                        @endif

                    </p>

                    <p class="text-gray-400 text-sm mb-4">
                        {{ $event->description }}
                    </p>

                    <a href="{{ route('events.show', $event) }}" class="text-blue-400 hover:text-blue-300">
                        Ver detalhes →
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
