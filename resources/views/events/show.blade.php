@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>

    <div class="bg-white font-inter pb-20 -mt-8">

        {{-- 1. BANNER DE FUNDO --}}
        <div class="w-full h-[250px] md:h-[350px] overflow-hidden relative bg-gray-300">
            @if ($event->banner_image_url)
                <img src="{{ $event->banner_image_url }}" alt="Banner Fundo" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/30"></div>
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-gray-500">
                    <svg class="w-16 h-16 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm font-semibold uppercase tracking-wider opacity-60">Área do Banner</span>
                </div>
            @endif
        </div>

        {{-- 2. CONTEÚDO PRINCIPAL --}}
        <div class="max-w-[1200px] mx-auto px-6 -mt-24 md:-mt-40 relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- COLUNA ESQUERDA --}}
                <div class="lg:col-span-7">
                    
                    {{-- Poster --}}
                    <div class="w-full aspect-video md:aspect-[16/9] rounded-[20px] overflow-hidden shadow-2xl mb-8 relative bg-gray-200">
                         @if ($event->banner_image_url)
                            <img src="{{ $event->banner_image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                            <div class="absolute bottom-6 left-6 text-white drop-shadow-md">
                                <p class="text-2xl font-bold lowercase">{{ \Carbon\Carbon::parse($event->date_time)->format('d M') }}</p>
                                <p class="text-2xl font-bold lowercase">{{ $event->location ?? 'local a definir' }}</p>
                            </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <span class="text-gray-400 text-4xl font-bold">{{ substr($event->title, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Infos do Evento --}}
                    <div class="mt-4">
                        <h1 class="text-black font-extrabold text-2xl md:text-3xl uppercase mb-6 leading-tight">
                            {{ $event->title }}
                        </h1>

                        <div class="space-y-3 mb-8">
                            <div class="flex items-center text-gray-800">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-width="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6" stroke-width="2"></line>
                                    <line x1="8" y1="2" x2="8" y2="6" stroke-width="2"></line>
                                    <line x1="3" y1="10" x2="21" y2="10" stroke-width="2"></line>
                                </svg>
                                <span class="text-base font-medium uppercase">
                                    {{ \Carbon\Carbon::parse($event->date_time)->translatedFormat('d F') }} ÀS {{ \Carbon\Carbon::parse($event->date_time)->format('H:i') }}
                                </span>
                            </div>
                            <div class="flex items-center text-gray-800">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-base font-medium uppercase">
                                    {{ $event->location ?? 'LOCAL A DEFINIR' }}
                                </span>
                            </div>
                        </div>

                        <div class="w-full border-t border-gray-300 my-8"></div>

                        <div>
                            <h3 class="font-bold text-lg mb-0 leading-none uppercase">DESCRIÇÃO</h3>
                            
                            <div class="text-gray-800 leading-snug whitespace-pre-line text-base mt-0">
                                {{ trim($event->description) }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- COLUNA DIREITA (Ingressos) --}}
                <div class="lg:col-span-5 mt-10 lg:mt-48">
                    <h2 class="font-bold text-xl mb-6 uppercase">INGRESSOS</h2>

                    <form action="{{ route('inscriptions.create', ['event' => $event->id]) }}" method="GET">
                        <div class="space-y-4">
                            @forelse ($event->tickets as $ticket)
                                <div class="bg-[#F2F2F2] rounded-lg p-5 flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-900 text-lg uppercase">{{ $ticket->name }}</span>
                                        <span class="font-bold text-gray-900 text-lg mt-1">
                                            {{ $ticket->price > 0 ? 'R$ ' . number_format($ticket->price, 2, ',', '.') : 'GRÁTIS' }}
                                        </span>
                                        @if($ticket->price > 0)
                                            <span class="text-xs text-gray-500 mt-1">
                                                + taxa a partir de R$ {{ number_format($ticket->price * 0.10, 2, ',', '.') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 bg-gray-100 rounded text-center text-gray-500">
                                    Nenhum ingresso disponível.
                                </div>
                            @endforelse
                        </div>

                        @if($event->is_active && $event->tickets->count() > 0)
                            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 rounded-lg shadow-lg mt-6 uppercase tracking-wide transition-colors">
                                Comprar Ingressos
                            </button>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection