@extends('layouts.app')

@section('content')
    <div class="min-h-screen" style="background: linear-gradient(to bottom, #9333ea 0%, #9333ea 300px, #f3f4f6 300px);">
        <div class="max-w-7xl mx-auto px-6 py-8">

            {{-- Banner e Informações Principais --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

                {{-- Coluna Esquerda - Banner --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        @if ($event->banner_image_url)
                            <img src="{{ $event->banner_image_url }}" alt="{{ $event->title }}"
                                class="w-full h-96 object-cover">
                        @else
                            <div
                                class="w-full h-96 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                                <span class="text-white text-6xl font-bold">{{ substr($event->title, 0, 1) }}</span>
                            </div>
                        @endif

                        <div class="p-8">
                            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $event->title }}</h1>

                            <div class="flex flex-wrap gap-4 mb-6">
                                {{-- Status Badge --}}
                                <span
                                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $event->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    @if ($event->is_active)
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Evento Ativo
                                    @else
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Evento Encerrado
                                    @endif
                                </span>

                                {{-- Tickets Badge --}}
                                @php
                                    $totalTickets = $event->tickets->sum('quantity_total');
                                @endphp
                                @if ($totalTickets > 0)
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z" />
                                        </svg>
                                        {{ $totalTickets }} ingressos disponíveis
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Ingressos Esgotados
                                    </span>
                                @endif
                            </div>

                            {{-- Descrição --}}
                            <div class="prose max-w-none">
                                <h2 class="text-2xl font-semibold text-gray-900 mb-3">Sobre o Evento</h2>
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $event->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Coluna Direita - Detalhes e Ação --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Informações</h2>

                        {{-- Data e Hora --}}
                        <div class="flex items-start mb-6">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Data e Hora</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    @if ($event->date_time)
                                        {{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y') }}
                                        <br>
                                        <span class="text-base text-gray-600">
                                            {{ \Carbon\Carbon::parse($event->date_time)->format('H:i') }}
                                        </span>
                                    @else
                                        Data a confirmar
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- Localização --}}
                        <div class="flex items-start mb-6">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Local</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $event->location ?? 'Local a confirmar' }}
                                </p>
                            </div>
                        </div>

                        {{-- Organizador --}}
                        @if ($event->organizer)
                            <div class="flex items-start mb-8">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Organizador</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $event->organizer->name }}</p>
                                </div>
                            </div>
                        @endif

                        <hr class="my-6">

                        {{-- Botão de Inscrição --}}
                        @php
                            $totalTickets = $event->tickets->sum('quantity_total');
                        @endphp
                        @if ($event->is_active && $totalTickets > 0)
                            <a href="{{ route('inscriptions.create', ['event' => $event->id]) }}"
                                class="block w-full text-center px-6 py-4 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-bold text-lg rounded-xl hover:from-purple-700 hover:to-purple-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-6 h-6 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z" />
                                </svg>
                                Inscrever-se
                            </a>
                        @else
                            <button disabled
                                class="block w-full text-center px-6 py-4 bg-gray-300 text-gray-600 font-bold text-lg rounded-xl cursor-not-allowed shadow-lg">
                                @if (!$event->is_active)
                                    Evento Encerrado
                                @else
                                    Ingressos Esgotados
                                @endif
                            </button>
                        @endif

                        {{-- Botão Voltar --}}
                        <a href="{{ route('events.index') }}"
                            class="block w-full text-center px-6 py-3 mt-4 bg-white text-purple-600 font-semibold rounded-xl border-2 border-purple-600 hover:bg-purple-50 transition-all duration-200">
                            ← Voltar para Eventos
                        </a>
                    </div>
                </div>
            </div>

            {{-- Seção de Ingressos (se houver) --}}
            @if ($event->tickets->count() > 0)
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Ingressos Disponíveis</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($event->tickets as $ticket)
                            <div
                                class="border-2 border-purple-200 rounded-xl p-6 hover:border-purple-500 transition-all duration-200">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $ticket->name }}</h3>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ $ticket->quantity_total }} disponíveis
                                    </span>
                                </div>

                                <div class="text-3xl font-bold text-purple-600">
                                    @if ($ticket->price > 0)
                                        R$ {{ number_format($ticket->price, 2, ',', '.') }}
                                    @else
                                        <span class="text-green-600">Gratuito</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
