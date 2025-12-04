@extends('layouts.app')

@section('title', 'Criar Evento')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">Criar Novo Evento</h1>
        <p class="text-purple-200">Preencha as informações do seu evento</p>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <h3 class="text-red-800 font-semibold mb-2">Erro ao criar evento:</h3>
                    <ul class="list-disc list-inside text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-8 py-6">
            <h2 class="text-2xl font-bold text-white">Informações do Evento</h2>
        </div>

        <form action="{{ route('organizer.events.store') }}" method="POST" class="p-8">
            @csrf

            <div class="space-y-6">

                <!-- Título -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Título do Evento <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                           placeholder="Ex: Workshop de Laravel"
                           value="{{ old('title') }}"
                           required>
                </div>

                <!-- Descrição -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Descrição <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description"
                              rows="5"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition resize-none"
                              placeholder="Descreva seu evento em detalhes..."
                              required>{{ old('description') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Mínimo 50 caracteres</p>
                </div>

                <!-- Data e Hora -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Data <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local"
                               name="date_time"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                               value="{{ old('date_time') }}"
                               required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition bg-white">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Ativo</option>
                            <option value="scheduled" {{ old('status', 'scheduled') == 'scheduled' ? 'selected' : '' }}>Agendado</option>
                            <option value="on going" {{ old('status') == 'on going' ? 'selected' : '' }}>Em andamento</option>
                            <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Finalizado</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                </div>

                <!-- Local -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Local <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="location"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                           placeholder="Ex: Auditório Central - Campus CEDETEG"
                           value="{{ old('location') }}"
                           required>
                </div>

                <!-- Banner URL -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        URL do Banner <span class="text-gray-400 text-sm font-normal">(opcional)</span>
                    </label>
                    <input type="url"
                           name="banner_image_url"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                           placeholder="https://exemplo.com/imagem.jpg"
                           value="{{ old('banner_image_url') }}">
                    <p class="text-sm text-gray-500 mt-1">Cole o link de uma imagem hospedada online</p>
                </div>

            </div>

            <!-- Botões -->
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('events.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-8 py-3 bg-purple-600 text-white rounded-lg font-bold hover:bg-purple-700 transition shadow-lg">
                    Criar Evento
                </button>
            </div>
        </form>
    </div>

    <!-- Info Box -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <div class="text-sm text-blue-800">
                <p class="font-semibold mb-1">Dica:</p>
                <p>Após criar o evento, você poderá adicionar tipos de ingressos (gratuitos ou pagos) na página de detalhes do evento.</p>
            </div>
        </div>
    </div>

</div>
@endsection
