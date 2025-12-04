@extends('layouts.app')

@section('title', 'Editar Evento')

@section('content')
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Botão Voltar -->
            <a href="{{ route('events.show', $event->id) }}" 
                class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Voltar para o evento
            </a>

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Editar Evento</h1>
                <p class="text-gray-600 mt-2">Atualize as informações do seu evento</p>
            </div>

            <!-- Card do Formulário -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                
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
                    <form action="{{ route('organizer.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Título -->
                        <div class="mb-5">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Título do Evento <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="title"
                                name="title" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Ex: Festival de Música 2025" 
                                value="{{ old('title', $event->title) }}" 
                                required>
                        </div>

                        <!-- Descrição -->
                        <div class="mb-5">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Descrição <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="description"
                                name="description" 
                                rows="5"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Descreva os detalhes do seu evento..."
                                required>{{ old('description', $event->description) }}</textarea>
                        </div>

                        <!-- Grid: Data/Hora e Local -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            
                            <!-- Data e Hora -->
                            <div>
                                <label for="date_time" class="block text-sm font-medium text-gray-700 mb-2">
                                    Data e Hora <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="datetime-local" 
                                    id="date_time"
                                    name="date_time" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    value="{{ old('date_time', \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i')) }}" 
                                    required>
                            </div>

                            <!-- Local -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                    Local <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="location"
                                    name="location" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Ex: Teatro Municipal, São Paulo" 
                                    value="{{ old('location', $event->location) }}" 
                                    required>
                            </div>

                        </div>

                        <!-- Status -->
                        <div class="mb-5">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="status"
                                name="status" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option value="scheduled" {{ old('status', $event->status) == 'scheduled' ? 'selected' : '' }}>Agendado</option>
                                <option value="active" {{ old('status', $event->status) == 'active' ? 'selected' : '' }}>Ativo</option>
                                <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                                <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Concluído</option>
                            </select>
                        </div>

                        <!-- Banner Image -->
                        <div class="mb-5">
                            <label for="banner_image" class="block text-sm font-medium text-gray-700 mb-2">
                                Banner do Evento
                            </label>
                            
                            @if($event->banner_image_url)
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 mb-2">Banner atual:</p>
                                    <img src="{{ $event->banner_image_url }}" alt="Banner atual" class="w-full h-48 object-cover rounded-lg border border-gray-300">
                                </div>
                            @endif

                            <input 
                                type="file" 
                                id="banner_image"
                                name="banner_image" 
                                accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Formatos aceitos: JPG, PNG, GIF (máx. 2MB). Deixe em branco para manter o banner atual.</p>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <a href="{{ route('events.show', $event->id) }}" 
                                class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition duration-200">
                                Cancelar
                            </a>
                            
                            <button 
                                type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition duration-200">
                                Salvar Alterações
                            </button>
                        </div>

                    </form>

                </div>

            </div>

            <!-- Card de Perigo: Deletar Evento -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border-2 border-red-100 mt-6">
                <div class="px-6 py-4 bg-red-50 border-b border-red-200">
                    <h3 class="text-lg font-semibold text-red-900">Zona de Perigo</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">
                        Excluir este evento é uma ação <strong>permanente e irreversível</strong>. Todos os ingressos e inscrições associadas serão perdidos.
                    </p>
                    <form action="{{ route('organizer.events.destroy', $event->id) }}" method="POST" 
                        onsubmit="return confirm('⚠️ ATENÇÃO! Tem certeza absoluta que deseja excluir este evento? Esta ação NÃO pode ser desfeita!');">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow transition duration-200">
                            Excluir Evento Permanentemente
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection