<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Bem-vindo de volta!</h2>
        <p class="text-gray-600 text-center mt-2">Entre na sua conta VibeTix</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" class="text-gray-700 font-semibold" />
            <x-text-input id="email"
                class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
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
                autocomplete="current-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Lembrar de mim</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-purple-600 hover:text-purple-800 font-medium transition"
                    href="{{ route('password.request') }}">
                    Esqueceu a senha?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit"
                class="w-full bg-purple-600 text-white py-3 rounded-lg font-bold text-lg hover:bg-purple-700 transition shadow-lg">
                Entrar
            </button>
        </div>

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">
                Não tem uma conta?
                <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-800 font-semibold transition">
                    Cadastre-se grátis
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
