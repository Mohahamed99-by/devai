@push('styles')
<style>
    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .notification-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
</style>
@endpush

<nav class="glass-effect sticky top-0 z-50 border-b border-gray-200/20 shadow-lg shadow-gray-900/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 lg:h-18">
            <div class="flex items-center space-x-4">
                <button class="lg:hidden p-2.5 text-gray-600 hover:text-primary-600 focus:outline-none rounded-xl hover:bg-primary-50/80 transition-all duration-200 group" id="mobileMenuButton">
                    <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Logo for mobile -->
                <div class="lg:hidden">
                    <img src="{{ asset('images/logo-devsai-with-icon.svg') }}" alt="DevsAI" class="h-8">
                </div>

                <!-- Breadcrumb - only show on desktop -->
                <div class="hidden lg:flex items-center">
                    <div class="flex items-center px-4 py-2 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-xl border border-primary-100/50">
                        @if(request()->routeIs('technical-sheets.*'))
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-800">Fiches techniques</span>
                            </div>
                        @elseif(request()->routeIs('client-response.*'))
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-800">Nouvelle fiche</span>
                            </div>
                        @elseif(request()->routeIs('notifications.*'))
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-800">Notifications</span>
                            </div>

                        @elseif(request()->routeIs('admin.*'))
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-800">Tableau de bord</span>
                            </div>
                        @else
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-800">Tableau de bord</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-2 lg:space-x-3">
                <!-- Bouton Nouvelle Fiche (visible uniquement pour les clients) -->
                @if(!Auth::user()->isAdmin())
                <a href="{{ route('client-response.form') }}" class="hidden lg:flex items-center bg-gradient-to-r from-primary-600 to-primary-700 text-white px-4 py-2.5 rounded-xl shadow-lg shadow-primary-600/25 hover:shadow-xl hover:shadow-primary-600/30 transition-all duration-300 font-semibold transform hover:-translate-y-0.5 group">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Nouvelle fiche</span>
                </a>
                @endif

                @if(session('success'))
                    <div class="hidden lg:flex items-center bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 px-4 py-2.5 rounded-xl border border-green-200/50 shadow-sm">
                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="font-medium">{{ session('success') }}</span>
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
                    <button @click="open = !open" class="relative p-2.5 text-gray-600 hover:text-primary-600 hover:bg-primary-50/80 rounded-xl focus:outline-none transition-all duration-200 group">
                        <div class="relative">
                            <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute -top-1 -right-1 notification-badge text-white text-xs rounded-full h-5 w-5 flex items-center justify-center shadow-lg text-[10px] font-bold min-w-[20px]"></span>
                        </div>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-3 w-[calc(100vw-1rem)] sm:w-96 lg:w-80 xl:w-96 glass-effect rounded-2xl shadow-xl shadow-gray-900/10 border border-gray-200/30 z-50 overflow-hidden"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95 translate-y-2"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 transform scale-95 translate-y-2"
                        style="display: none;">

                        <div class="px-6 py-4 border-b border-gray-200/50 bg-gradient-to-r from-primary-50 to-secondary-50">
                            <div class="flex justify-between items-center">
                                <h3 class="font-bold text-gray-800 text-lg">Notifications</h3>
                                <a href="{{ route('notifications.index') }}" class="text-sm text-primary-600 hover:text-primary-800 font-semibold flex items-center px-3 py-1.5 rounded-lg hover:bg-white/60 transition-all duration-200 group">
                                    <span class="hidden sm:inline">Voir tout</span>
                                    <span class="sm:hidden">Tout</span>
                                    <svg class="w-4 h-4 ml-1.5 group-hover:translate-x-0.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
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

                        <div class="px-6 py-4 border-t border-gray-200/50 bg-gradient-to-r from-gray-50 to-gray-100/50">
                            <a href="{{ route('notifications.index') }}" class="w-full text-sm text-primary-600 hover:text-primary-800 font-semibold inline-flex items-center justify-center bg-white hover:bg-primary-50 px-4 py-3 rounded-xl transition-all duration-200 border border-primary-100 hover:border-primary-200 shadow-sm hover:shadow-md group">
                                <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span>Voir toutes les notifications</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-3 text-gray-700 hover:text-primary-600 focus:outline-none p-2 rounded-xl hover:bg-primary-50/80 transition-all duration-200 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg transform group-hover:scale-105 transition-all duration-200">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden lg:block text-left">
                            <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 font-medium">{{ Auth::user()->role->name }}</div>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-500 transition-colors duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-3 w-72 glass-effect rounded-2xl shadow-xl shadow-gray-900/10 border border-gray-200/30 z-50 overflow-hidden"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95 translate-y-2"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 transform scale-95 translate-y-2"
                        style="display: none;">

                        <div class="px-6 py-4 border-b border-gray-200/50 bg-gradient-to-r from-primary-50 to-secondary-50">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg mr-4">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-600 truncate">{{ Auth::user()->email }}</div>
                                    <div class="text-xs text-primary-600 font-semibold mt-1">{{ Auth::user()->role->name }}</div>
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
