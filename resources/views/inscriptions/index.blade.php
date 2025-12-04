@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-purple-50 py-12">
    <div class="container mx-auto px-4 max-w-7xl">
        
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                Minhas Inscrições
            </h1>
            <p class="text-gray-600">Gerencie todos os seus ingressos em um só lugar</p>
        </div>

        @if ($inscriptions->isEmpty())
            {{-- Estado Vazio --}}
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">
                        Nenhuma inscrição ainda
                    </h3>
                    <p class="text-gray-600 mb-6">
                        Você ainda não se inscreveu em nenhum evento. Explore os eventos disponíveis e garanta seu ingresso!
                    </p>
                    <a 
                        href="{{ route('events.index') }}" 
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Explorar Eventos
                    </a>
                </div>
            </div>
        @else
            {{-- Lista de Inscrições --}}
            <div class="grid gap-6">
                @foreach ($inscriptions as $inscription)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <div class="md:flex">
                            
                            {{-- Imagem do Evento --}}
                            <div class="md:w-64 h-48 md:h-auto bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center relative overflow-hidden">
                                @if($inscription->event->image ?? false)
                                    <img src="{{ $inscription->event->image }}" alt="{{ $inscription->event->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="text-center text-white p-6">
                                        <svg class="w-16 h-16 mx-auto mb-2 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="font-semibold text-sm">{{ $inscription->event->name ?? 'Evento' }}</p>
                                    </div>
                                @endif
                                
                                {{-- Badge de Status --}}
                                <div class="absolute top-4 right-4">
                                    @php
                                        $statusConfig = [
                                            'pending' => ['bg' => 'bg-yellow-500', 'text' => 'Pendente'],
                                            'confirmed' => ['bg' => 'bg-green-500', 'text' => 'Confirmado'],
                                            'cancelled' => ['bg' => 'bg-red-500', 'text' => 'Cancelado'],
                                        ];
                                        $status = $statusConfig[$inscription->status] ?? ['bg' => 'bg-gray-500', 'text' => ucfirst($inscription->status)];
                                    @endphp
                                    <span class="{{ $status['bg'] }} text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                        {{ $status['text'] }}
                                    </span>
                                </div>
                            </div>

                            {{-- Conteúdo --}}
                            <div class="flex-1 p-6">
                                <div class="flex flex-col h-full">
                                    
                                    {{-- Informações do Evento --}}
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                            {{ $inscription->event->name ?? '—' }}
                                        </h3>
                                        
                                        <div class="space-y-2 mb-4">
                                            {{-- Tipo de Ticket --}}
                                            <div class="flex items-center text-gray-600">
                                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                                </svg>
                                                <span class="font-semibold">{{ $inscription->ticket->name ?? '—' }}</span>
                                            </div>

                                            {{-- Data do Evento (se disponível) --}}
                                            @if($inscription->event->date ?? false)
                                                <div class="flex items-center text-gray-600">
                                                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span>{{ \Carbon\Carbon::parse($inscription->event->date)->format('d/m/Y') }}</span>
                                                </div>
                                            @endif

                                            {{-- Local do Evento (se disponível) --}}
                                            @if($inscription->event->location ?? false)
                                                <div class="flex items-center text-gray-600">
                                                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <span>{{ $inscription->event->location }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- QR Code Preview --}}
                                        <div class="inline-flex items-center bg-gray-50 px-3 py-2 rounded-lg">
                                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                            </svg>
                                            <span class="text-sm text-gray-600 font-mono">{{ $inscription->qr_code }}</span>
                                        </div>
                                    </div>

                                    {{-- Ações --}}
                                    <div class="flex gap-3 mt-6 pt-4 border-t border-gray-100">
                                        <a 
                                            href="{{ route('inscriptions.show', $inscription->id) }}" 
                                            class="flex-1 text-center px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Ver Detalhes
                                        </a>
                                        
                                        @if($inscription->event ?? false)
                                            <a 
                                                href="{{ route('events.show', $inscription->event->id) }}" 
                                                class="px-6 py-3 border-2 border-purple-600 text-purple-600 font-semibold rounded-lg hover:bg-purple-50 transition-all duration-200">
                                                Ver Evento
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginação (se necessário) --}}
            @if($inscriptions instanceof \Illuminate\Pagination\LengthAwarePaginator && $inscriptions->hasPages())
                <div class="mt-8">
                    {{ $inscriptions->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection