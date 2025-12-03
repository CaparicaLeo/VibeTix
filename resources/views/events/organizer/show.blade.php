@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-10">

        {{-- Voltar --}}
        <a href="{{ route('events.index') }}" class="text-gray-700 text-sm mb-6 inline-block">
            ← Voltar para eventos
        </a>

        {{-- Header --}}
        <div class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-3xl font-bold text-wblack">{{ $event->title }}</h1>
                <p class="text-gray-600">{{ $event->location }}</p>
            </div>

            {{-- Status --}}
            @php
                $colors = [
                    'scheduled' => 'bg-blue-600',
                    'on going' => 'bg-yellow-500',
                    'done' => 'bg-green-600',
                    'cancelled' => 'bg-red-600',
                ];
                $color = $colors[$event->status] ?? 'bg-gray-600';
            @endphp

            <span class="px-4 py-2 text-white rounded-lg {{ $color }}">
                {{ ucfirst($event->status) }}
            </span>
        </div>

        {{-- Banner --}}
        @if ($event->banner_image_url)
            <img src="{{ $event->banner_image_url }}" class="w-full h-64 object-cover rounded-xl mb-8">
        @else
            <div class="w-full h-64 bg-white-600 rounded-xl flex items-center justify-center text-gray-400 mb-8">
                Sem imagem
            </div>
        @endif

        {{-- Info básica --}}
        <div class="bg-gray-100 p-6 rounded-xl">
            <h2 class="text-xl font-semibold mb-4 text-black-300">Informações do Evento</h2>

            <p class="text-black-300 mb-2"><strong>Local:</strong> {{ $event->location }}</p>

            <p class="text-black-300 mb-2">
                <strong>Data:</strong>
                {{ $event->date_time ? \Carbon\Carbon::parse($event->date_time)->format('d/m/Y') : 'Sem data' }}
            </p>

            <p class="text-black-300">
                <strong>Descrição:</strong><br>
                <span class="text-black-400">{{ $event->description }}</span>
            </p>
        </div>

        {{-- Tickets --}}
        <div class="bg-gray-400 p-6 rounded-xl">
            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-semibold">Tickets do Evento</h2>

                <a href="{{ route('organizer.events.tickets.create', $event->id) }}"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-sm">
                    + Criar Ticket
                </a>
            </div>

            @if ($event->tickets->count())
                <table class="w-full text-left text-black-300">
                    <thead class="text-black-400 border-b border-gray-700">
                        <tr>
                            <th class="py-2">Tipo</th>
                            <th class="py-2">Preço</th>
                            <th class="py-2">Qtd.</th>
                            <th class="py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->tickets as $ticket)
                            <tr class="border-b border-gray-700">
                                <td class="py-3">{{ $ticket->name }}</td>
                                <td class="py-3">R$ {{ number_format($ticket->price, 2, ',', '.') }}</td>
                                <td class="py-3">{{ $ticket->quantity_total }}</td>
                                <td class="py-3">
                                    <a href="#" class="text-blue-700 hover:text-blue-300 mr-3">Editar</a>
                                    <a href="#" class="text-red-700 hover:text-red-300">Excluir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-400">Nenhum ticket criado.</p>
            @endif
        </div>

        {{-- Botões finais --}}
        <div class="flex gap-4">
            <a href="#" class="bg-yellow-600 hover:bg-yellow-500 text-white px-5 py-2 rounded-lg">
                Editar Evento
            </a>

            <a href="#" class="bg-red-600 hover:bg-red-500 text-white px-5 py-2 rounded-lg">
                Cancelar Evento
            </a>
        </div>

    </div>
@endsection
