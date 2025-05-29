

<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-primary-100/50 shadow-lg shadow-primary-500/10 animate-pulse" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14 sm:h-16 md:h-18 lg:h-20">
            <!-- Logo with Icon -->
            <a href="{{ url('/') }}" class="flex items-center group flex-shrink-0">
                <img src="{{ asset('images/logo-devsai-with-icon.svg') }}" alt="DevsAI Logo" class="h-8 sm:h-9 md:h-10 lg:h-11 xl:h-12 transition-all duration-300 group-hover:scale-105 drop-shadow-lg">
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
                <a href="#how-it-works" class="relative text-gray-800 hover:text-primary-600 font-medium px-3 lg:px-4 py-2 lg:py-2.5 rounded-xl transition-all duration-300 text-xs lg:text-sm xl:text-base whitespace-nowrap group hover:bg-gradient-to-r hover:from-primary-50 hover:to-secondary-50 hover:backdrop-blur-sm hover:border hover:border-primary-200/50">
                    Comment ça marche
                </a>
                <a href="#pricing" class="relative text-gray-800 hover:text-primary-600 font-medium px-3 lg:px-4 py-2 lg:py-2.5 rounded-xl transition-all duration-300 text-xs lg:text-sm xl:text-base group hover:bg-gradient-to-r hover:from-primary-50 hover:to-secondary-50 hover:backdrop-blur-sm hover:border hover:border-primary-200/50">
                    Tarifs
                </a>
                <a href="{{ route('login') }}" class="relative text-gray-800 hover:text-primary-600 font-medium px-3 lg:px-4 py-2 lg:py-2.5 rounded-xl transition-all duration-300 text-xs lg:text-sm xl:text-base group hover:bg-gradient-to-r hover:from-primary-50 hover:to-secondary-50 hover:backdrop-blur-sm hover:border hover:border-primary-200/50">
                    Connexion
                </a>
                <a href="{{ route('register') }}" class="group relative overflow-hidden bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600 text-white px-3 md:px-4 lg:px-6 py-2 lg:py-2.5 rounded-xl shadow-lg shadow-primary-600/30 hover:shadow-xl hover:shadow-primary-600/40 hover:-translate-y-0.5 transition-all duration-300 text-xs lg:text-sm xl:text-base whitespace-nowrap font-semibold border border-white/20">
                    <span class="flex items-center">
                        <svg class="w-3 h-3 md:w-3.5 md:h-3.5 lg:w-4 lg:h-4 mr-1 md:mr-1.5 lg:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Inscription
                    </span>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center space-x-1.5 sm:space-x-2">
                <!-- Quick access buttons for small screens -->
                <a href="{{ route('login') }}" class="text-xs bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 px-2.5 sm:px-3 py-1.5 rounded-lg hover:bg-gradient-to-r hover:from-primary-50 hover:to-secondary-50 hover:text-primary-600 transition-all duration-200 xs:hidden border border-gray-200/50 backdrop-blur-sm min-h-[44px] min-w-[44px] flex items-center justify-center">
                    Connexion
                </a>
                <a href="{{ route('register') }}" class="text-xs bg-gradient-to-r from-primary-600 to-secondary-600 text-white px-2.5 sm:px-3 py-1.5 rounded-lg hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 xs:hidden shadow-lg shadow-primary-600/25 min-h-[44px] min-w-[44px] flex items-center justify-center">
                    Inscription
                </a>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="relative p-2 sm:p-2.5 hover:bg-gradient-to-r hover:from-primary-50 hover:to-secondary-50 rounded-xl transition-all duration-200 group border border-transparent hover:border-primary-200/50 backdrop-blur-sm min-h-[44px] min-w-[44px] flex items-center justify-center">
                    <svg class="h-5 w-5 sm:h-6 sm:w-6 text-gray-800 group-hover:text-primary-600 transition-colors duration-200" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-5 w-5 sm:h-6 sm:w-6 text-gray-800 group-hover:text-primary-600 transition-colors duration-200" x-show="mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden" x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-4">
            <div class="mx-3 sm:mx-4 mt-2 sm:mt-3 mb-3 sm:mb-4 bg-white/90 backdrop-blur-xl rounded-xl sm:rounded-2xl shadow-xl shadow-primary-600/10 border border-primary-200/30 overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 space-y-1">
                    <a href="#how-it-works" @click="mobileMenuOpen = false" class="group flex items-center px-3 sm:px-4 py-3 sm:py-3.5 text-gray-800 hover:bg-gradient-to-r hover:from-primary-100/80 hover:via-secondary-100/60 hover:to-primary-100/80 hover:text-primary-600 rounded-lg sm:rounded-xl transition-all duration-300 border border-transparent hover:border-primary-200/50 min-h-[44px]">
                        <div class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 text-primary-600 mr-3 sm:mr-4 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-primary-600/20 transition-all duration-300">
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="font-medium text-sm sm:text-base">Comment ça marche</span>
                    </a>
                    <a href="#pricing" @click="mobileMenuOpen = false" class="group flex items-center px-3 sm:px-4 py-3 sm:py-3.5 text-gray-800 hover:bg-gradient-to-r hover:from-primary-100/80 hover:via-secondary-100/60 hover:to-primary-100/80 hover:text-primary-600 rounded-lg sm:rounded-xl transition-all duration-300 border border-transparent hover:border-primary-200/50 min-h-[44px]">
                        <div class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 text-primary-600 mr-3 sm:mr-4 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-primary-600/20 transition-all duration-300">
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-medium text-sm sm:text-base">Tarifs</span>
                    </a>
                </div>

                <div class="px-4 sm:px-6 py-3 sm:py-4 bg-gradient-to-r from-primary-50/50 to-secondary-50/50 border-t border-primary-200/30 space-y-2 sm:space-y-3">
                    <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="group flex items-center px-3 sm:px-4 py-3 sm:py-3.5 text-gray-800 hover:bg-white/90 hover:text-primary-600 rounded-lg sm:rounded-xl transition-all duration-300 border border-primary-200/50 hover:border-primary-300 backdrop-blur-sm hover:shadow-lg hover:shadow-primary-600/10 min-h-[44px]">
                        <div class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 text-primary-600 mr-3 sm:mr-4 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-primary-600/20 transition-all duration-300">
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <span class="font-semibold text-sm sm:text-base">Connexion</span>
                    </a>
                    <a href="{{ route('register') }}" @click="mobileMenuOpen = false" class="group flex items-center justify-center px-3 sm:px-4 py-3 sm:py-4 bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600 text-white rounded-lg sm:rounded-xl shadow-lg shadow-primary-600/30 hover:shadow-xl hover:shadow-primary-600/40 transition-all duration-300 transform hover:-translate-y-0.5 border border-white/20 min-h-[44px]">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-2 sm:mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span class="font-bold text-sm sm:text-base">Commencer maintenant</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            } else {
                // Si l'élément n'existe pas sur cette page, rediriger vers la page d'accueil avec l'ancre
                window.location.href = '/' + targetId;
            }
        });
    });
</script>
@endpush