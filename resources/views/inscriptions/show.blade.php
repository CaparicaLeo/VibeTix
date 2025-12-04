@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-purple-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        
        {{-- Botão Voltar --}}
        <div class="mb-6">
            <a 
                href="{{ route('inscriptions.index') }}" 
                class="inline-flex items-center text-gray-600 hover:text-purple-600 transition-colors font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Voltar para Minhas Inscrições
            </a>
        </div>

        {{-- Card Principal do Ingresso --}}
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            
            {{-- Header com Gradiente --}}
            <div class="relative h-48 bg-gradient-to-br from-purple-600 via-purple-700 to-purple-800 p-8">
                {{-- Padrão decorativo --}}
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-0 w-full h-full" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,.1) 10px, rgba(255,255,255,.1) 20px);"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-3xl font-bold text-white">
                            <span class="italic">Vibe</span><span class="font-normal">Tix</span>
                        </h1>
                        
                        {{-- Badge de Status --}}
                        @php
                            $statusConfig = [
                                'pending' => ['bg' => 'bg-yellow-500', 'text' => 'Pendente', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'confirmed' => ['bg' => 'bg-green-500', 'text' => 'Confirmado', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'cancelled' => ['bg' => 'bg-red-500', 'text' => 'Cancelado', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ];
                            $status = $statusConfig[$inscription->status] ?? ['bg' => 'bg-gray-500', 'text' => ucfirst($inscription->status), 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
                        @endphp
                        <span class="{{ $status['bg'] }} text-white px-4 py-2 rounded-full text-sm font-bold flex items-center shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $status['icon'] }}"/>
                            </svg>
                            {{ $status['text'] }}
                        </span>
                    </div>
                    
                    <h2 class="text-white text-2xl font-bold">Ingresso Digital</h2>
                    <p class="text-purple-200 text-sm mt-1">ID: #{{ str_pad($inscription->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            {{-- Conteúdo Principal --}}
            <div class="p-8">
                
                {{-- Informações do Evento --}}
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-7 h-7 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $inscription->event->title ?? '—' }}
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Tipo de Ticket --}}
                        <div class="bg-purple-50 rounded-xl p-5 border-2 border-purple-100">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600 font-medium">Tipo de Ingresso</p>
                                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $inscription->ticket->name ?? '—' }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Data do Evento --}}
                        @if($inscription->event->date_time ?? false)
                            <div class="bg-blue-50 rounded-xl p-5 border-2 border-blue-100">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm text-gray-600 font-medium">Data do Evento</p>
                                        <p class="text-lg font-bold text-gray-900 mt-1">
                                            {{ \Carbon\Carbon::parse($inscription->event->date_time)->format('d/m/Y') }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($inscription->event->date_time)->format('H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Local do Evento --}}
                        @if($inscription->event->location ?? false)
                            <div class="bg-green-50 rounded-xl p-5 border-2 border-green-100">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm text-gray-600 font-medium">Local</p>
                                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $inscription->event->location }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Preço do Ticket --}}
                        @if(isset($inscription->ticket->price))
                            <div class="bg-amber-50 rounded-xl p-5 border-2 border-amber-100">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm text-gray-600 font-medium">Valor</p>
                                        <p class="text-lg font-bold text-gray-900 mt-1">
                                            R$ {{ number_format($inscription->ticket->price, 2, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Seção QR Code --}}
                <div class="border-t-2 border-dashed border-gray-200 pt-8">
                    <div class="text-center">
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Seu QR Code de Acesso</h4>
                        <p class="text-gray-600 mb-6">Apresente este código na entrada do evento</p>
                        
                        {{-- Container do QR Code --}}
                        <div class="inline-block bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-2xl shadow-lg">
                            <div class="bg-white p-6 rounded-xl shadow-inner">
                                {{-- Aqui você pode usar uma biblioteca de QR Code como SimpleSoftwareIO/simple-qrcode --}}
                                <div id="qrcode" class="inline-block"></div>
                                
                                {{-- Fallback: Código em texto --}}
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                    <p class="text-xs text-gray-500 mb-1">Código</p>
                                    <p class="text-2xl font-mono font-bold text-gray-900 tracking-wider">
                                        {{ $inscription->qr_code }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Informações Adicionais --}}
                        <div class="mt-6 bg-blue-50 border-2 border-blue-100 rounded-xl p-4 max-w-2xl mx-auto">
                            <div class="flex items-start text-left">
                                <svg class="w-6 h-6 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="ml-3">
                                    <p class="font-semibold text-blue-900">Importante</p>
                                    <p class="text-sm text-blue-800 mt-1">
                                        Mantenha este código seguro e não compartilhe com terceiros. 
                                        O QR Code é único e pessoal para sua entrada no evento.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botões de Ação --}}
                <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button 
                        onclick="window.print()"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transform hover:scale-105 transition-all duration-200 shadow-lg flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Imprimir Ingresso
                    </button>
                    
                    @if($inscription->event ?? false)
                        <a 
                            href="{{ route('events.show', $inscription->event->id) }}"
                            class="flex-1 px-6 py-3 border-2 border-purple-600 text-purple-600 font-semibold rounded-lg hover:bg-purple-50 transition-all duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Ver Evento Completo
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script para gerar QR Code --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    new QRCode(document.getElementById("qrcode"), {
        text: "{{ $inscription->qr_code }}",
        width: 200,
        height: 200,
        colorDark: "#7e22ce",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
</script>

{{-- Estilos para impressão --}}
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .container, .container * {
            visibility: visible;
        }
        .container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        button, a[href*="events.show"] {
            display: none !important;
        }
    }
</style>
@endsection