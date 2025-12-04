@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">Meus Ingressos</h1>
        <p class="text-purple-200">Gerencie todos os eventos nos quais você está inscrito</p>
    </div>

    @if ($inscriptions->isEmpty())
        <div class="bg-white rounded-xl p-12 shadow-lg text-center">
            <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Nenhuma inscrição encontrada</h3>
            <p class="text-gray-600 mb-6">Você ainda não se inscreveu em nenhum evento.</p>
            <a href="{{ route('events.index') }}" class="inline-block bg-purple-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-purple-700 transition">
                Explorar Eventos
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($inscriptions as $inscription)
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                    <!-- Event Image -->
                    @if($inscription->event->banner_image_url)
                        <img src="{{ $inscription->event->banner_image_url }}"
                             alt="{{ $inscription->event->title }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-purple-600 to-purple-800 flex items-center justify-center">
                            <svg class="w-16 h-16 text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                            </svg>
                        </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $inscription->event->title ?? 'Evento' }}</h3>

                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1">
                                <span class="font-semibold">Ingresso:</span> {{ $inscription->ticket->type ?? 'N/A' }}
                            </p>
                            <p class="text-sm text-gray-600 mb-1">
                                <span class="font-semibold">Status:</span>
                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                                    {{ $inscription->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($inscription->status) }}
                                </span>
                            </p>
                        </div>

                        <a href="{{ route('inscriptions.show', $inscription->id) }}"
                           class="block w-full bg-purple-600 text-white text-center py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
                            Ver Detalhes
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
