@extends('layouts.app')

@section('title', 'Connexion - Générateur de Fiche Technique')

@php
use Illuminate\Support\Facades\Session;
@endphp

@push('styles')
<style>
    .form-input-focus {
        transition: all 0.3s ease;
    }
    .form-input-focus:focus {
        transform: translateY(-2px);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }
    .bg-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.05'%3E%3Cpath d='M36 34h4v1h-4v-1zm0-2h1v4h-1v-4zm2-2h1v1h-1v-1zm-2 2h-1v1h1v-1zm-2-2h1v1h-1v-1zm2-2h1v1h-1v-1zm-2 2v-1h-1v1h1zm-2 2h-1v1h1v-1zm-2-2h1v1h-1v-1zm2-2h1v1h-1v-1zm-2 2v-1h-1v1h1zm-2 2h-1v1h1v-1zm-2-2h1v1h-1v-1zm2-2h1v1h-1v-1zm-2 2v-1h-1v1h1z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-in-up {
        animation: slideInUp 0.6s ease forwards;
    }
    .animate-delay-100 {
        animation-delay: 0.1s;
    }
    .animate-delay-200 {
        animation-delay: 0.2s;
    }
</style>
@endpush

@section('content')
    <div class="max-w-md mx-auto py-12 px-4 sm:px-0 animate-fade-in">
        <div class="mb-8">
            <a href="{{ url('/') }}" class="text-primary-600 hover:text-primary-700 flex items-center group transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Retour à l'accueil</span>
            </a>
        </div>

        <div class="bg-white bg-pattern rounded-2xl shadow-soft p-8 border border-dark-100/10 relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-primary-500/10 to-secondary-500/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-gradient-to-tr from-secondary-500/10 to-accent-500/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>

            <div class="relative">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-display font-bold mb-2 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent animate-slide-in-up">Connexion</h1>
                    <p class="text-dark-500 animate-slide-in-up animate-delay-100">Accédez à votre espace personnel</p>
                </div>

                @if (Session::has('temp_client_response_id'))
                    <div class="bg-accent-50 border-l-4 border-accent-400 p-4 mb-6 rounded-lg animate-slide-in-up animate-delay-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-accent-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-accent-700">
                                    <strong>Fiche technique détectée !</strong> En vous connectant, votre fiche technique sera automatiquement associée à votre compte.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 animate-slide-in-up animate-delay-200">
                        <div class="flex items-center mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-semibold">Veuillez corriger les erreurs suivantes :</span>
                        </div>
                        <ul class="list-disc list-inside pl-2 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="animate-slide-in-up animate-delay-200">
                        <label for="email" class="block text-dark-700 text-sm font-medium mb-2">
                            Adresse Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-dark-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="form-input-focus w-full pl-10 pr-4 py-3 border border-dark-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300"
                                placeholder="votre@email.com"
                            >
                        </div>
                    </div>

                    <div class="animate-slide-in-up animate-delay-300">
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-dark-700 text-sm font-medium">
                                Mot de Passe
                            </label>
                            <a href="#" class="text-xs text-primary-600 hover:text-primary-700 transition-colors duration-300">
                                Mot de passe oublié ?
                            </a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-dark-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                class="form-input-focus w-full pl-10 pr-4 py-3 border border-dark-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300"
                                placeholder="••••••••"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" id="togglePassword" class="text-dark-400 hover:text-dark-600 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center animate-slide-in-up animate-delay-400">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-dark-300 rounded transition-all duration-300"
                        >
                        <label for="remember" class="ml-2 block text-sm text-dark-600">
                            Se souvenir de moi
                        </label>
                    </div>

                    <div class="pt-2 animate-slide-in-up" style="animation-delay: 0.5s;">
                        <button
                            type="submit"
                            class="w-full flex justify-center items-center px-6 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white font-medium rounded-xl shadow-colored hover:shadow-colored-lg transform hover:-translate-y-1 transition-all duration-300"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Se connecter
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center animate-slide-in-up" style="animation-delay: 0.6s;">
                    <p class="text-dark-500 text-sm">
                        Pas encore de compte ?
                        <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-700 transition-colors duration-300">
                            Créer un compte
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        if (togglePassword && password) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Change the eye icon
                const eyeIcon = this.querySelector('svg');
                if (type === 'text') {
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    `;
                } else {
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    `;
                }
            });
        }
    });
</script>
@endpush
