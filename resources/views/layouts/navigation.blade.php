<nav x-data="{ open: false }" class="bg-gradient-to-r from-purple-600 to-purple-700 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('events.index') }}" class="flex items-center">
                    <span class="text-white text-2xl font-bold italic">Vibe</span>
                    <span class="text-white text-2xl font-bold">Tix</span>
                </a>
            </div>

            <!-- Search Bar (Desktop) -->
            <div class="hidden md:flex flex-1 max-w-md mx-8">
                <div class="relative w-full">
                    <input type="text"
                           placeholder="Buscar artistas e eventos"
                           class="w-full px-4 py-2 pl-10 rounded-lg bg-white text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-300">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Right Side Navigation -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('events.index') }}" class="text-white hover:text-purple-200 transition">
                    Eventos
                </a>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-white hover:text-purple-200 transition">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')">
                                Dashboard
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('inscriptions.index')">
                                Minhas Inscrições
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                Perfil
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Sair
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-purple-200 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-white text-purple-600 px-4 py-2 rounded-lg font-semibold hover:bg-purple-50 transition">
                        Cadastrar
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="open = ! open" class="text-white p-2">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden bg-purple-700">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <!-- Mobile Search -->
            <div class="mb-4">
                <input type="text"
                       placeholder="Buscar artistas e eventos"
                       class="w-full px-4 py-2 rounded-lg bg-white text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-300">
            </div>

            <a href="{{ route('events.index') }}" class="block px-3 py-2 text-white hover:bg-purple-600 rounded">
                Eventos
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-white hover:bg-purple-600 rounded">
                    Dashboard
                </a>
                <a href="{{ route('inscriptions.index') }}" class="block px-3 py-2 text-white hover:bg-purple-600 rounded">
                    Minhas Inscrições
                </a>
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-white hover:bg-purple-600 rounded">
                    Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-white hover:bg-purple-600 rounded">
                        Sair
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 text-white hover:bg-purple-600 rounded">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block px-3 py-2 text-white hover:bg-purple-600 rounded">
                    Cadastrar
                </a>
            @endauth
        </div>
    </div>
</nav>
