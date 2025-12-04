<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Esqueceu sua senha?</h2>
        <p class="text-gray-600 text-center mt-2 text-sm">
            Sem problemas! Informe seu e-mail e enviaremos um link para redefinir sua senha.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
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
                placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit"
                class="w-full bg-purple-600 text-white py-3 rounded-lg font-bold text-lg hover:bg-purple-700 transition shadow-lg">
                Enviar Link de Redefinição
            </button>
        </div>

        <!-- Back to Login -->
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-purple-600 hover:text-purple-800 font-medium transition">
                ← Voltar para o login
            </a>
        </div>
    </form>
</x-guest-layout>
