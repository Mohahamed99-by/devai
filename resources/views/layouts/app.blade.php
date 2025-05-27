<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DevsAI - Générateur de Fiche Technique')</title>
    <meta name="description" content="Transformez vos idées de projet en spécifications techniques détaillées grâce à notre plateforme alimentée par l'IA">
    <meta name="theme-color" content="#4f46e5">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNGY0NmU1IiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PHBhdGggZD0iTTkuNzUgMTdMOSAyMGwtMSAxaDhsLTEtMS0uNzUtM00zIDEzaDE4TTUgMTdoMTRhMiAyIDAgMDAyLTJWNWEyIDIgMCAwMC0yLTJINWEyIDIgMCAwMC0yIDJ2MTBhMiAyIDAgMDAyIDJ6Ii8+PC9zdmc+">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Lexend:wght@100..900&family=JetBrains+Mono:wght@100..800&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Additional Styles -->
    <style>
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background: #c7d2fe;
            border-radius: 8px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #818cf8;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Selection styling */
        ::selection {
            background-color: rgba(99, 102, 241, 0.2);
        }

        /* Glass effect for modals and dropdowns */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Pagination styling */
        .pagination-container nav div:first-child {
            display: none; /* Masquer le texte "Showing x to y of z results" */
        }

        .pagination-container nav span[aria-current="page"] span {
            background-color: #4f46e5 !important;
            color: white !important;
            border-color: #4f46e5 !important;
        }

        .pagination-container nav a {
            color: #4f46e5 !important;
        }

        .pagination-container nav a:hover {
            background-color: #f3f4f6 !important;
        }

        .pagination-container nav span[aria-disabled="true"] span {
            color: #9ca3af !important;
        }

        /* Animation pour le bouton du sidebar */
        .pulse-animation {
            animation: pulse-ring 2s infinite;
        }
        @keyframes pulse-ring {
            0% {
                box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(79, 70, 229, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(79, 70, 229, 0);
            }
        }

        /* Amélioration pour les appareils mobiles */
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            h1, h2, h3 {
                word-break: break-word;
            }

            .text-truncate {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .flex-wrap-mobile {
                flex-wrap: wrap;
            }
        }

        /* Amélioration pour les très petits écrans */
        @media (max-width: 480px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .xs-hidden {
                display: none;
            }

            .xs-full-width {
                width: 100%;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-dark-50 font-sans antialiased selection:bg-primary-100 selection:text-primary-900">
    <div class="min-h-screen flex flex-col">
        @auth
            @if(Auth::user()->isAdmin())
                <div class="flex flex-1">
                    <!-- Sidebar for admin -->
                    @include('layouts.partials.sidebar')

                    <!-- Main Content -->
                    <div class="flex-1 overflow-x-hidden overflow-y-auto">
                        @include('layouts.partials.navbar')

                        <main class="container mx-auto px-6 py-8">
                            @yield('content')
                        </main>
                    </div>
                </div>
            @else
                <!-- Regular user layout -->
                <div class="flex flex-1">
                    <!-- Sidebar for regular user -->
                    @include('layouts.partials.sidebar-user')

                    <!-- Main Content -->
                    <div class="flex-1 overflow-x-hidden overflow-y-auto">

                    @include('layouts.partials.navbar')

                        <main class="container mx-auto px-6 py-8">
                            @yield('content')
                        </main>
                    </div>
                </div>
            @endif
        @else
            <!-- Guest layout -->
            @include('layouts.partials.navbar-guest')

            <main class="container mx-auto px-4 py-8 flex-1">
                @yield('content')
            </main>
        @endauth

        <!-- Footer -->
        @if(isset($showFooter) && $showFooter)
            @include('layouts.partials.footer')
        @endif
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
