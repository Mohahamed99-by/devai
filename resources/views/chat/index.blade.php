@extends('layouts.app')

@section('title', 'Assistant IA - Générateur de Fiche Technique')

@push('styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }

    .chat-card {
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }

    .chat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
        border-color: #d1d5db;
    }

    .chat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom, var(--tw-gradient-stops));
        --tw-gradient-from: #4f46e5;
        --tw-gradient-to: #a855f7;
        --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .chat-card:hover::before {
        opacity: 1;
    }

    .ai-assistant-header {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        border-bottom: 1px solid #e5e7eb;
    }

    .ai-icon {
        background: linear-gradient(to right, var(--tw-gradient-stops));
        --tw-gradient-from: #4f46e5;
        --tw-gradient-to: #a855f7;
        --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2), 0 2px 4px -1px rgba(79, 70, 229, 0.1);
        transition: all 0.3s ease;
    }

    .ai-icon:hover {
        transform: scale(1.05);
    }

    .btn-new-chat {
        background: linear-gradient(to right, var(--tw-gradient-stops));
        --tw-gradient-from: #4f46e5;
        --tw-gradient-to: #a855f7;
        --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        transition: all 0.3s ease;
    }

    .btn-new-chat:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.2), 0 4px 6px -2px rgba(79, 70, 229, 0.1);
    }

    .empty-state {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    }

    .archive-btn {
        opacity: 0;
        transition: all 0.2s ease;
        transform: translateY(5px);
    }

    .chat-card:hover .archive-btn {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 640px) {
        .archive-btn {
            opacity: 0.7;
            transform: translateY(0);
        }
    }

    .shadow-soft {
        box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-6 sm:py-8 md:py-10">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-2xl shadow-soft overflow-hidden mb-8 border border-gray-100 animate-fade-in">
            <div class="ai-assistant-header p-5 sm:p-6 md:p-7 flex flex-col sm:flex-row sm:items-center justify-between gap-4 sm:gap-0">
                <div class="flex items-center mb-4 sm:mb-0">
                    <div class="ai-icon w-12 h-12 rounded-xl flex items-center justify-center mr-4 shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-display font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Assistant IA</h1>
                        <p class="text-dark-500 text-xs sm:text-sm">Votre assistant personnel pour toutes vos questions</p>
                    </div>
                </div>

                <a href="{{ route('chat.new') }}" class="btn-new-chat text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl flex items-center justify-center shadow-md w-full sm:w-auto transform transition-all duration-300 hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">Nouvelle conversation</span>
                </a>
            </div>

            <div class="px-5 sm:px-6 md:px-7 pb-4">
                <div class="card-gradient p-4 sm:p-5 rounded-xl mb-6 relative overflow-hidden">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-primary-500/5 to-secondary-500/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl hidden sm:block"></div>

                    <p class="text-dark-700 text-sm sm:text-base relative">
                        Bienvenue dans votre assistant IA ! Posez vos questions sur la plateforme, la création de fiches techniques, ou demandez de l'aide pour comprendre les recommandations générées.
                    </p>
                </div>
            </div>

            @if($conversations->isEmpty())
                <div class="empty-state text-center py-10 sm:py-12 px-5 sm:px-8 mx-4 sm:mx-6 mb-6 rounded-xl border border-gray-200 animate-fade-in">
                    <div class="relative mx-auto w-20 h-20 mb-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-100 to-secondary-100 rounded-full opacity-70 animate-pulse"></div>
                        <div class="ai-icon w-20 h-20 mx-auto rounded-xl flex items-center justify-center relative">
                            <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-display font-bold text-dark-700 mb-2">Aucune conversation</h3>
                    <p class="text-dark-500 max-w-md mx-auto">Vous n'avez pas encore de conversations avec l'assistant IA.</p>
                    <p class="text-dark-400 text-sm mt-2 mb-6">Commencez une nouvelle conversation pour obtenir de l'aide.</p>

                    <a href="{{ route('chat.new') }}" class="btn-new-chat text-white px-5 py-3 rounded-xl inline-flex items-center justify-center shadow-md transform transition-all duration-300 hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">Démarrer une conversation</span>
                    </a>
                </div>
            @else
                <div class="px-5 sm:px-7 pb-6 sm:pb-8">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-lg font-display font-semibold text-dark-700">Vos conversations</h2>
                        <div class="text-xs text-dark-500 bg-gray-50 px-3 py-1.5 rounded-lg">
                            {{ $conversations->count() }} conversation{{ $conversations->count() > 1 ? 's' : '' }}
                        </div>
                    </div>
                    <div class="grid gap-4 sm:gap-5 grid-cols-1 md:grid-cols-2">
                        @foreach($conversations as $conversation)
                            <div class="chat-card rounded-xl overflow-hidden bg-white shadow-sm animate-fade-in" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                <a href="{{ route('chat.show', $conversation->id) }}" class="block p-4 sm:p-5 hover:bg-gray-50 transition-colors duration-200 relative">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mr-3 sm:mr-4">
                                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-semibold text-dark-800 truncate text-sm sm:text-base">{{ $conversation->title }}</h3>
                                            <p class="text-xs sm:text-sm text-dark-500 mt-1 sm:mt-1.5 line-clamp-2">
                                                {{ $conversation->latestMessage ? Str::limit($conversation->latestMessage->content, 100) : 'Aucun message' }}
                                            </p>
                                            <div class="mt-2 text-xs text-dark-400 flex items-center">
                                                <svg class="w-3 h-3 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>{{ $conversation->updated_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="absolute top-3 right-3">
                                        <form action="{{ route('chat.archive', $conversation->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="archive-btn text-dark-400 hover:text-red-500 p-1.5 bg-white rounded-lg hover:bg-red-50 transition-colors duration-200 shadow-sm" title="Archiver la conversation">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
