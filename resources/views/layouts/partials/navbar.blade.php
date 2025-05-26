<nav class="bg-white shadow-md border-b border-gray-100">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <button class="md:hidden mr-3 text-dark-600 hover:text-primary-600 focus:outline-none p-2 rounded-lg hover:bg-primary-50 transition-all duration-200" id="mobileMenuButton">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Breadcrumb - only show on desktop -->
                <div class="hidden md:flex items-center">
                    <span class="text-sm text-dark-400">
                        @if(request()->routeIs('technical-sheets.*'))
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Fiches techniques
                            </span>
                        @elseif(request()->routeIs('client-response.*'))
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Nouvelle fiche
                            </span>
                        @elseif(request()->routeIs('notifications.*'))
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                Notifications
                            </span>
                        @elseif(request()->routeIs('chat.*'))
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                Assistant IA
                            </span>
                        @elseif(request()->routeIs('admin.*'))
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                </svg>
                                Tableau de bord
                            </span>
                        @endif
                    </span>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <!-- Bouton Nouvelle Fiche (visible uniquement pour les clients) -->
                @if(!Auth::user()->isAdmin())
                <a href="{{ route('client-response.form') }}" class="hidden md:flex items-center bg-gradient-to-r from-primary-600 to-secondary-600 text-white px-4 py-2 rounded-xl hover:shadow-colored transition-all duration-300 font-medium transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Nouvelle fiche</span>
                </a>
                @endif

                @if(session('success'))
                    <div class="hidden md:flex items-center bg-green-50 text-green-700 px-4 py-2 rounded-xl border border-green-200">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Chatbot -->
                <a href="{{ route('chat.index') }}" class="relative p-2 text-dark-500 hover:text-primary-600 hover:bg-primary-50 rounded-xl focus:outline-none transition-all duration-200 group" title="Assistant IA">
                    <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </a>

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
                    <button @click="open = !open" class="relative p-2 text-dark-500 hover:text-primary-600 hover:bg-primary-50 rounded-xl focus:outline-none transition-all duration-200 group">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute top-0 right-0 bg-gradient-to-r from-primary-600 to-secondary-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center shadow-sm transform translate-x-1/2 -translate-y-1/2"></span>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-[calc(100vw-2rem)] sm:w-80 bg-white rounded-xl shadow-soft py-1 z-50 border border-gray-100 max-w-sm overflow-hidden"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        style="display: none;">

                        <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-primary-50 to-secondary-50">
                            <h3 class="font-semibold text-dark-800">Notifications</h3>
                            <a href="{{ route('notifications.index') }}" class="text-sm text-primary-600 hover:text-primary-800 font-medium flex items-center px-2 py-1 rounded-lg hover:bg-white/50 transition-colors duration-200 whitespace-nowrap">
                                <span>Voir tout</span>
                                <svg class="w-4 h-4 ml-1.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>

                        <template x-if="notifications.length === 0">
                            <div class="px-4 py-8 text-sm text-dark-500 text-center">
                                <svg class="w-16 h-16 text-dark-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <p class="font-medium">Aucune notification</p>
                                <p class="text-xs text-dark-400 mt-1">Vous serez notifié lorsque vous recevrez des mises à jour</p>
                            </div>
                        </template>

                        <div class="max-h-[60vh] overflow-y-auto">
                            <template x-for="notification in notifications" :key="notification.id">
                                <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200" :class="{ 'bg-primary-50': !notification.read_at }">
                                    <div class="flex flex-col">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-dark-800 truncate" x-text="notification.data.title"></p>
                                            <p class="text-xs text-dark-500 mt-1 line-clamp-2" x-text="notification.data.message"></p>
                                            <div class="mt-2 flex items-center text-xs text-dark-400">
                                                <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span x-text="new Date(notification.created_at).toLocaleString()" class="truncate"></span>
                                            </div>
                                        </div>

                                        <div class="flex flex-wrap justify-between items-center gap-2 mt-3 pt-2 border-t border-gray-50">
                                            <template x-if="notification.data.client_response_id">
                                                <a :href="'/client-response/' + notification.data.client_response_id" class="text-xs text-primary-600 hover:text-primary-800 font-medium inline-flex items-center bg-primary-50 px-2 py-1 rounded-lg hover:bg-primary-100 transition-colors duration-200">
                                                    <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <span>Voir la fiche</span>
                                                </a>
                                            </template>

                                            <template x-if="!notification.read_at">
                                                <form :action="'/notifications/' + notification.id + '/read'" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="text-xs text-primary-600 hover:text-primary-800 font-medium inline-flex items-center bg-white border border-primary-100 px-2 py-1 rounded-lg hover:bg-primary-50 transition-colors duration-200">
                                                        <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        <span>Marquer comme lu</span>
                                                    </button>
                                                </form>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="px-4 py-3 text-center border-t border-gray-100">
                            <a href="{{ route('notifications.index') }}" class="w-full text-sm text-primary-600 hover:text-primary-800 font-medium inline-flex items-center justify-center bg-primary-50 hover:bg-primary-100 px-3 py-2 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span>Voir toutes les notifications</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-dark-700 hover:text-primary-600 focus:outline-none p-2 rounded-xl hover:bg-primary-50 transition-all duration-200 group">
                        <div class="w-9 h-9 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-xl flex items-center justify-center text-white font-semibold text-sm shadow-sm transform group-hover:scale-105 transition-all duration-200">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-medium">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-dark-500">{{ Auth::user()->role->name }}</div>
                        </div>
                        <svg class="w-4 h-4 text-dark-400 group-hover:text-primary-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-60 bg-white rounded-xl shadow-soft py-1 z-50 border border-gray-100 overflow-hidden"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        style="display: none;">

                        <div class="px-4 py-3 border-b border-gray-100 bg-gradient-to-r from-primary-50 to-secondary-50">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-xl flex items-center justify-center text-white font-semibold text-lg shadow-sm mr-3">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-dark-800">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-dark-500">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="py-1">
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-dark-700 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200 group">
                                    <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3 group-hover:bg-primary-200 transition-colors duration-200">
                                        <svg class="w-4 h-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                        </svg>
                                    </div>
                                    <span>Tableau de bord</span>
                                </a>
                            @endif

                            <a href="{{ route('technical-sheets.index') }}" class="flex items-center px-4 py-2 text-sm text-dark-700 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200 group">
                                <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3 group-hover:bg-primary-200 transition-colors duration-200">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span>Fiches techniques</span>
                            </a>

                            @if(!Auth::user()->isAdmin())
                            <a href="{{ route('client-response.form') }}" class="flex items-center px-4 py-2 text-sm text-dark-700 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200 group">
                                <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3 group-hover:bg-primary-200 transition-colors duration-200">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <span>Nouvelle fiche</span>
                            </a>
                            @endif

                            <a href="{{ route('notifications.index') }}" class="flex items-center px-4 py-2 text-sm text-dark-700 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200 group">
                                <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3 group-hover:bg-primary-200 transition-colors duration-200">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <span>Notifications</span>
                            </a>

                            <a href="{{ route('chat.index') }}" class="flex items-center px-4 py-2 text-sm text-dark-700 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200 group">
                                <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3 group-hover:bg-primary-200 transition-colors duration-200">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                </div>
                                <span>Assistant IA</span>
                            </a>
                        </div>

                        <div class="py-1 border-t border-gray-100">
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-dark-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 group">
                                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center mr-3 group-hover:bg-red-100 transition-colors duration-200">
                                        <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                    </div>
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
    <div class="md:hidden bg-green-50 border border-green-200 text-green-700 px-4 py-3 mx-4 my-3 rounded-xl flex items-center shadow-sm animate-fade-in">
        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center mr-3">
            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    </div>
@endif

<!-- Mobile error message -->
@if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 mx-4 my-3 rounded-xl flex items-center shadow-sm animate-fade-in">
        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center mr-3">
            <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <div>
            <p class="font-medium">{{ session('error') }}</p>
        </div>
    </div>
@endif

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
