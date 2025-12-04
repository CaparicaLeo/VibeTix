@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Left Side - Event Image and Info --}}
        <div>
            {{-- Event Image --}}
            <div class="rounded-2xl overflow-hidden shadow-2xl mb-6">
                @if($event->banner_image_url)
                    <img src="{{ $event->banner_image_url }}"
                         alt="{{ $event->title }}"
                         class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-purple-600 to-purple-800 flex items-center justify-center">
                        <svg class="w-32 h-32 text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Event Title --}}
            <h1 class="text-4xl font-bold text-white mb-4">{{ $event->title }}</h1>

            {{-- Event Date and Location --}}
            <div class="bg-purple-800 bg-opacity-50 rounded-lg p-6 mb-6">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-purple-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-purple-300">Data</p>
                        <p class="text-lg font-semibold text-white">
                            {{ optional($event->date_time)->format('d/m/Y') ?? 'A definir' }} às {{ optional($event->date_time)->format('H:i') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center">
                    <svg class="w-6 h-6 text-purple-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-purple-300">Local</p>
                        <p class="text-lg font-semibold text-white">{{ $event->location }}</p>
                    </div>
                </div>
            </div>

            {{-- Event Description --}}
            <div class="bg-gray-900 bg-opacity-50 rounded-lg p-6">
                <h2 class="text-2xl font-bold text-white mb-4">Descrição</h2>
                <p class="text-gray-300 leading-relaxed">{{ $event->description }}</p>
            </div>
        </div>

        {{-- Right Side - Ticket Selection --}}
        <div class="bg-white rounded-2xl p-8 shadow-2xl h-fit sticky top-4">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Ingressos</h2>

            @if($event->tickets->count() > 0)
                <form action="{{ route('inscriptions.store') }}" method="POST" id="ticketForm">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="space-y-4 mb-6">
                        @foreach($event->tickets as $ticket)
                            <div class="border border-gray-200 rounded-lg p-4 hover:border-purple-500 transition">
                                <div class="flex justify-between items-center mb-3">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $ticket->type }}</h3>
                                        <p class="text-sm text-gray-500">
                                            {{ $ticket->available_quantity }} ingressos disponíveis
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-2xl font-bold text-purple-600">
                                            R$ {{ number_format($ticket->price, 2, ',', '.') }}
                                        </p>
                                        <p class="text-xs text-gray-500">+ taxas</p>
                                    </div>
                                </div>

                                {{-- Quantity Selector --}}
                                <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                    <span class="text-sm font-medium text-gray-700">Quantidade</span>
                                    <div class="flex items-center space-x-3">
                                        <button type="button"
                                                onclick="changeQuantity('ticket-{{ $ticket->id }}', -1)"
                                                class="w-8 h-8 flex items-center justify-center bg-purple-600 text-white rounded-full hover:bg-purple-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>

                                        <input type="number"
                                               id="ticket-{{ $ticket->id }}"
                                               name="tickets[{{ $ticket->id }}]"
                                               value="0"
                                               min="0"
                                               max="{{ $ticket->available_quantity }}"
                                               readonly
                                               class="w-16 text-center text-lg font-semibold bg-white border border-gray-300 rounded-lg">

                                        <button type="button"
                                                onclick="changeQuantity('ticket-{{ $ticket->id }}', 1)"
                                                class="w-8 h-8 flex items-center justify-center bg-purple-600 text-white rounded-full hover:bg-purple-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Total and Submit Button --}}
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-3xl font-bold text-purple-600" id="totalPrice">R$ 0,00</span>
                        </div>

                        @auth
                            <button type="submit"
                                    class="w-full bg-purple-600 text-white py-4 rounded-lg font-bold text-lg hover:bg-purple-700 transition shadow-lg">
                                Comprar Ingressos
                            </button>
                        @else
                            <a href="{{ route('login') }}"
                               class="block w-full bg-purple-600 text-white py-4 rounded-lg font-bold text-lg hover:bg-purple-700 transition shadow-lg text-center">
                                Faça login para comprar
                            </a>
                        @endauth
                    </div>
                </form>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="text-gray-600 font-semibold mb-2">Ingressos não disponíveis</p>
                    <p class="text-gray-500 text-sm">Este evento ainda não possui ingressos à venda.</p>
                </div>
            @endif
        </div>

    </div>
</div>

<script>
    // Store ticket prices
    const ticketPrices = {
        @foreach($event->tickets as $ticket)
            '{{ $ticket->id }}': {{ $ticket->price }},
        @endforeach
    };

    function changeQuantity(inputId, change) {
        const input = document.getElementById(inputId);
        const currentValue = parseInt(input.value) || 0;
        const max = parseInt(input.max);
        const newValue = Math.max(0, Math.min(max, currentValue + change));

        input.value = newValue;
        updateTotal();
    }

    function updateTotal() {
        let total = 0;

        @foreach($event->tickets as $ticket)
            const quantity{{ $ticket->id }} = parseInt(document.getElementById('ticket-{{ $ticket->id }}').value) || 0;
            total += quantity{{ $ticket->id }} * ticketPrices['{{ $ticket->id }}'];
        @endforeach

        document.getElementById('totalPrice').textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
    }
</script>
@endsection
