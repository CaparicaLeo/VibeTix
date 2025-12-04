@extends('layouts.app')
@section('title', 'Criar Evento')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-purple-50 py-12">
        <div class="container mx-auto px-4 max-w-4xl">

            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ route('events.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-purple-600 transition-colors font-medium mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Voltar para Meus Eventos
                </a>

                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    Criar Novo Evento
                </h1>
                <p class="text-gray-600">Preencha as informações do seu evento</p>
            </div>

            {{-- Mensagens de Erro --}}
            @if ($errors->any())
                <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="ml-3 flex-1">
                            <h3 class="text-sm font-semibold text-red-800 mb-2">
                                Corrija os seguintes erros:
                            </h3>
                            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Formulário --}}
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    {{-- Título --}}
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Título do Evento
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('title') border-red-500 @enderror"
                                placeholder="Ex: Festival de Música 2025" required>
                        </div>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Descrição --}}
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Descrição
                        </label>
                        <div class="relative">
                            <textarea id="description" name="description" rows="5"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('description') border-red-500 @enderror"
                                placeholder="Descreva os detalhes do seu evento..." required>{{ old('description') }}</textarea>
                            <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                                <span id="charCount">0</span> caracteres
                            </div>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Data e Local (Grid 2 colunas) --}}
                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Data --}}
                        <div>
                            <label for="date_time" class="block text-sm font-semibold text-gray-700 mb-2">
                                Data e Hora
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="datetime-local" id="date_time" name="date_time" value="{{ old('date_time') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('date_time') border-red-500 @enderror"
                                    required>
                            </div>
                            @error('date_time')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Local --}}
                        <div>
                            <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">
                                Local
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <input type="text" id="location" name="location" value="{{ old('location') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('location') border-red-500 @enderror"
                                    placeholder="Ex: Teatro Municipal" required>
                            </div>
                            @error('location')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Banner do Evento --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Banner do Evento <span class="text-gray-500 font-normal">(opcional)</span>
                        </label>

                        {{-- Abas para escolher entre Upload ou URL --}}
                        <div class="mb-4 border-b border-gray-200">
                            <nav class="flex space-x-4" role="tablist">
                                <button type="button"
                                    class="tab-btn py-2 px-4 text-sm font-medium border-b-2 transition-colors"
                                    data-tab="upload" onclick="switchTab('upload')">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    Upload de Arquivo
                                </button>
                                <button type="button"
                                    class="tab-btn py-2 px-4 text-sm font-medium border-b-2 transition-colors"
                                    data-tab="url" onclick="switchTab('url')">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    URL da Imagem
                                </button>
                            </nav>
                        </div>

                        {{-- Conteúdo da Aba Upload --}}
                        <div id="tab-upload" class="tab-content">
                            <div
                                class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-purple-500 transition-colors">
                                <input type="file" id="banner_file" name="banner_file" accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    onchange="previewImage(this)">
                                <div class="text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm text-gray-600 mb-1">
                                        <span class="font-semibold text-purple-600">Clique para fazer upload</span> ou
                                        arraste e solte
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF até 10MB</p>
                                </div>
                            </div>

                            {{-- Preview da Imagem --}}
                            <div id="image-preview" class="hidden mt-4">
                                <div class="relative inline-block">
                                    <img id="preview-img" src="" alt="Preview"
                                        class="rounded-lg shadow-md max-h-48">
                                    <button type="button" onclick="removeImage()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <p id="file-name" class="text-sm text-gray-600 mt-2"></p>
                            </div>

                            @error('banner_file')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Conteúdo da Aba URL --}}
                        <div id="tab-url" class="tab-content hidden">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </div>
                                <input type="url" id="banner_image_url" name="banner_image_url"
                                    value="{{ old('banner_image_url') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('banner_image_url') border-red-500 @enderror"
                                    placeholder="https://exemplo.com/banner.jpg">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Insira uma URL válida de imagem para o banner do evento
                            </p>
                            @error('banner_image_url')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-3">
                            Status do Evento
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            {{-- Agendado --}}
                            <label
                                class="relative flex flex-col p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-purple-500 transition-all duration-200 has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                                <input type="radio" name="status" value="scheduled" class="sr-only peer"
                                    {{ old('status', 'scheduled') === 'scheduled' ? 'checked' : '' }}>
                                <div class="text-center">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2 peer-checked:bg-purple-600 transition-colors">
                                        <svg class="w-5 h-5 text-blue-600 peer-checked:text-white transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900">Agendado</p>
                                </div>
                            </label>

                            {{-- Em andamento --}}
                            <label
                                class="relative flex flex-col p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-purple-500 transition-all duration-200 has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                                <input type="radio" name="status" value="on going" class="sr-only peer"
                                    {{ old('status') === 'on going' ? 'checked' : '' }}>
                                <div class="text-center">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2 peer-checked:bg-purple-600 transition-colors">
                                        <svg class="w-5 h-5 text-green-600 peer-checked:text-white transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900">Em andamento</p>
                                </div>
                            </label>

                            {{-- Finalizado --}}
                            <label
                                class="relative flex flex-col p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-purple-500 transition-all duration-200 has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                                <input type="radio" name="status" value="done" class="sr-only peer"
                                    {{ old('status') === 'done' ? 'checked' : '' }}>
                                <div class="text-center">
                                    <div
                                        class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-2 peer-checked:bg-purple-600 transition-colors">
                                        <svg class="w-5 h-5 text-gray-600 peer-checked:text-white transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900">Finalizado</p>
                                </div>
                            </label>

                            {{-- Cancelado --}}
                            <label
                                class="relative flex flex-col p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-purple-500 transition-all duration-200 has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                                <input type="radio" name="status" value="cancelled" class="sr-only peer"
                                    {{ old('status') === 'cancelled' ? 'checked' : '' }}>
                                <div class="text-center">
                                    <div
                                        class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-2 peer-checked:bg-purple-600 transition-colors">
                                        <svg class="w-5 h-5 text-red-600 peer-checked:text-white transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900">Cancelado</p>
                                </div>
                            </label>
                        </div>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Botões de Ação --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-bold text-lg rounded-lg hover:from-purple-700 hover:to-purple-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Criar Evento
                        </button>

                        <a href="{{ route('events.index') }}"
                            class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script para contador de caracteres --}}
    {{-- Scripts para Upload e Preview --}}
    <script>
        // Alternar entre abas
        function switchTab(tabName) {
            // Remover classes ativas de todas as abas
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-purple-600', 'text-purple-600');
                btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700',
                    'hover:border-gray-300');
            });

            // Esconder todos os conteúdos
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Ativar aba clicada
            const activeBtn = document.querySelector(`[data-tab="${tabName}"]`);
            activeBtn.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700',
                'hover:border-gray-300');
            activeBtn.classList.add('border-purple-600', 'text-purple-600');

            // Mostrar conteúdo correspondente
            document.getElementById(`tab-${tabName}`).classList.remove('hidden');

            // Limpar o campo que não está sendo usado
            if (tabName === 'upload') {
                document.getElementById('banner_image_url').value = '';
            } else {
                document.getElementById('banner_file').value = '';
                removeImage();
            }
        }

        // Preview da imagem
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');
            const fileName = document.getElementById('file-name');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    fileName.textContent = input.files[0].name;
                    preview.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Remover imagem
        function removeImage() {
            document.getElementById('banner_file').value = '';
            document.getElementById('image-preview').classList.add('hidden');
            document.getElementById('preview-img').src = '';
            document.getElementById('file-name').textContent = '';
        }

        // Inicializar com a aba de upload ativa
        switchTab('upload');

        // Contador de caracteres (mantém o código anterior)
        const description = document.getElementById('description');
        const charCount = document.getElementById('charCount');

        function updateCharCount() {
            charCount.textContent = description.value.length;
        }

        description.addEventListener('input', updateCharCount);
        updateCharCount();
    </script>
@endsection
