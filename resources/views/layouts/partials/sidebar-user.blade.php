<div class="bg-gradient-to-b from-primary-900 to-primary-800 text-white w-64 py-6 flex-shrink-0 hidden md:block shadow-xl relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-secondary-500/10 to-accent-500/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-accent-500/10 to-secondary-500/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>

    <div class="px-6 relative">
        <div class="flex items-center mb-8">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-3 shadow-md transform transition-transform duration-300 hover:scale-105">
                <svg class="w-7 h-7 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="text-2xl font-display font-bold bg-gradient-to-r from-white to-primary-200 bg-clip-text text-transparent">DevsAI</h2>
        </div>



        <div class="mb-8">
            <div class="text-xs uppercase text-primary-300 font-semibold tracking-wider mb-3">
                Menu principal
            </div>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('technical-sheets.index') }}" class="flex items-center py-3 px-4 rounded-xl text-white hover:bg-white/10 transition-all duration-200 group {{ request()->routeIs('technical-sheets.*') ? 'bg-white/10 shadow-md' : '' }}">
                            <div class="w-9 h-9 {{ request()->routeIs('technical-sheets.*') ? 'bg-primary-600' : 'bg-primary-800/80' }} rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary-600 transition-colors duration-200 shadow-sm">
                                <svg class="w-5 h-5 {{ request()->routeIs('technical-sheets.*') ? 'text-white' : 'text-primary-200' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="font-medium">Fiches techniques</span>
                            @if(request()->routeIs('technical-sheets.*'))
                                <div class="ml-auto w-1.5 h-6 bg-gradient-to-b from-secondary-400 to-secondary-600 rounded-full"></div>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client-response.form') }}" class="flex items-center py-3 px-4 rounded-xl text-white hover:bg-white/10 transition-all duration-200 group {{ request()->routeIs('client-response.*') ? 'bg-white/10 shadow-md' : '' }}">
                            <div class="w-9 h-9 {{ request()->routeIs('client-response.*') ? 'bg-primary-600' : 'bg-primary-800/80' }} rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary-600 transition-colors duration-200 shadow-sm">
                                <svg class="w-5 h-5 {{ request()->routeIs('client-response.*') ? 'text-white' : 'text-primary-200' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <span class="font-medium">Nouvelle fiche</span>
                            @if(request()->routeIs('client-response.*'))
                                <div class="ml-auto w-1.5 h-6 bg-gradient-to-b from-secondary-400 to-secondary-600 rounded-full"></div>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('notifications.index') }}" class="flex items-center py-3 px-4 rounded-xl text-white hover:bg-white/10 transition-all duration-200 group {{ request()->routeIs('notifications.*') ? 'bg-white/10 shadow-md' : '' }}">
                            <div class="w-9 h-9 {{ request()->routeIs('notifications.*') ? 'bg-primary-600' : 'bg-primary-800/80' }} rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary-600 transition-colors duration-200 shadow-sm">
                                <svg class="w-5 h-5 {{ request()->routeIs('notifications.*') ? 'text-white' : 'text-primary-200' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                            <span class="font-medium">Notifications</span>
                            @if(request()->routeIs('notifications.*'))
                                <div class="ml-auto w-1.5 h-6 bg-gradient-to-b from-secondary-400 to-secondary-600 rounded-full"></div>
                            @endif
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="pt-6 mt-6 border-t border-primary-700/50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full py-3 px-4 rounded-xl text-white hover:bg-white/10 transition-all duration-200 group">
                    <div class="w-9 h-9 bg-red-500/20 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-500/30 transition-colors duration-200 shadow-sm">
                        <svg class="w-5 h-5 text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <span class="font-medium">Déconnexion</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Mobile sidebar toggle -->
<div class="md:hidden fixed bottom-6 right-6 z-50">
    <button id="userSidebarToggle" class="bg-gradient-to-r from-primary-600 to-secondary-600 text-white p-4 rounded-full shadow-xl hover:shadow-colored-lg transition-all duration-300 transform hover:scale-105 pulse-animation">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<!-- Mobile sidebar -->
<div id="userMobileSidebar" class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm z-40 hidden">
    <div class="bg-gradient-to-b from-primary-900 to-primary-800 text-white w-80 min-h-screen py-6 transform -translate-x-full transition-transform duration-300 shadow-2xl relative overflow-hidden" id="userSidebarContent">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-secondary-500/10 to-accent-500/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-accent-500/10 to-secondary-500/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>

        <div class="px-6 relative">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-3 shadow-md transform transition-transform duration-300 hover:scale-105">
                        <svg class="w-7 h-7 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-display font-bold bg-gradient-to-r from-white to-primary-200 bg-clip-text text-transparent">DevsAI</h2>
                </div>
                <button id="userCloseSidebar" class="text-white p-2 rounded-lg hover:bg-white/10 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- User profile section -->
            <div class="mb-8 bg-white/5 rounded-2xl p-4 backdrop-blur-sm border border-white/10">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-400 to-secondary-400 flex items-center justify-center text-white font-bold text-xl shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <div class="font-medium text-white truncate max-w-[180px]">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-primary-200 truncate max-w-[180px]">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <div class="text-xs uppercase text-primary-300 font-semibold tracking-wider mb-3">
                    Menu principal
                </div>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('technical-sheets.index') }}" class="flex items-center py-3 px-4 rounded-xl text-white hover:bg-white/10 transition-all duration-200 group {{ request()->routeIs('technical-sheets.*') ? 'bg-white/10 shadow-md' : '' }}">
                                <div class="w-9 h-9 {{ request()->routeIs('technical-sheets.*') ? 'bg-primary-600' : 'bg-primary-800/80' }} rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary-600 transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5 {{ request()->routeIs('technical-sheets.*') ? 'text-white' : 'text-primary-200' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="font-medium">Fiches techniques</span>
                                @if(request()->routeIs('technical-sheets.*'))
                                    <div class="ml-auto w-1.5 h-6 bg-gradient-to-b from-secondary-400 to-secondary-600 rounded-full"></div>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('client-response.form') }}" class="flex items-center py-3 px-4 rounded-xl text-white hover:bg-white/10 transition-all duration-200 group {{ request()->routeIs('client-response.*') ? 'bg-white/10 shadow-md' : '' }}">
                                <div class="w-9 h-9 {{ request()->routeIs('client-response.*') ? 'bg-primary-600' : 'bg-primary-800/80' }} rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary-600 transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5 {{ request()->routeIs('client-response.*') ? 'text-white' : 'text-primary-200' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <span class="font-medium">Nouvelle fiche</span>
                                @if(request()->routeIs('client-response.*'))
                                    <div class="ml-auto w-1.5 h-6 bg-gradient-to-b from-secondary-400 to-secondary-600 rounded-full"></div>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('notifications.index') }}" class="flex items-center py-3 px-4 rounded-xl text-white hover:bg-white/10 transition-all duration-200 group {{ request()->routeIs('notifications.*') ? 'bg-white/10 shadow-md' : '' }}">
                                <div class="w-9 h-9 {{ request()->routeIs('notifications.*') ? 'bg-primary-600' : 'bg-primary-800/80' }} rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary-600 transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5 {{ request()->routeIs('notifications.*') ? 'text-white' : 'text-primary-200' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <span class="font-medium">Notifications</span>
                                @if(request()->routeIs('notifications.*'))
                                    <div class="ml-auto w-1.5 h-6 bg-gradient-to-b from-secondary-400 to-secondary-600 rounded-full"></div>
                                @endif
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="pt-6 mt-6 border-t border-primary-700/50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full py-3 px-4 rounded-xl text-white hover:bg-white/10 transition-all duration-200 group">
                        <div class="w-9 h-9 bg-red-500/20 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-500/30 transition-colors duration-200 shadow-sm">
                            <svg class="w-5 h-5 text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <span class="font-medium">Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // User Sidebar Namespace
    (function() {
        'use strict';

        document.addEventListener('DOMContentLoaded', function() {
            // User sidebar functionality
            const userSidebarToggle = document.getElementById('userSidebarToggle');
            const userMobileSidebar = document.getElementById('userMobileSidebar');
            const userSidebarContent = document.getElementById('userSidebarContent');
            const userCloseSidebar = document.getElementById('userCloseSidebar');

        // Function to open user sidebar with animation
        function openUserSidebar() {
            if (userMobileSidebar) {
                // First make the backdrop visible
                userMobileSidebar.classList.remove('hidden');

                // Then animate the sidebar after a small delay
                setTimeout(() => {
                    if (userSidebarContent) {
                        userSidebarContent.classList.remove('-translate-x-full');

                        // Add entrance animation classes to menu items
                        const menuItems = userSidebarContent.querySelectorAll('nav ul li');
                        menuItems.forEach((item, index) => {
                            item.style.opacity = '0';
                            item.style.transform = 'translateX(-20px)';

                            setTimeout(() => {
                                item.style.transition = 'all 0.3s ease';
                                item.style.opacity = '1';
                                item.style.transform = 'translateX(0)';
                            }, 100 + (index * 50));
                        });
                    }
                }, 50);
            }
        }

        // Function to close user sidebar with animation
        function closeUserSidebar() {
            if (userSidebarContent) {
                // First animate the sidebar out
                userSidebarContent.classList.add('-translate-x-full');

                // Then hide the backdrop after animation completes
                setTimeout(() => {
                    if (userMobileSidebar) {
                        userMobileSidebar.classList.add('hidden');
                    }
                }, 300);
            }
        }

        // Event listeners for user sidebar
        if (userSidebarToggle) {
            userSidebarToggle.addEventListener('click', openUserSidebar);
        }

        if (userCloseSidebar) {
            userCloseSidebar.addEventListener('click', function() {
                closeUserSidebar();
            });
        }

        if (userMobileSidebar) {
            userMobileSidebar.addEventListener('click', function(e) {
                if (e.target === userMobileSidebar) {
                    closeUserSidebar();
                }
            });
        }

        // Add active menu item highlight
        const currentPath = window.location.pathname;
        const menuLinks = document.querySelectorAll('nav a');

        menuLinks.forEach(link => {
            const linkPath = link.getAttribute('href').split('?')[0]; // Remove query params
            if (currentPath === linkPath ||
                (linkPath !== '/' && currentPath.startsWith(linkPath))) {
                link.classList.add('active');
            }
        });
        });
    })(); // Fin du namespace User Sidebar
</script>
@endpush
