<x-auth-layout title="Cadastro - VibeTix" subtitle="Crie sua conta">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nome --}}
        <x-auth-input label="Nome" name="name" type="text" placeholder="Seu nome completo" :required="true"
            :autofocus="true" autocomplete="name">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </x-slot:icon>
        </x-auth-input>

        {{-- Email --}}
        <x-auth-input label="Email" name="email" type="email" placeholder="seu@email.com" :required="true"
            autocomplete="username">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
            </x-slot:icon>
        </x-auth-input>

        {{-- Tipo de Usuário (role) --}}
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-3">
                Tipo de Conta
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Opção: Usuário Padrão --}}
                <label
                    class="relative flex flex-col p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-purple-500 transition-all duration-200 has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                    <input type="radio" name="role" value="user" class="sr-only peer"
                        {{ old('role', 'user') === 'user' ? 'checked' : '' }} required>
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center peer-checked:bg-purple-600 transition-colors">
                            <svg class="w-6 h-6 text-blue-600 peer-checked:text-white transition-colors" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="font-semibold text-gray-900">Participante</p>
                            <p class="text-xs text-gray-500 mt-0.5">Comprar ingressos</p>
                        </div>
                        <svg class="w-5 h-5 text-purple-600 opacity-0 peer-checked:opacity-100 transition-opacity"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </label>

                {{-- Opção: Organizador --}}
                <label
                    class="relative flex flex-col p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-purple-500 transition-all duration-200 has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                    <input type="radio" name="role" value="organizer" class="sr-only peer"
                        {{ old('role') === 'organizer' ? 'checked' : '' }} required>
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center peer-checked:bg-purple-600 transition-colors">
                            <svg class="w-6 h-6 text-amber-600 peer-checked:text-white transition-colors" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="font-semibold text-gray-900">Organizador</p>
                            <p class="text-xs text-gray-500 mt-0.5">Criar eventos</p>
                        </div>
                        <svg class="w-5 h-5 text-purple-600 opacity-0 peer-checked:opacity-100 transition-opacity"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </label>
            </div>
            @error('role')
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

        {{-- Password --}}
        <x-auth-input label="Senha" name="password" type="password" placeholder="••••••••" :required="true"
            autocomplete="new-password">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </x-slot:icon>
        </x-auth-input>

        {{-- Confirm Password --}}
        <x-auth-input label="Confirmar Senha" name="password_confirmation" type="password" placeholder="••••••••"
            :required="true" autocomplete="new-password">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-slot:icon>
        </x-auth-input>

        {{-- Submit Button --}}
        <x-auth-button>
            Cadastrar
        </x-auth-button>
    </form>

    <x-auth-divider />

    {{-- Link para Login --}}
    <div class="text-center">
        <p class="text-sm text-gray-600">
            Já tem uma conta?
            <a href="{{ route('login') }}"
                class="font-semibold text-purple-600 hover:text-purple-700 transition-colors">
                Entrar
            </a>
        </p>
    </div>
</x-auth-layout>
