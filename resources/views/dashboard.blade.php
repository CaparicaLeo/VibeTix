@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Welcome Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">Bem-vindo, {{ Auth::user()->name }}!</h1>
        <p class="text-purple-200">Gerencie seus eventos e inscrições</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card: Meus Eventos -->
        <a href="{{ route('inscriptions.index') }}" class="bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition transform hover:scale-105">
            <div class="flex items-center mb-4">
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Meus Ingressos</h3>
            <p class="text-gray-600 text-sm">Ver todos os eventos nos quais estou inscrito</p>
        </a>

        <!-- Card: Buscar Eventos -->
        <a href="{{ route('events.index') }}" class="bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition transform hover:scale-105">
            <div class="flex items-center mb-4">
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Buscar Eventos</h3>
            <p class="text-gray-600 text-sm">Descubra novos eventos para participar</p>
        </a>

        <!-- Card: Perfil -->
        <a href="{{ route('profile.edit') }}" class="bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition transform hover:scale-105">
            <div class="flex items-center mb-4">
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Meu Perfil</h3>
            <p class="text-gray-600 text-sm">Editar informações pessoais e senha</p>
        </a>
    </div>

    @if(Auth::user()->role === 'organizer')
    <!-- Organizer Section -->
    <div class="bg-gradient-to-r from-purple-700 to-purple-600 rounded-xl p-8 shadow-2xl mb-8">
        <h2 class="text-3xl font-bold text-white mb-4">Painel do Organizador</h2>
        <p class="text-purple-100 mb-6">Gerencie seus eventos e acompanhe as inscrições</p>
        <a href="{{ route('organizer.events.create') }}" class="inline-block bg-white text-purple-600 px-6 py-3 rounded-lg font-bold hover:bg-purple-50 transition shadow-lg">
            + Criar Novo Evento
        </a>
    </div>
    @endif

    <!-- Quick Stats -->
    <div class="bg-white rounded-xl p-8 shadow-lg">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Estatísticas Rápidas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-center">
                <div class="bg-green-100 p-4 rounded-full mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Conta ativa desde</p>
                    <p class="text-xl font-bold text-gray-900">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="bg-blue-100 p-4 rounded-full mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Tipo de conta</p>
                    <p class="text-xl font-bold text-gray-900">{{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
