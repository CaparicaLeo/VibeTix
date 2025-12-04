@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header com saudação -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Olá, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-gray-600 mt-2">Bem-vindo de volta ao seu painel de controle</p>
            </div>

            <!-- Cards de estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <!-- Card: Eventos Disponíveis -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Eventos Disponíveis</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $eventsCount ?? 0 }}
                            </p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card: Minhas Inscrições -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Minhas Inscrições</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $inscriptionsCount ?? 0 }}
                            </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card: Eventos Organizados (apenas para organizadores) -->
                @if (auth()->user()->isOrganizer())
                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Meus Eventos</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">
                                    {{ $myEventsCount ?? 0 }}
                                </p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Card: Próximos Eventos -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-orange-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Próximos Eventos</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">
                                    {{ $upcomingCount ?? 0 }}
                                </p>
                            </div>
                            <div class="bg-orange-100 p-3 rounded-full">
                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Botão destaque: Criar Evento (apenas organizadores) -->
            @if (auth()->user()->isOrganizer())
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl shadow-lg p-6 mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-2">Crie seu próximo evento!</h2>
                            <p class="text-purple-100">Organize eventos incríveis e alcance seu público</p>
                        </div>
                        <a href="{{ route('organizer.events.create') }}"
                            class="bg-white hover:bg-gray-100 text-purple-700 font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Criar Evento
                        </a>
                    </div>
                </div>
            @endif

            <!-- Ações rápidas -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Ações Rápidas</h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ auth()->user()->isOrganizer() ? '4' : '3' }} gap-4">

                    <!-- Botão: Ver Eventos -->
                    <a href="{{ route('events.index') }}"
                        class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition duration-200">
                        <div class="bg-blue-500 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Explorar Eventos</p>
                            <p class="text-xs text-gray-600">Ver todos disponíveis</p>
                        </div>
                    </a>

                    <!-- Botão: Minhas Inscrições -->
                    <a href="{{ route('inscriptions.index') }}"
                        class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition duration-200">
                        <div class="bg-green-500 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Meus Ingressos</p>
                            <p class="text-xs text-gray-600">Ver inscrições</p>
                        </div>
                    </a>

                    @if (auth()->user()->isOrganizer())
                        <!-- Botão: Meus Eventos (organizador) -->
                        <a href="{{ route('events.index') }}"
                            class="flex items-center p-4 bg-orange-50 hover:bg-orange-100 rounded-lg transition duration-200">
                            <div class="bg-orange-500 p-2 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Gerenciar Eventos</p>
                                <p class="text-xs text-gray-600">Meus eventos</p>
                            </div>
                        </a>
                    @endif

                    <!-- Botão: Perfil -->
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center p-4 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-200">
                        <div class="bg-gray-500 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Meu Perfil</p>
                            <p class="text-xs text-gray-600">Editar informações</p>
                        </div>
                    </a>

                </div>
            </div>

            <!-- Status da conta -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-sm p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Status da Conta</h3>
                        <p class="text-blue-100 mt-1">
                            @if (auth()->user()->isOrganizer())
                                Você é um <span class="font-semibold">Organizador</span> • Pode criar e gerenciar eventos
                            @else
                                Você é um <span class="font-semibold">Participante</span> • Explore e participe de eventos
                                incríveis
                            @endif
                        </p>
                    </div>
                    <div class="hidden sm:block">
                        <svg class="w-16 h-16 text-blue-300 opacity-50" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
