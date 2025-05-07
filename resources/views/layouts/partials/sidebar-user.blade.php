<div class="bg-gradient-to-b from-indigo-900 to-indigo-800 text-white w-64 py-6 flex-shrink-0 hidden md:block">
    <div class="px-6">
        <div class="flex items-center mb-8">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold">DevsAI</h2>
        </div>
        
        <div class="mb-8">
            <div class="text-xs uppercase text-indigo-300 font-semibold tracking-wider mb-3">
                Menu principal
            </div>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ url('/') }}" class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 {{ request()->is('/') ? 'bg-white bg-opacity-10 text-white shadow-sm' : 'text-indigo-100 hover:bg-white hover:bg-opacity-10' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->is('/') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>Accueil</span>
                            @if(request()->is('/'))
                                <span class="ml-auto w-2 h-2 rounded-full bg-indigo-300"></span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client-response.my') }}" class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('client-response.my') ? 'bg-white bg-opacity-10 text-white shadow-sm' : 'text-indigo-100 hover:bg-white hover:bg-opacity-10' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('client-response.my') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Mes fiches techniques</span>
                            @if(request()->routeIs('client-response.my'))
                                <span class="ml-auto w-2 h-2 rounded-full bg-indigo-300"></span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client-response.form') }}" class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('client-response.form') ? 'bg-white bg-opacity-10 text-white shadow-sm' : 'text-indigo-100 hover:bg-white hover:bg-opacity-10' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('client-response.form') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span>Nouvelle fiche</span>
                            @if(request()->routeIs('client-response.form'))
                                <span class="ml-auto w-2 h-2 rounded-full bg-indigo-300"></span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('notifications.index') }}" class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('notifications.*') ? 'bg-white bg-opacity-10 text-white shadow-sm' : 'text-indigo-100 hover:bg-white hover:bg-opacity-10' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('notifications.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span>Notifications</span>
                            @if(request()->routeIs('notifications.*'))
                                <span class="ml-auto w-2 h-2 rounded-full bg-indigo-300"></span>
                            @endif
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        
        <div class="pt-6 mt-6 border-t border-indigo-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full py-2.5 px-4 rounded-lg text-indigo-100 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Mobile sidebar toggle -->
<div class="md:hidden fixed bottom-4 right-4 z-50">
    <button id="sidebarToggle" class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white p-3 rounded-full shadow-lg">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<!-- Mobile sidebar -->
<div id="mobileSidebar" class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm z-40 hidden">
    <div class="bg-gradient-to-b from-indigo-900 to-indigo-800 text-white w-72 min-h-screen py-6 transform -translate-x-full transition-transform duration-300" id="sidebarContent">
        <div class="px-6">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold">DevsAI</h2>
                </div>
                <button id="closeSidebar" class="text-white p-2 rounded-lg hover:bg-white hover:bg-opacity-10">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="mb-8">
                <div class="text-xs uppercase text-indigo-300 font-semibold tracking-wider mb-3">
                    Menu principal
                </div>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ url('/') }}" class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 {{ request()->is('/') ? 'bg-white bg-opacity-10 text-white shadow-sm' : 'text-indigo-100 hover:bg-white hover:bg-opacity-10' }}">
                                <svg class="w-5 h-5 mr-3 {{ request()->is('/') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Accueil</span>
                                @if(request()->is('/'))
                                    <span class="ml-auto w-2 h-2 rounded-full bg-indigo-300"></span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('client-response.my') }}" class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('client-response.my') ? 'bg-white bg-opacity-10 text-white shadow-sm' : 'text-indigo-100 hover:bg-white hover:bg-opacity-10' }}">
                                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('client-response.my') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Mes fiches techniques</span>
                                @if(request()->routeIs('client-response.my'))
                                    <span class="ml-auto w-2 h-2 rounded-full bg-indigo-300"></span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('client-response.form') }}" class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('client-response.form') ? 'bg-white bg-opacity-10 text-white shadow-sm' : 'text-indigo-100 hover:bg-white hover:bg-opacity-10' }}">
                                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('client-response.form') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span>Nouvelle fiche</span>
                                @if(request()->routeIs('client-response.form'))
                                    <span class="ml-auto w-2 h-2 rounded-full bg-indigo-300"></span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('notifications.index') }}" class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('notifications.*') ? 'bg-white bg-opacity-10 text-white shadow-sm' : 'text-indigo-100 hover:bg-white hover:bg-opacity-10' }}">
                                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('notifications.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span>Notifications</span>
                                @if(request()->routeIs('notifications.*'))
                                    <span class="ml-auto w-2 h-2 rounded-full bg-indigo-300"></span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="pt-6 mt-6 border-t border-indigo-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full py-2.5 px-4 rounded-lg text-indigo-100 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const sidebarContent = document.getElementById('sidebarContent');
        const closeSidebar = document.getElementById('closeSidebar');
        
        sidebarToggle.addEventListener('click', function() {
            mobileSidebar.classList.remove('hidden');
            setTimeout(() => {
                sidebarContent.classList.remove('-translate-x-full');
            }, 50);
        });
        
        closeSidebar.addEventListener('click', function() {
            sidebarContent.classList.add('-translate-x-full');
            setTimeout(() => {
                mobileSidebar.classList.add('hidden');
            }, 300);
        });
        
        mobileSidebar.addEventListener('click', function(e) {
            if (e.target === mobileSidebar) {
                sidebarContent.classList.add('-translate-x-full');
                setTimeout(() => {
                    mobileSidebar.classList.add('hidden');
                }, 300);
            }
        });
    });
</script>
@endpush
