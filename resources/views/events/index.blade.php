@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- All Events Section --}}
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Eventos</h2>

        @if($events->count() > 0)
            <div class="relative">
                <div class="flex overflow-x-auto gap-6 pb-4 scrollbar-hide scroll-smooth snap-x snap-mandatory" id="carousel-events">
                    @foreach($events as $event)
                        <div class="flex-none w-64 snap-start">
                            <a href="{{ route('events.show', $event) }}" class="block group">
                                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                                    {{-- Event Image --}}
                                    @if($event->banner_image_url)
                                        <img src="{{ $event->banner_image_url }}"
                                             alt="{{ $event->title }}"
                                             class="w-full h-80 object-cover">
                                    @else
                                        <div class="w-full h-80 bg-gradient-to-br from-purple-600 to-purple-800 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                            </svg>
                                        </div>
                                    @endif

                                    {{-- Event Info Overlay --}}
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold text-white mb-1 truncate">{{ $event->title }}</h3>
                                        <p class="text-sm text-purple-300 mb-1">
                                            @if($event->status === 'active' || $event->status === 'scheduled')
                                                <span class="text-green-400">Ingressos Disponíveis</span>
                                            @else
                                                <span class="text-red-400">{{ ucfirst($event->status) }}</span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-400 truncate">{{ $event->location }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Scroll Buttons --}}
                @if($events->count() > 3)
                    <button onclick="scrollCarousel('carousel-events', -300)" class="absolute left-0 top-1/2 -translate-y-1/2 bg-purple-600 hover:bg-purple-700 text-white p-3 rounded-full shadow-lg z-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button onclick="scrollCarousel('carousel-events', 300)" class="absolute right-0 top-1/2 -translate-y-1/2 bg-purple-600 hover:bg-purple-700 text-white p-3 rounded-full shadow-lg z-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                @endif
            </div>
        @else
            <div class="bg-purple-800 bg-opacity-50 rounded-lg p-8 text-center">
                <p class="text-purple-200">Nenhum evento disponível no momento.</p>
            </div>
        @endif
    </div>

</div>

{{-- Custom Scrollbar Hide CSS --}}
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

{{-- Carousel Scroll Function --}}
<script>
    function scrollCarousel(carouselId, distance) {
        const carousel = document.getElementById(carouselId);
        carousel.scrollBy({
            left: distance,
            behavior: 'smooth'
        });
    }
</script>
@endsection
