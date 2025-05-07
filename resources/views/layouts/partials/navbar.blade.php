<nav class="bg-white shadow-sm">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <button class="md:hidden mr-3 text-gray-600 hover:text-indigo-600 focus:outline-none" id="mobileMenuButton">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <a href="{{ url('/') }}" class="flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mr-2 shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">DevsAI</span>
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Bouton Nouvelle Fiche (visible uniquement pour les clients) -->
                @if(!Auth::user()->isAdmin())
                <a href="{{ route('client-response.form') }}" class="hidden md:flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-lg hover:shadow-md transition-all duration-200 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Nouvelle fiche</span>
                </a>
                @endif

                @if(session('success'))
                    <div class="hidden md:flex items-center bg-green-100 text-green-700 px-4 py-2 rounded-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Notifications -->
                <div class="relative" x-data="{ open: false, notifications: [], unreadCount: 0 }" x-init="
                    fetch('{{ route('notifications.latest') }}')
                        .then(response => response.json())
                        .then(data => {
                            notifications = data.notifications;
                            unreadCount = data.unreadCount;
                        });

                    // Rafraîchir les notifications toutes les 30 secondes
                    setInterval(() => {
                        fetch('{{ route('notifications.latest') }}')
                            .then(response => response.json())
                            .then(data => {
                                notifications = data.notifications;
                                unreadCount = data.unreadCount;
                            });
                    }, 30000);
                ">
                    <button @click="open = !open" class="relative p-2 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-full focus:outline-none transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute top-0 right-0 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center transform translate-x-1/2 -translate-y-1/2"></span>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl py-1 z-50 border border-gray-100" style="display: none;">
                        <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-semibold text-gray-800">Notifications</h3>
                            <a href="{{ route('notifications.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Voir tout</a>
                        </div>

                        <template x-if="notifications.length === 0">
                            <div class="px-4 py-6 text-sm text-gray-500 text-center">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <p>Aucune notification</p>
                            </div>
                        </template>

                        <template x-for="notification in notifications" :key="notification.id">
                            <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200" :class="{ 'bg-indigo-50': !notification.read_at }">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800" x-text="notification.data.title"></p>
                                        <p class="text-xs text-gray-500 mt-1" x-text="notification.data.message"></p>
                                        <div class="mt-1 flex items-center">
                                            <span class="text-xs text-gray-400" x-text="new Date(notification.created_at).toLocaleString()"></span>
                                            <template x-if="notification.data.client_response_id">
                                                <a :href="'/client-response/' + notification.data.client_response_id" class="text-xs text-indigo-600 hover:text-indigo-800 ml-2 font-medium">
                                                    Voir la fiche
                                                </a>
                                            </template>
                                        </div>
                                    </div>
                                    <template x-if="!notification.read_at">
                                        <form :action="'/notifications/' + notification.id + '/read'" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">
                                                Marquer comme lu
                                            </button>
                                        </form>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <div class="px-4 py-3 text-center border-t border-gray-100">
                            <a href="{{ route('notifications.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                Voir toutes les notifications
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600 focus:outline-none p-2 rounded-lg hover:bg-indigo-50 transition-colors duration-200">
                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-medium">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->role->name }}</div>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl py-1 z-50 border border-gray-100" style="display: none;">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="py-1">
                            <a href="{{ url('/') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Accueil</span>
                            </a>

                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                    </svg>
                                    <span>Tableau de bord</span>
                                </a>
                            @endif

                            <a href="{{ route('technical-sheets.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Fiches techniques</span>
                            </a>

                            @if(!Auth::user()->isAdmin())
                            <a href="{{ route('client-response.form') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span>Nouvelle fiche</span>
                            </a>
                            @endif

                            <a href="{{ route('notifications.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span>Notifications</span>
                            </a>
                        </div>

                        <div class="py-1 border-t border-gray-100">
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile success message -->
@if(session('success'))
    <div class="md:hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 m-4 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- Mobile error message -->
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 m-4 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <span>{{ session('error') }}</span>
    </div>
@endif

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
