@extends('layouts.app')

@section('title', 'Criar Ingresso')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">

        <!-- Botão Voltar -->
        <a href="{{ route('events.show', $event->id) }}"
            class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Voltar para o evento
        </a></a>

        <!-- Card do Formulário -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-5">
                <h3 class="text-xl font-semibold text-white">
                    Criar Ingresso para: <span class="font-bold">{{ $event->title }}</span>
                </h3>
            </div>

            <!-- Body -->
            <div class="p-6">

                <!-- Mensagens de Erro -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulário -->
                <form action="{{ route('organizer.events.tickets.store', $event->id) }}" method="POST">
                    @csrf

                    <!-- Tipo do Ingresso -->
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipo do Ingresso
                        </label>
                        <input type="text" id="name" name="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Ex: Inteira, Meia, VIP, Camarote" value="{{ old('name') }}" required>
                    </div>

                    <!-- Preço -->
                    <div class="mb-5">
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                            Preço (R$)
                        </label>
                        <input type="number" id="price" step="0.01" min="0" name="price"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Ex: 50.00" value="{{ old('price') }}" required>
                    </div>

                    <!-- Quantidade -->
                    <div class="mb-6">
                        <label for="quantity_total" class="block text-sm font-medium text-gray-700 mb-2">
                            Quantidade Disponível
                        </label>
                        <input type="number" id="quantity_total" min="1" name="quantity_total"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Ex: 100" value="{{ old('quantity_total') }}" required>
                    </div>

                    <!-- Botão Submit -->
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg shadow transition duration-200">
                        Criar Ingresso
                    </button>

                </form>

            </div>

        </div>

    </div>
@endsection
