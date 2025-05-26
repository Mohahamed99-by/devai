@push('styles')
<style>
    @keyframes shine {
        to {
            background-position: 200% center;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.3s ease-out;
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>
@endpush

<nav class="glass-effect sticky top-0 z-50 border-b border-gray-200/20 shadow-lg shadow-gray-900/5" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 lg:h-20">
            <!-- Logo with Icon -->
            <a href="{{ url('/') }}" class="flex items-center group flex-shrink-0">
                <img src="{{ asset('images/logo-devsai-with-icon.svg') }}" alt="DevsAI Logo" class="h-9 sm:h-11 lg:h-12 transition-all duration-300 group-hover:scale-105 drop-shadow-sm">
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-1 xl:space-x-2">
                <a href="#how-it-works" class="relative text-gray-700 hover:text-primary-600 font-medium px-4 py-2.5 rounded-xl hover:bg-primary-50/80 transition-all duration-300 text-sm xl:text-base whitespace-nowrap group">
                    <span class="relative z-10">Comment ça marche</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-50 to-secondary-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                </a>
                <a href="#pricing" class="relative text-gray-700 hover:text-primary-600 font-medium px-4 py-2.5 rounded-xl hover:bg-primary-50/80 transition-all duration-300 text-sm xl:text-base group">
                    <span class="relative z-10">Tarifs</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-50 to-secondary-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                </a>
                <a href="{{ route('login') }}" class="relative text-gray-700 hover:text-primary-600 font-medium px-4 py-2.5 rounded-xl hover:bg-primary-50/80 transition-all duration-300 text-sm xl:text-base group">
                    <span class="relative z-10">Connexion</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-50 to-secondary-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                </a>
                <a href="{{ route('register') }}" class="group relative overflow-hidden bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-2.5 rounded-xl shadow-lg shadow-primary-600/25 hover:shadow-xl hover:shadow-primary-600/30 hover:-translate-y-0.5 transition-all duration-300 text-sm xl:text-base whitespace-nowrap font-semibold">
                    <span class="relative z-10 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Inscription
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-700 via-secondary-600 to-primary-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-[length:200%_auto] animate-shine"></div>
                </a>
            </div>

            <!-- Tablet Menu (md to lg) -->
            <div class="hidden md:flex lg:hidden items-center space-x-3">
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 font-medium px-4 py-2 rounded-xl hover:bg-primary-50/80 transition-all duration-200 text-sm">
                    Connexion
                </a>
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-5 py-2 rounded-xl shadow-lg shadow-primary-600/25 hover:shadow-xl hover:shadow-primary-600/30 transition-all duration-300 text-sm font-semibold">
                    Inscription
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="relative p-2.5 hover:bg-primary-50/80 rounded-xl transition-all duration-200 group">
                    <svg class="h-6 w-6 text-gray-700 group-hover:text-primary-600 transition-colors duration-200" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6 text-gray-700 group-hover:text-primary-600 transition-colors duration-200" x-show="mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden" x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-4">
            <div class="mx-4 mt-3 mb-4 glass-effect rounded-2xl shadow-xl shadow-gray-900/10 border border-gray-200/30 overflow-hidden animate-fade-in-up">
                <div class="px-6 py-4 space-y-1">
                    <a href="#how-it-works" @click="mobileMenuOpen = false" class="group flex items-center px-4 py-3.5 text-gray-700 hover:bg-gradient-to-r hover:from-primary-50 hover:to-secondary-50 hover:text-primary-600 rounded-xl transition-all duration-300">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 text-primary-600 mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="font-medium">Comment ça marche</span>
                    </a>
                    <a href="#pricing" @click="mobileMenuOpen = false" class="group flex items-center px-4 py-3.5 text-gray-700 hover:bg-gradient-to-r hover:from-primary-50 hover:to-secondary-50 hover:text-primary-600 rounded-xl transition-all duration-300">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 text-primary-600 mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-medium">Tarifs</span>
                    </a>
                </div>

                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100/50 border-t border-gray-200/50 space-y-3">
                    <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="group flex items-center px-4 py-3.5 text-gray-700 hover:bg-white/80 hover:text-primary-600 rounded-xl transition-all duration-300 border border-gray-200/50 hover:border-primary-200">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 text-primary-600 mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <span class="font-semibold">Connexion</span>
                    </a>
                    <a href="{{ route('register') }}" @click="mobileMenuOpen = false" class="group flex items-center justify-center px-4 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl shadow-lg shadow-primary-600/25 hover:shadow-xl hover:shadow-primary-600/30 transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span class="font-bold">Commencer maintenant</span>
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
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
@endpush