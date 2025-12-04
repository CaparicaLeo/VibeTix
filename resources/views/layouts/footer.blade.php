<footer class="bg-[#A855F7] text-white py-8 mt-auto font-inter text-sm" x-data="{ open: false }">
    <div class="max-w-[1200px] mx-auto px-6">
        
        {{-- FLEX CONTAINER PRINCIPAL --}}
        <div class="flex flex-wrap md:flex-nowrap items-start justify-between gap-y-6 md:gap-10">
            
            {{-- 1. LOGO --}}
            <div class="order-1 flex-shrink-0 -mt-2">
                <a href="/" class="block hover:opacity-90 transition">
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="VibeTix" 
                         class="block h-14 md:h-28 w-auto" />
                </a>
            </div>

            {{-- 2. BOTÃO MAIS INFORMAÇÕES --}}
            <div class="order-2 md:order-3 pt-2">
                <button 
                    @click="open = !open" 
                    class="flex items-center gap-2 text-white/90 hover:text-red-300 transition font-semibold focus:outline-none"
                >
                    {{-- Texto responsivo (opcional, para economizar espaço no mobile) --}}
                    <span x-text="open ? 'Menos info' : 'Mais info'" class="md:hidden"></span>
                    <span x-text="open ? 'Menos informações' : 'Mais informações'" class="hidden md:inline"></span>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300" :class="{'rotate-180': open, 'text-red-300': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            {{-- 3. ÁREA CENTRAL / GRID --}}
            <div class="order-3 md:order-2 w-full md:w-auto md:flex-1 md:ml-10 lg:ml-20 mt-4 md:mt-2">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-4 text-left">
                    
                    {{-- COLUNA 1: SERVIÇOS --}}
                    <div class="flex flex-col">
                        <h3 class="font-bold text-base mb-3 h-6 flex items-center justify-start">Serviços</h3>
                        <div x-show="open" x-collapse x-cloak class="flex flex-col gap-3 pt-2">
                            <a href="#" class="text-white/80 hover:text-white text-xs transition">Meus Ingressos</a>
                            <a href="#" class="text-white/80 hover:text-white text-xs transition">Vender Ingressos</a>
                            <a href="#" class="text-white/80 hover:text-white text-xs transition">Organizar Evento</a>
                        </div>
                    </div>

                    {{-- COLUNA 2: AJUDA --}}
                    <div class="flex flex-col">
                        <h3 class="font-bold text-base mb-3 h-6 flex items-center justify-start">Ajuda</h3>
                        <div x-show="open" x-collapse x-cloak class="flex flex-col gap-3 pt-2">
                            <a href="#" class="text-white/80 hover:text-white text-xs transition">Central de Ajuda</a>
                            <a href="#" class="text-white/80 hover:text-white text-xs transition">Perguntas Frequentes</a>
                            <a href="#" class="text-white/80 hover:text-white text-xs transition">Privacidade</a>
                        </div>
                    </div>

                    {{-- COLUNA 3: REDES SOCIAIS --}}
                    <div class="flex flex-col">
                        <h3 class="font-bold text-base mb-3 h-6 flex items-center justify-start">Redes sociais</h3>
                        <div x-show="open" x-collapse x-cloak class="flex gap-4 justify-start pt-2">
                            <a href="#" class="text-white/80 hover:text-white transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.733.013 3.692.054 1.059.043 1.784.245 2.334.475.57.232 1.065.534 1.552 1.03.496.486.798.981 1.03 1.552.23.55.432 1.275.475 2.334.041.959.054 1.262.054 3.692 0 2.43-.013 2.733-.054 3.692-.043 1.059-.245 1.784-.475 2.334a4.147 4.147 0 01-1.03 1.552c-.486.496-.981.798-1.552 1.03-.55.23-1.275.432-2.334.475-.959.041-1.262.054-3.692.054s-2.733-.013-3.692-.054c-1.059-.043-1.784-.245-2.334-.475a4.147 4.147 0 01-1.552-1.03 4.147 4.147 0 01-1.03-1.552c-.23-.55-.432-1.275-.475-2.334-.041-.959-.054-1.262-.054-3.692 0-2.43.013-2.733.054-3.692.043-1.059.245-1.784.475-2.334a4.147 4.147 0 011.03-1.552 4.147 4.147 0 011.552-1.03c.55-.23 1.275-.432 2.334-.475.959-.041 1.262-.054 3.692-.054zm0-2c-2.47 0-2.78.013-3.753.055-1.147.048-1.984.252-2.678.53A6.143 6.143 0 001.512 3.31a6.143 6.143 0 00-.53 2.678C.013 6.22 0 6.53 0 9s.013 2.78.055 3.753c.048 1.147.252 1.984.53 2.678a6.143 6.143 0 001.267 2.43 6.143 6.143 0 002.43 1.267c.694.278 1.531.482 2.678.53.973.042 1.283.055 3.753.055s2.78-.013 3.753-.055c1.147-.048 1.984-.252 2.678-.53a6.143 6.143 0 002.43-1.267 6.143 6.143 0 001.267-2.43c.278-.694.482-1.531.53-2.678.042-.973.055-1.283.055-3.753s-.013-2.78-.055-3.753c-.048-1.147-.252-1.984-.53-2.678a6.143 6.143 0 00-1.267-2.43 6.143 6.143 0 00-2.43-1.267c-.694-.278-1.531-.482-2.678-.53C15.095.013 14.785 0 12.315 0zM6 12a6 6 0 1112 0 6 6 0 01-12 0zm0-2a4 4 0 118 0 4 4 0 01-8 0zm7.323-4.677a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd"></path></svg>
                            </a>
                            <a href="#" class="text-white/80 hover:text-white transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.235 8.235 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                            </a>
                        </div>
                    </div>

                    {{-- COLUNA 4: BAIXE O APP --}}
                    <div class="flex flex-col">
                        <h3 class="font-bold text-base mb-3 h-6 flex items-center justify-start">Baixe o App</h3>
                        <div x-show="open" x-collapse x-cloak class="flex flex-col gap-2 w-full pt-2">
                            <button class="bg-black/20 hover:bg-black/30 px-3 py-2 rounded transition flex items-center gap-2 w-full max-w-[140px] justify-start">
                                <div class="w-4 h-4 bg-white/20 rounded-full flex-shrink-0"></div>
                                <span class="text-[10px] uppercase font-semibold opacity-90">Google Play</span>
                            </button>
                            <button class="bg-black/20 hover:bg-black/30 px-3 py-2 rounded transition flex items-center gap-2 w-full max-w-[140px] justify-start">
                                <div class="w-4 h-4 bg-white/20 rounded-full flex-shrink-0"></div>
                                <span class="text-[10px] uppercase font-semibold opacity-90">App Store</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div x-show="open" x-cloak class="border-t border-white/20 mt-10 pt-6 text-center md:text-left text-white/50 text-xs">
            <span>&copy; {{ date('Y') }} VibeTix. Todos os direitos reservados.</span>
        </div>
    </div>
</footer>