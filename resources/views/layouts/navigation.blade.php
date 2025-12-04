<nav x-data="{ open: false }" class="bg-[#A855F7] border-b border-purple-500">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 sm:h-24">
            
            {{-- LADO ESQUERDO: LOGO --}}
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('events.index') }}">
                        <img src="{{ asset('images/logo.png') }}" 
                             alt="VibeTix" 
                             class="block h-9 sm:h-[150px] w-auto" />
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                @auth
                    <x-dropdown align="right" width="48">
                        
                        {{-- GATILHO (Botão "Conta") --}}
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-white hover:text-purple-100 focus:outline-none transition ease-in-out duration-150 gap-2">
                                <span class="text-base">Conta</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        {{-- CONTEÚDO DO DROPDOWN --}}
                        <x-slot name="content">
                            
                            {{-- 1. INGRESSOS (Ícone Roxo) --}}
                            <x-dropdown-link href="#" class="flex items-center gap-3 py-3 group hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                <span class="font-medium text-gray-700">Ingressos</span>
                            <x-dropdown-link :href="route('dashboard')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            {{-- 2. PEDIDOS (Ícone Roxo) --}}
                            <x-dropdown-link href="#" class="flex items-center gap-3 py-3 group hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="font-medium text-gray-700">Pedidos</span>
                            </x-dropdown-link>

                            {{-- 3. CONTA (Ícone Roxo) --}}
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-3 py-3 group hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="font-medium text-gray-700">Conta</span>
                            </x-dropdown-link>

                            <div class="border-t border-gray-200 my-1"></div>

                            {{-- 4. SAIR (Ícone Preto) --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center gap-3 py-3 group hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span class="font-medium text-black">Sair</span>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-white font-medium hover:text-purple-200 transition">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-[#A855F7] font-medium rounded-md hover:bg-purple-50 transition">Registrar</a>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-purple-200 hover:bg-purple-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        
        <div class="px-4 py-3 border-t border-purple-500">
            <div class="relative">
                <input type="text" placeholder="Buscar artistas e eventos" class="w-full px-4 py-2 pl-10 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-300 placeholder-gray-400">
                <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <div class="pt-2 pb-3 space-y-1 border-t border-purple-500">
            <x-responsive-nav-link :href="route('events.index')" class="text-white hover:bg-purple-600">Eventos</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-purple-500">
            @auth
                <div class="px-4 mb-3">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-purple-200">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link href="#" class="text-white hover:bg-purple-600 flex items-center gap-2">
                        <span>Ingressos</span>
                    </x-responsive-nav-link>
                    
                    <x-responsive-nav-link href="#" class="text-white hover:bg-purple-600 flex items-center gap-2">
                        <span>Pedidos</span>
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:bg-purple-600 flex items-center gap-2">
                        <span>Conta</span>
                    <x-responsive-nav-link :href="route('dashboard')" class="text-white hover:bg-purple-600">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:bg-purple-600">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-white hover:bg-purple-600">
                            {{ __('Sair') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')" class="text-white hover:bg-purple-600">Login</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="text-white hover:bg-purple-600">Registrar</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>