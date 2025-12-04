<x-auth-layout title="Login - VibeTix" subtitle="Entre na sua conta">
    
    {{-- Session Status --}}
    @if (session('status'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-sm text-green-800">{{ session('status') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <x-auth-input 
            label="Email"
            name="email"
            type="email"
            placeholder="seu@email.com"
            :required="true"
            :autofocus="true"
            autocomplete="username"
        >
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                </svg>
            </x-slot:icon>
        </x-auth-input>

        {{-- Password --}}
        <x-auth-input 
            label="Senha"
            name="password"
            type="password"
            placeholder="••••••••"
            :required="true"
            autocomplete="current-password"
        >
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </x-slot:icon>
        </x-auth-input>

        {{-- Remember Me e Forgot Password --}}
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input 
                    id="remember_me" 
                    type="checkbox"
                    class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500 cursor-pointer"
                    name="remember"
                >
                <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
            </label>

            @if (Route::has('password.request'))
                <a 
                    href="{{ route('password.request') }}"
                    class="text-sm text-purple-600 hover:text-purple-700 font-medium transition-colors">
                    Esqueceu a senha?
                </a>
            @endif
        </div>

        {{-- Submit Button --}}
        <x-auth-button>
            Entrar
        </x-auth-button>
    </form>

    <x-auth-divider />

    {{-- Link para Registro --}}
    <div class="text-center">
        <p class="text-sm text-gray-600">
            Não tem uma conta?
            <a 
                href="{{ route('register') }}"
                class="font-semibold text-purple-600 hover:text-purple-700 transition-colors">
                Cadastre-se
            </a>
        </p>
    </div>

</x-auth-layout>