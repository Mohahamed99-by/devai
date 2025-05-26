@push('styles')
<style>
    @keyframes shine {
        to {
            background-position: 200% center;
        }
    }
</style>
@endpush

<nav class="bg-white/90 backdrop-blur-md shadow-soft sticky top-0 z-50 border-b border-dark-100/10" x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-20">
            <!-- Logo with Icon -->
            <a href="{{ url('/') }}" class="flex items-center group flex-shrink-0">
                <img src="{{ asset('images/logo-devsai-with-icon.svg') }}" alt="DevsAI Logo" class="h-8 sm:h-10 transition-all duration-300 group-hover:scale-105">
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-2 xl:space-x-6">
                <a href="#how-it-works" class="text-dark-700 hover:text-primary-600 font-medium px-3 xl:px-4 py-2 rounded-xl hover:bg-primary-50 transition-all duration-200 text-sm xl:text-base whitespace-nowrap">
                    How It Works
                </a>
                <a href="#pricing" class="text-dark-700 hover:text-primary-600 font-medium px-3 xl:px-4 py-2 rounded-xl hover:bg-primary-50 transition-all duration-200 text-sm xl:text-base">
                    Pricing
                </a>
                <a href="{{ route('login') }}" class="text-dark-700 hover:text-primary-600 font-medium px-3 xl:px-4 py-2 rounded-xl hover:bg-primary-50 transition-all duration-200 text-sm xl:text-base">
                    Login
                </a>
                <a href="{{ route('register') }}" class="group relative overflow-hidden bg-primary-600 text-white px-4 xl:px-6 py-2 rounded-xl shadow-colored hover:shadow-colored-lg hover:-translate-y-1 transition-all duration-300 text-sm xl:text-base whitespace-nowrap">
                    <span class="relative z-10">Sign Up</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-600 via-secondary-500 to-primary-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-[length:200%_auto] animate-shine"></div>
                </a>
            </div>

            <!-- Tablet Menu (md to lg) -->
            <div class="hidden md:flex lg:hidden items-center space-x-2">
                <a href="{{ route('login') }}" class="text-dark-700 hover:text-primary-600 font-medium px-3 py-2 rounded-xl hover:bg-primary-50 transition-all duration-200 text-sm">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-xl shadow-colored hover:shadow-colored-lg transition-all duration-300 text-sm">
                    Sign Up
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 hover:bg-primary-50 rounded-xl transition-all duration-200">
                    <svg class="h-6 w-6 text-dark-700" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6 text-dark-700" x-show="mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden" x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-4">
            <div class="px-4 pt-4 pb-6 mt-2 bg-white/95 backdrop-blur-lg shadow-soft rounded-3xl border border-dark-100/10 space-y-2">
                <a href="#how-it-works" class="block px-4 py-3 text-dark-700 hover:bg-primary-50 hover:text-primary-600 rounded-xl transition-all duration-200">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-primary-100 text-primary-600 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        How It Works
                    </div>
                </a>
                <a href="#pricing" class="block px-4 py-3 text-dark-700 hover:bg-primary-50 hover:text-primary-600 rounded-xl transition-all duration-200">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-primary-100 text-primary-600 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        Pricing
                    </div>
                </a>
                <div class="pt-4 mt-2 border-t border-dark-100/10 flex flex-col space-y-3">
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-dark-700 hover:bg-primary-50 hover:text-primary-600 rounded-xl transition-all duration-200">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-primary-100 text-primary-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                            </div>
                            Login
                        </div>
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 bg-primary-600 text-white rounded-xl shadow-colored hover:shadow-colored-lg transition-all duration-200">
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Sign Up
                        </div>
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