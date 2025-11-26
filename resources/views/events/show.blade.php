@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-10">

        <a href="{{ route('events.index') }}" class="text-gray-400 hover:text-gray-200 mb-6 inline-block">
            ← Voltar
        </a>

        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-xl overflow-hidden">

            {{-- Banner --}}
            @if ($event->banner_image_url)
                <img src="{{ $event->banner_image_url }}" class="w-full h-64 object-cover">
            @else
                <div class="w-full h-64 bg-gray-700 flex items-center justify-center">
                    <span class="text-gray-400">Sem imagem</span>
                </div>
            @endif

            <div class="p-8">

                {{-- Cabeçalho --}}
                <div class="flex justify-between items-start mb-6">
                    <h1 class="text-3xl font-bold text-white">{{ $event->title }}</h1>

                    @php
                        $colors = [
                            'scheduled' => 'bg-blue-600 text-white',
                            'on going' => 'bg-yellow-400 text-gray-900',
                            'done' => 'bg-green-600 text-white',
                            'cancelled' => 'bg-red-600 text-white',
                        ];
                        $statusColor = $colors[$event->status] ?? 'bg-gray-600 text-white';
                    @endphp

                    <span class="px-4 py-2 rounded-md text-sm font-semibold {{ $statusColor }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <p class="text-gray-300 mb-2">
                    <strong>Local:</strong> {{ $event->location ?? 'Não informado' }}
                </p>

                <p class="text-gray-300 mb-6">
                    <strong>Data:</strong>
                    {{ optional($event->date_time)->format('d/m/Y') ?? 'Sem data' }}
                </p>

                <hr class="border-gray-700 my-6">

                {{-- Descrição --}}
                <h2 class="text-xl font-semibold text-white mb-2">Descrição</h2>
                <p class="text-gray-300 mb-6">
                    {{ $event->description ?? 'Nenhuma descrição fornecida.' }}
                </p>

                <hr class="border-gray-700 my-6">

                {{-- Tickets --}}
                <h2 class="text-xl font-semibold text-white mb-4">Tickets</h2>

                @if ($event->tickets->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-700 rounded-lg overflow-hidden">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-gray-300">Tipo</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Preço</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Quantidade</th>
                                </tr>
                            </thead>

                            <tbody class="bg-gray-800">
                                @foreach ($event->tickets as $ticket)
                                    <tr class="border-t border-gray-700">
                                        <td class="px-4 py-3 text-gray-200">{{ $ticket->name }}</td>
                                        <td class="px-4 py-3 text-gray-200">
                                            R$ {{ number_format($ticket->price, 2, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-200">{{ $ticket->quantity_total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    <p class="text-gray-400">Nenhum ticket criado ainda.</p>
                @endif

            </div>
        </div>
    </div>
@endsection
