<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DevsAI - Générateur de Fiche Technique')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans antialiased">
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
        @include('layouts.partials.footer')
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
