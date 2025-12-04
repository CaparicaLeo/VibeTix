<nav x-data="{ open: false }" class="bg-purple-700 border-b border-purple-600">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('events.index') }}" class="text-white text-2xl font-bold italic">
                        Vibe<span class="font-normal">Tix</span>
                    </a>
                </div>
            </div>

            <!-- Right Side Navigation -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-purple-700 bg-white hover:bg-purple-50 transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-white font-medium hover:text-purple-200 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-white text-purple-700 font-medium rounded-md hover:bg-purple-50 transition">
                        Registrar
                    </a>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-purple-200 hover:bg-purple-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <!-- Search Bar (Mobile) -->
        <div class="px-4 py-3 border-t border-purple-600">
            <div class="relative">
                <input type="text" placeholder="Buscar artistas e eventos"
                    class="w-full px-4 py-2 pl-10 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-300 placeholder-gray-400">
                <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <div class="pt-2 pb-3 space-y-1 border-t border-purple-600">
            <x-responsive-nav-link :href="route('events.index')" class="text-white hover:bg-purple-600">
                Eventos
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-purple-600">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-purple-200">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:bg-purple-600">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-white hover:bg-purple-600">
                            {{ __('Sair') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <div class="font-medium text-base text-white">Visitante</div>
                    <div class="font-medium text-sm text-purple-200">Acesse sua conta</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')" class="text-white hover:bg-purple-600">
                        Login
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="text-white hover:bg-purple-600">
                        Registrar
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
