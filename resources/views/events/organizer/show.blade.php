@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">

        <!-- Cabeçalho do organizador -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h1>
                <p class="text-gray-600 text-sm">
                    Evento criado por {{ $event->organizer->name }} • {{ $event->created_at->format('d/m/Y') }}
                </p>
            </div>

            @auth
                @if(auth()->user()->id === $event->organizer_id)
                    <a href="{{ route('organizer.events.edit', $event->id) }}"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                        Editar Evento
                    </a>
                @endif
            @endauth
        </div>

        <!-- Banner -->
        @if($event->banner_image_url)
            <div class="w-full h-64 rounded-xl overflow-hidden shadow mb-10">
                <img src="{{ $event->banner_image_url }}" class="w-full h-full object-cover" alt="Banner do evento">
            </div>
        @endif

        <!-- Grid de Informações -->
        @auth
            @if(auth()->user()->id === $event->organizer_id)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

                    <!-- Card: Vendas -->
                    <div class="bg-white shadow rounded-xl p-6">
                        <h3 class="text-lg font-semibold mb-2">Ingressos Vendidos</h3>
                        <p class="text-3xl font-bold text-blue-600">
                            {{ $sold_count ?? 0 }}
                        </p>
                        <p class="text-gray-500 text-sm">Total de vendas confirmadas</p>
                    </div>

                    <!-- Card: Receita -->
                    <div class="bg-white shadow rounded-xl p-6">
                        <h3 class="text-lg font-semibold mb-2">Receita Total</h3>
                        <p class="text-3xl font-bold text-purple-600">
                            R$ {{ number_format($total_revenue ?? 0, 2, ',', '.') }}
                        </p>
                        <p class="text-gray-500 text-sm">Somatório de todos os ingressos vendidos</p>
                    </div>

                </div>
            @endif
        @endauth

        <!-- Descrição -->
        <div class="bg-white shadow p-6 rounded-xl mb-8">
            <h2 class="text-xl font-bold mb-4">Descrição do Evento</h2>
            <p class="text-gray-700 leading-relaxed">
                {!! nl2br(e($event->description)) !!}
            </p>
        </div>

        <!-- Informações extras -->
        <div class="bg-white shadow p-6 rounded-xl mb-10">
            <h2 class="text-xl font-bold mb-4">Informações</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <p class="text-gray-500 text-sm">Data e Hora:</p>
                    <p class="text-lg font-semibold">
                        {{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Local:</p>
                    <p class="text-lg font-semibold">{{ $event->location }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Status:</p>
                    @if($event->is_active)
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                            Ativo
                        </span>
                    @elseif($event->has_passed)
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium">
                            Encerrado
                        </span>
                    @else
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-medium">
                            {{ ucfirst($event->status) }}
                        </span>
                    @endif
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Criado em:</p>
                    <p class="text-lg font-semibold">{{ $event->created_at->format('d/m/Y') }}</p>
                </div>

            </div>
        </div>

        <!-- Ingressos -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Ingressos</h2>
                
                @auth
                    @if(auth()->user()->id === $event->organizer_id)
                        <a href="{{ route('organizer.events.tickets.create', $event->id) }}"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">
                            Criar Ingresso
                        </a>
                    @endif
                @endauth
            </div>

            @if ($event->tickets->count() > 0)
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 font-medium">Nome</th>
                            <th class="py-2 font-medium">Preço</th>
                            <th class="py-2 font-medium">Quantidade</th>
                            @auth
                                @if(auth()->user()->id === $event->organizer_id)
                                    <th class="py-2 font-medium text-right">Ações</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->tickets as $ticket)
                            <tr class="border-b">
                                <td class="py-2">{{ $ticket->name }}</td>
                                <td class="py-2">R$ {{ number_format($ticket->price, 2, ',', '.') }}</td>
                                <td class="py-2">{{ $ticket->quantity_total }}</td>

                                @auth
                                    @if(auth()->user()->id === $event->organizer_id)
                                        <td class="py-2 text-right space-x-2">
                                            <!-- Editar -->
                                            <a href="{{ route('organizer.events.tickets.edit', [$event->id, $ticket->id]) }}"
                                                class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                                                Editar
                                            </a>

                                            <!-- Deletar -->
                                            <form action="{{ route('organizer.events.tickets.destroy', [$event->id, $ticket->id]) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Tem certeza que deseja excluir este ingresso?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md">
                                                    Deletar
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                @endauth

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Nenhum ingresso cadastrado para este evento.</p>
            @endif
        </div>

    </div>
@endsection