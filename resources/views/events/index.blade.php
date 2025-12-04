@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-8 text-black">Eventos</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($events as $event)
                    <a href="{{ route('events.show', $event) }}" class="group">
                        <div
                            class="relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                            @if ($event->banner_image_url)
                                <img src="{{ $event->banner_image_url }}" alt="{{ $event->title }}"
                                    class="w-full h-80 object-cover">
                            @else
                                <div
                                    class="w-full h-80 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                                    <span class="text-white text-4xl font-bold">{{ substr($event->title, 0, 1) }}</span>
                                </div>
                            @endif

                            {{-- Overlay com informações --}}
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 via-black/60 to-transparent p-4">
                                <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">{{ $event->title }}</h3>
                                <p class="text-purple-300 text-sm font-medium">
                                    @if ($event->tickets)
                                        Ingressos Disponíveis
                                    @else
                                        Ingressos Esgotados
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
