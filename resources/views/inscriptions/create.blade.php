@extends('layouts.app')

@section('content')
    <div class="min-h-screen" style="background: linear-gradient(to bottom, #9333ea 0%, #9333ea 300px, #f3f4f6 300px);">
        <div class="max-w-4xl mx-auto px-6 py-8">

            {{-- Título e Info do Evento --}}
            <div class="mb-8">
                <a href="{{ route('events.show', $event->id) }}"
                    class="inline-flex items-center text-white hover:text-purple-200 mb-4 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Voltar para o evento
                </a>
                <h1 class="text-4xl font-bold text-white mb-2">Inscrição no Evento</h1>
                <p class="text-purple-200 text-lg">{{ $event->title }}</p>
            </div>

            {{-- Card Principal --}}
            <div class="bg-white rounded-2xl shadow-xl p-8">

                {{-- Banner pequeno do evento --}}
                <div class="mb-6 rounded-xl overflow-hidden">
                    @if ($event->banner_image_url)
                        <img src="{{ $event->banner_image_url }}" alt="{{ $event->title }}"
                            class="w-full h-48 object-cover">
                    @else
                        <div
                            class="w-full h-48 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                            <span class="text-white text-4xl font-bold">{{ substr($event->title, 0, 1) }}</span>
                        </div>
                    @endif
                </div>

                {{-- Informações do Evento --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 p-4 bg-purple-50 rounded-xl">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-purple-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="text-sm text-gray-600">Data e Hora</p>
                            <p class="font-semibold text-gray-900">
                                @if ($event->date_time)
                                    {{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y \à\s H:i') }}
                                @else
                                    A confirmar
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-purple-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <p class="text-sm text-gray-600">Local</p>
                            <p class="font-semibold text-gray-900">{{ $event->location ?? 'A confirmar' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Formulário --}}
                <form action="{{ route('inscriptions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="mb-6">
                        <label for="ticket_id" class="block text-lg font-semibold text-gray-900 mb-4">
                            Selecione seu Ingresso
                        </label>

                        {{-- Grid de Tickets --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($tickets as $ticket)
                                <label for="ticket_{{ $ticket->id }}" class="cursor-pointer">
                                    <input type="radio" name="ticket_id" id="ticket_{{ $ticket->id }}"
                                        value="{{ $ticket->id }}" class="peer hidden" required>
                                    <div
                                        class="border-2 border-gray-200 rounded-xl p-6 transition-all duration-200 hover:border-purple-400 hover:shadow-md peer-checked:border-purple-600 peer-checked:bg-purple-50 peer-checked:shadow-lg">
                                        <div class="flex justify-between items-start mb-3">
                                            <h3 class="text-xl font-bold text-gray-900">{{ $ticket->name }}</h3>
                                            <div
                                                class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:border-purple-600 peer-checked:bg-purple-600 flex items-center justify-center peer-checked:*:block">
                                                <svg class="w-3 h-3 text-white hidden" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="flex items-baseline justify-between">
                                            <div>
                                                @if ($ticket->price > 0)
                                                    <p class="text-3xl font-bold text-purple-600">
                                                        R$ {{ number_format($ticket->price, 2, ',', '.') }}
                                                    </p>
                                                @else
                                                    <p class="text-3xl font-bold text-green-600">
                                                        Gratuito
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="text-right">
                                                <p class="text-sm text-gray-600">
                                                    <span
                                                        class="font-semibold text-gray-900">{{ $ticket->quantity_total }}</span>
                                                    disponíveis
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @error('ticket_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Botões de Ação --}}
                    <div class="flex flex-col sm:flex-row gap-4 mt-8">
                        <button type="submit"
                            class="flex-1 px-6 py-4 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-bold text-lg rounded-xl hover:from-purple-700 hover:to-purple-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-6 h-6 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Confirmar Inscrição
                        </button>

                        <a href="{{ route('events.show', $event->id) }}"
                            class="flex-1 px-6 py-4 bg-white text-purple-600 font-semibold text-lg rounded-xl border-2 border-purple-600 hover:bg-purple-50 transition-all duration-200 text-center">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

            {{-- Informações Adicionais --}}
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start">
                <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
                <div class="text-sm text-blue-800">
                    <p class="font-semibold mb-1">Importante:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Selecione o tipo de ingresso desejado</li>
                        <li>Após confirmar, você receberá um email com os detalhes da inscrição</li>
                        <li>Apresente o comprovante no dia do evento</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
