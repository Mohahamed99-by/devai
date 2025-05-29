@extends('layouts.app')

@section('title', 'Notifications - Générateur de Fiche Technique')

@push('styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulseSlight {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }
    .animate-pulse-subtle {
        animation: pulseSlight 3s infinite;
    }
    .notification-card {
        transition: all 0.3s ease;
    }
    .notification-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
    }
</style>
@endpush

@section('content')
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-soft p-3 sm:p-4 md:p-6 mb-4 sm:mb-6 md:mb-8 border border-gray-100">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
            <h1 class="text-lg sm:text-xl md:text-2xl font-bold flex items-center">
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-primary-100 flex items-center justify-center mr-2 sm:mr-3">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <span class="bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Notifications</span>
            </h1>

            @if($notifications->isNotEmpty())
                <form method="POST" action="{{ route('notifications.read-all') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="bg-gradient-to-r from-primary-600 to-secondary-600 text-white px-3 sm:px-4 py-2 rounded-lg sm:rounded-xl hover:shadow-colored transition-all duration-300 w-full sm:w-auto flex items-center justify-center transform hover:-translate-y-0.5 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="hidden xs:inline">Tout marquer comme lu</span>
                        <span class="xs:hidden">Tout lire</span>
                    </button>
                </form>
            @endif
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl mb-4 sm:mb-6 flex items-center animate-fade-in">
                <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-lg bg-green-100 flex items-center justify-center mr-2 sm:mr-3 flex-shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="font-medium text-sm sm:text-base">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl mb-4 sm:mb-6 flex items-center animate-fade-in">
                <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-lg bg-red-100 flex items-center justify-center mr-2 sm:mr-3 flex-shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="font-medium text-sm sm:text-base">{{ session('error') }}</span>
            </div>
        @endif

        @if (session('info'))
            <div class="bg-blue-50 border border-blue-200 text-blue-700 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl mb-4 sm:mb-6 flex items-center animate-fade-in">
                <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-lg bg-blue-100 flex items-center justify-center mr-2 sm:mr-3 flex-shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="font-medium text-sm sm:text-base">{{ session('info') }}</span>
            </div>
        @endif

        @if($notifications->isEmpty())
            <div class="text-center py-8 sm:py-12 md:py-16 animate-fade-in">
                <div class="relative mx-auto w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 mb-4 sm:mb-6">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-100 to-secondary-100 rounded-full opacity-70 animate-pulse-subtle"></div>
                    <svg class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 mx-auto text-primary-300 relative" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl md:text-2xl font-display font-bold text-dark-700 mb-2">Aucune notification</h3>
                <p class="text-dark-500 text-sm sm:text-base max-w-xs sm:max-w-md mx-auto px-4 sm:px-0">Vous serez notifié ici lorsque vous recevrez des mises à jour concernant vos fiches techniques.</p>
                <div class="mt-6 sm:mt-8">
                    <a href="{{ route('technical-sheets.index') }}" class="inline-flex items-center px-3 sm:px-4 py-2 bg-primary-50 text-primary-600 rounded-lg sm:rounded-xl font-medium hover:bg-primary-100 transition-colors duration-200 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Voir mes fiches techniques
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-3 sm:space-y-4">
                @foreach($notifications as $notification)
                    <div class="border rounded-lg sm:rounded-xl p-3 sm:p-4 md:p-5 notification-card animate-fade-in {{ $notification->read_at ? 'bg-gray-50 border-gray-200' : 'bg-primary-50 border-primary-200' }}" style="animation-delay: {{ $loop->index * 0.05 }}s">
                        <div class="flex flex-col sm:flex-row justify-between items-start gap-3 sm:gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg {{ $notification->read_at ? 'bg-gray-100' : 'bg-primary-100' }} flex items-center justify-center mr-2 sm:mr-3 flex-shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 {{ $notification->read_at ? 'text-dark-400' : 'text-primary-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="font-semibold text-sm sm:text-base md:text-lg text-dark-800 break-words">{{ $notification->data['title'] ?? 'Notification' }}</h3>
                                        <p class="text-dark-600 mt-1 text-xs sm:text-sm md:text-base break-words">{{ $notification->data['message'] ?? 'Nouvelle notification reçue' }}</p>
                                    </div>
                                </div>

                                <div class="mt-3 sm:mt-4 flex flex-wrap items-center gap-2 sm:gap-3 ml-10 sm:ml-13">
                                    <span class="text-xs sm:text-sm text-dark-500 flex items-center bg-white/50 px-2 py-1 rounded-lg">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 text-dark-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>

                                    @if(isset($notification->data['client_response_id']))
                                        <a href="{{ url('/client-response/' . $notification->data['client_response_id']) }}" class="text-xs sm:text-sm text-primary-600 hover:text-primary-800 font-medium inline-flex items-center bg-white px-2 sm:px-3 py-1 rounded-lg hover:bg-primary-50 transition-colors duration-200 border border-primary-100">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="hidden sm:inline">Voir la fiche technique</span>
                                            <span class="sm:hidden">Voir</span>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            @if(!$notification->read_at)
                                <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="sm:self-start w-full sm:w-auto">
                                    @csrf
                                    <button type="submit" class="text-primary-600 hover:text-primary-800 bg-white border border-primary-200 hover:border-primary-300 px-2 sm:px-3 py-1.5 sm:py-2 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium inline-flex items-center justify-center transition-all duration-200 hover:shadow-sm w-full sm:w-auto">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="hidden sm:inline">Marquer comme lu</span>
                                        <span class="sm:hidden">Lu</span>
                                    </button>
                                </form>
                            @else
                                <span class="text-green-600 text-xs sm:text-sm bg-green-50 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg inline-flex items-center sm:self-start border border-green-100">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Lu
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                <div class="pagination-container">
                    {{ $notifications->links() }}
                </div>
            </div>

            <style>
                /* Amélioration du style de pagination */
                .pagination-container nav div:first-child {
                    display: none; /* Masquer le texte "Showing x to y of z results" */
                }

                .pagination-container nav span[aria-current="page"] span {
                    background: linear-gradient(to right, var(--tw-gradient-stops)) !important;
                    --tw-gradient-from: #4f46e5;
                    --tw-gradient-to: #a855f7;
                    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
                    color: white !important;
                    border: none !important;
                    border-radius: 0.75rem !important;
                    box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.1), 0 2px 4px -1px rgba(99, 102, 241, 0.06) !important;
                }

                .pagination-container nav a {
                    color: #4f46e5 !important;
                    border-radius: 0.75rem !important;
                    transition: all 0.2s ease !important;
                }

                .pagination-container nav a:hover {
                    background-color: #eef2ff !important;
                    transform: translateY(-1px) !important;
                }

                .pagination-container nav span[aria-disabled="true"] span {
                    color: #9ca3af !important;
                    border-radius: 0.75rem !important;
                }

                @media (max-width: 640px) {
                    .pagination-container nav span, .pagination-container nav a {
                        padding: 0.5rem 0.75rem !important;
                        font-size: 0.75rem !important;
                    }
                }
            </style>
        @endif
    </div>
@endsection
