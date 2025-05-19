<nav class="bg-white shadow-lg backdrop-blur-sm bg-opacity-90 sticky top-0 z-30 border-b border-gray-100">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center group">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center mr-3 shadow-lg transition-all duration-300 group-hover:shadow-indigo-500/30 group-hover:scale-110 overflow-hidden relative">
                    <!-- Animated glow effect -->
                    <div class="absolute inset-0 bg-white opacity-20 blur-xl transform scale-150 animate-pulse"></div>
                    <svg class="w-7 h-7 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="text-2xl font-display font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent tracking-tight">DevsAI</span>
            </a>

            <div class="hidden md:flex items-center space-x-1">
                <a href="#features" class="px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium transition-all duration-200 relative group">
                </a>
                <a href="#how-it-works" class="px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium transition-all duration-200 rounded-lg hover:bg-gray-50/80">
                    Comment ça marche
                </a>
                <a href="#pricing" class="px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium transition-all duration-200 rounded-lg hover:bg-gray-50/80">
                    Tarifs
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition-all duration-200 px-5 py-2.5 rounded-xl hover:bg-gray-50/80">
                    Connexion
                </a>
                <a href="{{ route('register') }}" class="relative overflow-hidden bg-gradient-to-tl from-indigo-600 via-purple-600 to-pink-500 text-white px-6 py-2.5 rounded-xl shadow-lg transition-all duration-300 hover:shadow-indigo-500/30 hover:scale-105 font-medium group">
                    <span class="relative z-10">Inscription</span>
                    <div class="absolute top-0 -inset-full h-full w-1/2 z-5 block transform -skew-x-12 bg-gradient-to-r from-transparent to-white opacity-20 group-hover:animate-shine"></div>
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile menu styles update -->
    <div class="md:hidden" x-data="{ open: false }">
        <button @click="open = !open" class="mobile-menu-button p-3 hover:bg-gray-50/80 rounded-xl transition-all duration-200">
            <svg class="h-6 w-6 text-gray-700" x-show="!open" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg class="h-6 w-6 text-gray-700" x-show="open" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="mobile-menu" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-4" style="display: none;">
            <div class="px-3 pt-3 pb-5 space-y-2 bg-white/80 backdrop-blur-lg shadow-xl rounded-2xl border border-gray-100/50 mx-3 mt-2">
                <a href="#features" class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all duration-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        Fonctionnalités
                    </div>
                </a>
                <a href="#how-it-works" class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all duration-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Comment ça marche
                    </div>
                </a>
                <a href="#pricing" class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all duration-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Tarifs
                    </div>
                </a>
                <div class="pt-2 mt-3 border-t border-gray-100 flex flex-col space-y-2">
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all duration-200">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Connexion
                        </div>
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl shadow-md transition-all duration-200 hover:shadow-indigo-500/30">
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Inscription
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    @keyframes shine {
        100% {
            left: 125%;
        }
    }

    .animate-shine {
        animation: shine 1.5s ease-in-out infinite;
    }

    .shadow-soft {
        box-shadow: 0 8px 30px -3px rgba(0, 0, 0, 0.05), 0 20px 45px -5px rgba(0, 0, 0, 0.03);
    }
</style>

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
