@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold mb-8 text-black">Eventos</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($events as $event)
                <div
                    class="bg-white-800 border border-gray-700 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">

                    {{-- Imagem --}}
                    @if ($event->banner_image_url)
                        <img src="{{ $event->banner_image_url }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-purple-700 flex items-center justify-center">
                            <span class="text-gray-400">Sem imagem</span>
                        </div>
                    @endif

                    <div class="p-5">

                        <h2 class="text-xl font-semibold text-black mb-2">
                            {{ $event->title }}
                        </h2>

                        <p class="text-gray-600 text-sm mb-1">
                            {{ $event->location }}
                        </p>

                        <p class="text-gray-700 text-sm mb-3">
                            <strong>Data:</strong>
                            {{ $event->start_date ? (new \DateTime($event->start_date))->format('d/m/Y') : 'Sem data' }}
                        </p>

                        <p class="text-gray-700 text-sm mb-3">
                            @if ($event->tickets)
                                Ingressos Disponiveis
                            @else
                                Ingressos Esgotados.
                            @endif
                        </p>

                        <p class="text-gray-400 text-sm mb-4 line-clamp-3">
                            {{ $event->description }}
                        </p>

                        <a href="{{ route('events.show', $event) }}" class="text-blue-400 hover:text-blue-300 font-medium">
                            Ver detalhes →
                        </a>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
