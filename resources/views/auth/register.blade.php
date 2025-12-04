<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Crie sua conta</h2>
        <p class="text-gray-600 text-center mt-2">Junte-se ao VibeTix agora</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nome completo" class="text-gray-700 font-semibold" />
            <x-text-input id="name"
                class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
                placeholder="Seu nome" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <label for="role" class="text-gray-700 font-semibold">Tipo de Conta</label>
            <select name="role" id="role"
                class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition bg-white">
                <option value="user">Usuário Padrão</option>
                <option value="organizer">Organizador de Eventos</option>
            </select>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="Email" class="text-gray-700 font-semibold" />
            <x-text-input id="email"
                class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
                placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Senha" class="text-gray-700 font-semibold" />
            <x-text-input id="password"
                class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar Senha" class="text-gray-700 font-semibold" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit"
                class="w-full bg-purple-600 text-white py-3 rounded-lg font-bold text-lg hover:bg-purple-700 transition shadow-lg">
                Criar Conta
            </button>
        </div>

        <!-- Login Link -->
        <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-800 font-semibold transition">
                    Fazer login
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
