@extends('layouts.app', ['showFooter' => true])

@section('title', 'DevsAI - AI-Powered Technical Specification Generator')

@push('styles')
<style>
    .gradient-text {
        background-image: linear-gradient(135deg, #6366f1, #a855f7, #3b82f6);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        background-size: 200% auto;
        animation: gradientShift 3s ease-in-out infinite;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-10px) rotate(1deg); }
        66% { transform: translateY(5px) rotate(-1deg); }
    }

    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
        50% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.6), 0 0 60px rgba(217, 70, 239, 0.3); }
    }

    @keyframes matrix-rain {
        0% { transform: translateY(-100vh); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(100vh); opacity: 0; }
    }

    @keyframes neural-pulse {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }

    .hero-bg {
        background:
            radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(217, 70, 239, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
            linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #1e293b 75%, #0f172a 100%);
    }

    .neural-network {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .neural-node {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(99, 102, 241, 0.6);
        border-radius: 50%;
        animation: neural-pulse 2s ease-in-out infinite;
    }

    .neural-connection {
        position: absolute;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.3), transparent);
        animation: neural-pulse 3s ease-in-out infinite;
    }

    .matrix-char {
        position: absolute;
        color: rgba(99, 102, 241, 0.4);
        font-family: 'JetBrains Mono', monospace;
        font-size: 14px;
        animation: matrix-rain 8s linear infinite;
    }

    .glass-morphism {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .holographic-border {
        position: relative;
        overflow: hidden;
    }

    .holographic-border::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.4), transparent);
        animation: holographic-sweep 3s ease-in-out infinite;
    }

    @keyframes holographic-sweep {
        0% { left: -100%; }
        50% { left: 100%; }
        100% { left: 100%; }
    }

    .cyber-grid {
        background-image:
            linear-gradient(rgba(99, 102, 241, 0.1) 1px, transparent 1px),
            linear-gradient(90deg, rgba(99, 102, 241, 0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: grid-move 20s linear infinite;
    }

    @keyframes grid-move {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }

    .floating-element {
        animation: float 6s ease-in-out infinite;
    }

    .glow-effect {
        animation: pulse-glow 2s ease-in-out infinite;
    }

    /* Responsive optimizations */
    @media (max-width: 640px) {
        .hero-bg {
            min-height: 100vh;
        }

        .neural-node {
            width: 3px;
            height: 3px;
        }

        .matrix-char {
            font-size: 12px;
        }

        .floating-element {
            animation-duration: 8s;
        }

        .cyber-grid {
            background-size: 30px 30px;
        }
    }

    @media (max-width: 480px) {
        .neural-node {
            width: 2px;
            height: 2px;
        }

        .matrix-char {
            font-size: 10px;
        }

        .cyber-grid {
            background-size: 25px 25px;
        }
    }

    /* Tablet optimizations */
    @media (min-width: 641px) and (max-width: 1024px) {
        .floating-element {
            animation-duration: 7s;
        }
    }

    /* Large screen optimizations */
    @media (min-width: 1920px) {
        .neural-node {
            width: 5px;
            height: 5px;
        }

        .matrix-char {
            font-size: 16px;
        }

        .cyber-grid {
            background-size: 60px 60px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen hero-bg overflow-hidden">
        <!-- Cyber Grid Background -->
        <div class="absolute inset-0 cyber-grid opacity-30"></div>

        <!-- Neural Network Animation -->
        <div class="neural-network">
            <!-- Neural nodes will be generated by JavaScript -->
        </div>

        <!-- Matrix Rain Effect -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Matrix characters will be generated by JavaScript -->
        </div>

        <!-- Floating Geometric Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Top Left Orb -->
            <div class="absolute top-10 sm:top-20 left-5 sm:left-20 w-16 sm:w-24 md:w-32 h-16 sm:h-24 md:h-32 bg-gradient-to-br from-primary-500/20 to-secondary-500/20 rounded-full filter blur-xl floating-element" style="animation-delay: 0s;"></div>

            <!-- Top Right Orb -->
            <div class="absolute top-20 sm:top-40 right-8 sm:right-16 md:right-32 w-12 sm:w-18 md:w-24 h-12 sm:h-18 md:h-24 bg-gradient-to-br from-accent-500/25 to-primary-500/25 rounded-full filter blur-lg floating-element" style="animation-delay: 2s;"></div>

            <!-- Bottom Left Orb -->
            <div class="absolute bottom-16 sm:bottom-32 left-10 sm:left-20 md:left-40 w-20 sm:w-32 md:w-40 h-20 sm:h-32 md:h-40 bg-gradient-to-br from-secondary-500/15 to-accent-500/15 rounded-full filter blur-2xl floating-element" style="animation-delay: 4s;"></div>

            <!-- Center Orb -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 sm:w-48 md:w-64 h-32 sm:h-48 md:h-64 bg-gradient-to-br from-primary-400/10 to-secondary-400/10 rounded-full filter blur-3xl floating-element" style="animation-delay: 1s;"></div>

            <!-- Floating Tech Icons -->
            <div class="absolute top-1/4 left-1/4 floating-element hidden sm:block" style="animation-delay: 3s;">
                <div class="w-8 sm:w-10 md:w-12 h-8 sm:h-10 md:h-12 glass-morphism rounded-xl flex items-center justify-center glow-effect">
                    <svg class="w-4 sm:w-5 md:w-6 h-4 sm:h-5 md:h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <div class="absolute top-3/4 right-1/4 floating-element hidden sm:block" style="animation-delay: 5s;">
                <div class="w-8 sm:w-10 md:w-12 h-8 sm:h-10 md:h-12 glass-morphism rounded-xl flex items-center justify-center glow-effect">
                    <svg class="w-4 sm:w-5 md:w-6 h-4 sm:h-5 md:h-6 text-secondary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </div>
            </div>

            <div class="absolute top-1/2 right-1/6 floating-element hidden md:block" style="animation-delay: 1.5s;">
                <div class="w-8 sm:w-10 md:w-12 h-8 sm:h-10 md:h-12 glass-morphism rounded-xl flex items-center justify-center glow-effect">
                    <svg class="w-4 sm:w-5 md:w-6 h-4 sm:h-5 md:h-6 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-24 lg:py-32 relative z-10">
            <div class="max-w-7xl mx-auto text-center">
                <!-- AI Status Badge -->
                <div class="inline-flex items-center mb-4 sm:mb-6 md:mb-8 px-3 sm:px-4 md:px-6 py-1.5 sm:py-2 md:py-3 glass-morphism text-white text-xs sm:text-sm md:text-base font-medium rounded-full holographic-border animate-fade-in">
                    <div class="flex items-center mr-2 sm:mr-3">
                        <div class="w-2 sm:w-2.5 md:w-3 h-2 sm:h-2.5 md:h-3 bg-green-400 rounded-full animate-pulse mr-1.5 sm:mr-2"></div>
                        <div class="w-1.5 sm:w-2 md:w-2 h-1.5 sm:h-2 md:h-2 bg-primary-400 rounded-full animate-pulse mr-0.5 sm:mr-1" style="animation-delay: 0.2s;"></div>
                        <div class="w-1.5 sm:w-2 md:w-2 h-1.5 sm:h-2 md:h-2 bg-secondary-400 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                    </div>
                    <span class="bg-gradient-to-r from-green-400 to-primary-400 bg-clip-text text-transparent font-semibold">
                        Réseau Neuronal IA Actif
                    </span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-display font-black mb-4 sm:mb-6 md:mb-8 text-white leading-tight tracking-tight animate-slide-up">
                    <span class="block mb-1 sm:mb-2">Transformez vos</span>
                    <span class="gradient-text block mb-1 sm:mb-2">Idées</span>
                    <span class="block mb-1 sm:mb-2">en Spécifications</span>
                    <span class="gradient-text">Techniques Précises</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-base sm:text-lg md:text-xl lg:text-2xl mb-6 sm:mb-8 md:mb-12 text-gray-300 max-w-xs sm:max-w-2xl md:max-w-3xl lg:max-w-4xl mx-auto leading-relaxed px-2 sm:px-0 animate-slide-up" style="animation-delay: 100ms">
                    Exploitez la puissance des <span class="text-primary-400 font-semibold">réseaux de neurones IA avancés</span> pour analyser vos exigences de projet et générer des
                    <span class="text-secondary-400 font-semibold">spécifications techniques complètes et professionnelles</span> en quelques minutes.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4 md:gap-6 mb-8 sm:mb-10 md:mb-12 animate-slide-up px-4 sm:px-0" style="animation-delay: 200ms">
                    <a href="{{ route('client-response.form') }}" class="group relative overflow-hidden px-6 sm:px-8 md:px-10 py-3 sm:py-4 md:py-5 bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600 text-white font-bold rounded-xl sm:rounded-2xl transform hover:-translate-y-1 sm:hover:-translate-y-2 transition-all duration-300 shadow-xl sm:shadow-2xl hover:shadow-primary-500/50 holographic-border">
                        <div class="relative z-10 flex items-center justify-center">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2 sm:mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-sm sm:text-base md:text-lg font-semibold">Lancer l'Analyse IA</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5 ml-2 sm:ml-3 transition-transform duration-300 group-hover:translate-x-1 sm:group-hover:translate-x-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>

                    <a href="#how-it-works" class="group px-6 sm:px-8 md:px-10 py-3 sm:py-4 md:py-5 glass-morphism text-white font-semibold rounded-xl sm:rounded-2xl hover:bg-white/20 transition-all duration-300 border border-white/30 hover:border-primary-400/50">
                        <div class="flex items-center justify-center">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2 sm:mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            <span class="text-sm sm:text-base md:text-lg">Découvrir le Processus</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5 ml-2 sm:ml-3 transition-transform duration-300 group-hover:translate-y-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>
                </div>

                <!-- Tech Stack Preview -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 max-w-xs sm:max-w-lg md:max-w-2xl mx-auto animate-slide-up px-4 sm:px-0" style="animation-delay: 300ms">
                    <div class="glass-morphism rounded-lg sm:rounded-xl p-3 sm:p-4 text-center hover:bg-white/20 transition-all duration-300 group">
                        <div class="text-xl sm:text-2xl mb-1 sm:mb-2">🧠</div>
                        <div class="text-white/80 text-xs sm:text-sm font-medium group-hover:text-white">IA Neuronale</div>
                    </div>
                    <div class="glass-morphism rounded-lg sm:rounded-xl p-3 sm:p-4 text-center hover:bg-white/20 transition-all duration-300 group">
                        <div class="text-xl sm:text-2xl mb-1 sm:mb-2">⚡</div>
                        <div class="text-white/80 text-xs sm:text-sm font-medium group-hover:text-white">Ultra Rapide</div>
                    </div>
                    <div class="glass-morphism rounded-lg sm:rounded-xl p-3 sm:p-4 text-center hover:bg-white/20 transition-all duration-300 group">
                        <div class="text-xl sm:text-2xl mb-1 sm:mb-2">🎯</div>
                        <div class="text-white/80 text-xs sm:text-sm font-medium group-hover:text-white">Précision</div>
                    </div>
                    <div class="glass-morphism rounded-lg sm:rounded-xl p-3 sm:p-4 text-center hover:bg-white/20 transition-all duration-300 group">
                        <div class="text-xl sm:text-2xl mb-1 sm:mb-2">🚀</div>
                        <div class="text-white/80 text-xs sm:text-sm font-medium group-hover:text-white">Innovation</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-4 sm:bottom-6 md:bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
            <div class="w-5 sm:w-6 h-8 sm:h-10 border-2 border-white/30 rounded-full flex justify-center">
                <div class="w-0.5 sm:w-1 h-2 sm:h-3 bg-white/60 rounded-full mt-1.5 sm:mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="container mx-auto px-4 py-16 sm:py-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 max-w-6xl mx-auto">
            <div class="group relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-white border border-dark-100/10 shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 animate-slide-up">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-3xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 mb-4 sm:mb-6 rounded-2xl bg-primary-100 text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary-600">1,000+</div>
                    <div class="text-dark-600 mt-2 sm:mt-3 font-medium text-sm sm:text-base">Projects Analyzed</div>
                </div>
            </div>

            <div class="group relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-white border border-dark-100/10 shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 animate-slide-up" style="animation-delay: 100ms">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-3xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 mb-4 sm:mb-6 rounded-2xl bg-primary-100 text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary-600">99%</div>
                    <div class="text-dark-600 mt-2 sm:mt-3 font-medium text-sm sm:text-base">Satisfaction Rate</div>
                </div>
            </div>

            <div class="group relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-white border border-dark-100/10 shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 animate-slide-up" style="animation-delay: 200ms">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-3xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 mb-4 sm:mb-6 rounded-2xl bg-primary-100 text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary-600">10<span class="text-xl sm:text-2xl">min</span></div>
                    <div class="text-dark-600 mt-2 sm:mt-3 font-medium text-sm sm:text-base">Fast Analysis</div>
                </div>
            </div>

            <div class="group relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-white border border-dark-100/10 shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 animate-slide-up" style="animation-delay: 300ms">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-3xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 mb-4 sm:mb-6 rounded-2xl bg-primary-100 text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary-600">24/7</div>
                    <div class="text-dark-600 mt-2 sm:mt-3 font-medium text-sm sm:text-base">Always Available</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="how-it-works" class="container mx-auto px-4 py-16 sm:py-24 overflow-hidden">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-20">
            <div class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 bg-primary-100 text-primary-700 rounded-full text-xs sm:text-sm font-medium mb-3 sm:mb-4 animate-fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-1.5 sm:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                How It Works
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-5xl font-display font-bold mb-4 sm:mb-6 text-dark-900 animate-slide-up">From Vision to Victory in <span class="text-primary-600">3 Simple Steps</span></h2>
            <p class="text-base sm:text-lg text-dark-600 animate-slide-up" style="animation-delay: 100ms">Our intuitive AI-driven process delivers professional technical specifications, empowering you to kickstart your projects with confidence and precision.</p>
        </div>

        <div class="relative">
            <!-- Connection line -->
            <div class="absolute hidden md:block left-1/2 top-24 bottom-24 w-0.5 bg-gradient-to-b from-primary-300 via-secondary-300 to-accent-300 transform -translate-x-1/2 z-0"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-8 max-w-6xl mx-auto relative z-10">
                <div class="group relative bg-white p-6 sm:p-8 md:p-10 rounded-3xl shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 200ms">
                    <div class="absolute right-6 sm:right-8 top-6 sm:top-8 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-base sm:text-lg md:hidden">1</div>

                    <div class="hidden md:flex absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 sm:w-12 h-10 sm:h-12 rounded-full bg-white shadow-soft border border-primary-100 items-center justify-center z-20">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-base sm:text-lg">1</div>
                    </div>

                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center mb-4 sm:mb-6 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-4 text-primary-700 group-hover:text-primary-600 transition-colors duration-300">Define Your Vision</h3>
                    <p class="text-dark-600 text-sm sm:text-base">Submit your project goals and requirements through our guided, user-friendly questionnaire designed to capture all essential details.</p>
                </div>

                <div class="group relative bg-white p-6 sm:p-8 md:p-10 rounded-3xl shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 300ms">
                    <div class="absolute right-6 sm:right-8 top-6 sm:top-8 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-secondary-100 text-secondary-600 flex items-center justify-center font-bold text-base sm:text-lg md:hidden">2</div>

                    <div class="hidden md:flex absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 sm:w-12 h-10 sm:h-12 rounded-full bg-white shadow-soft border border-secondary-100 items-center justify-center z-20">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-secondary-100 text-secondary-600 flex items-center justify-center font-bold text-base sm:text-lg">2</div>
                    </div>

                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-secondary-100 text-secondary-600 rounded-2xl flex items-center justify-center mb-4 sm:mb-6 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-4 text-secondary-700 group-hover:text-secondary-600 transition-colors duration-300">AI-Powered Analysis</h3>
                    <p class="text-dark-600 text-sm sm:text-base">Our advanced AI processes your input, recommending optimal technologies and structuring your specifications with industry best practices.</p>
                </div>

                <div class="group relative bg-white p-6 sm:p-8 md:p-10 rounded-3xl shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 400ms">
                    <div class="absolute right-6 sm:right-8 top-6 sm:top-8 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-accent-100 text-accent-600 flex items-center justify-center font-bold text-base sm:text-lg md:hidden">3</div>

                    <div class="hidden md:flex absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 sm:w-12 h-10 sm:h-12 rounded-full bg-white shadow-soft border border-accent-100 items-center justify-center z-20">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-accent-100 text-accent-600 flex items-center justify-center font-bold text-base sm:text-lg">3</div>
                    </div>

                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-accent-100 text-accent-600 rounded-2xl flex items-center justify-center mb-4 sm:mb-6 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-4 text-accent-700 group-hover:text-accent-600 transition-colors duration-300">Receive Your Specs</h3>
                    <p class="text-dark-600 text-sm sm:text-base">Download a polished, professional document with tech stack, architecture, features, and accurate time and cost estimates.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-24 bg-gradient-to-br from-primary-50 to-secondary-50 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center max-w-6xl mx-auto">
                <div class="md:w-1/2 mb-16 md:mb-0 md:pr-16">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4 animate-fade-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Why DevsAI?
                    </div>
                    <h2 class="text-3xl md:text-5xl font-display font-bold mb-8 text-dark-900 animate-slide-up">
                        Elevate Your Projects with <span class="text-primary-600">AI-Driven Precision</span>
                    </h2>

                    <div class="space-y-6">
                        <div class="group flex items-start p-6 rounded-2xl bg-white/70 backdrop-blur-sm hover:bg-white hover:shadow-soft transform hover:translate-x-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 100ms">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-bold mb-2 text-dark-900 group-hover:text-primary-700 transition-colors duration-300">Save Weeks of Work</h3>
                                <p class="text-dark-600">Generate comprehensive specifications in minutes, not days, streamlining your project planning and accelerating development.</p>
                            </div>
                        </div>

                        <div class="group flex items-start p-6 rounded-2xl bg-white/70 backdrop-blur-sm hover:bg-white hover:shadow-soft transform hover:translate-x-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 200ms">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-secondary-100 text-secondary-600 rounded-xl flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-bold mb-2 text-dark-900 group-hover:text-secondary-700 transition-colors duration-300">Unmatched Accuracy</h3>
                                <p class="text-dark-600">Leverage AI trained on industry best practices for reliable, up-to-date recommendations that align with current technology trends.</p>
                            </div>
                        </div>

                        <div class="group flex items-start p-6 rounded-2xl bg-white/70 backdrop-blur-sm hover:bg-white hover:shadow-soft transform hover:translate-x-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 300ms">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-accent-100 text-accent-600 rounded-xl flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-bold mb-2 text-dark-900 group-hover:text-accent-700 transition-colors duration-300">Realistic Budgeting</h3>
                                <p class="text-dark-600">Get precise cost and timeline estimates to plan your projects with confidence and avoid unexpected overruns.</p>
                            </div>
                        </div>

                        <div class="group flex items-start p-6 rounded-2xl bg-white/70 backdrop-blur-sm hover:bg-white hover:shadow-soft transform hover:translate-x-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 400ms">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-bold mb-2 text-dark-900 group-hover:text-primary-700 transition-colors duration-300">Professional Standards</h3>
                                <p class="text-dark-600">Receive consistent, polished documentation ready for stakeholders and developers to implement with clarity.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:w-1/2 relative">
                    <!-- Decorative elements -->
                    <div class="absolute -top-16 -right-16 w-64 h-64 bg-primary-300/20 rounded-full filter blur-3xl animate-float"></div>
                    <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-secondary-300/20 rounded-full filter blur-3xl animate-float" style="animation-delay: 2s"></div>

                    <!-- Main image with 3D effect -->
                    <div class="relative z-10 animate-slide-up" style="animation-delay: 200ms">
                        <div class="relative group">
                            <!-- Shadow element for 3D effect -->
                            <div class="absolute -inset-1 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-3xl blur-lg opacity-30 group-hover:opacity-50 transition duration-1000"></div>

                            <!-- Main image container -->
                            <div class="relative overflow-hidden rounded-3xl bg-white p-2 shadow-soft-xl">
                                <div class="overflow-hidden rounded-2xl">
                                    <img
                                        src="https://images.unsplash.com/photo-1581472723648-909f4851d4ae?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                                        alt="AI Analysis Dashboard"
                                        class="w-full h-auto transform transition-transform duration-700 group-hover:scale-105"
                                    >

                                    <!-- Overlay with tech elements -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-primary-900/70 to-transparent flex items-end">
                                        <div class="p-6 text-white">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                                <span class="text-sm font-medium">AI Analysis in Progress</span>
                                            </div>
                                            <h4 class="text-xl font-bold">Technical Specification Generator</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating tech elements -->
                        <div class="absolute -top-6 -right-6 bg-white rounded-2xl shadow-soft p-4 transform rotate-3 animate-float" style="animation-delay: 1s">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-soft p-4 transform -rotate-3 animate-float" style="animation-delay: 1.5s">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-16 sm:py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-20">
                <div class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 bg-primary-100 text-primary-700 rounded-full text-xs sm:text-sm font-medium mb-3 sm:mb-4 animate-fade-in">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-1.5 sm:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tarification Simple
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-5xl font-display font-bold mb-4 sm:mb-6 text-dark-900 animate-slide-up">
                    Commencez <span class="text-primary-600">Gratuitement</span>
                </h2>
                <p class="text-base sm:text-lg text-dark-600 animate-slide-up" style="animation-delay: 100ms">
                    Générez vos premières spécifications techniques sans engagement. Découvrez la puissance de l'IA pour vos projets.
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-primary-50 to-secondary-50 rounded-3xl p-8 sm:p-12 text-center border border-primary-100 shadow-soft animate-slide-up" style="animation-delay: 200ms">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-100 text-primary-600 rounded-2xl mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>

                    <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-dark-900">Accès Gratuit</h3>
                    <p class="text-lg text-dark-600 mb-8 max-w-2xl mx-auto">
                        Testez DevsAI sans limitation. Générez des spécifications techniques professionnelles pour tous vos projets.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8 text-left">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-dark-700">Analyses illimitées</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-dark-700">Export PDF</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-dark-700">Support technique</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-dark-700">Historique des projets</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-dark-700">Mises à jour automatiques</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-dark-700">Accès 24/7</span>
                        </div>
                    </div>

                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transform hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-primary-600/25">
                        <span>Commencer Gratuitement</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="container mx-auto px-4 py-12 sm:py-20 text-center">
        <div class="max-w-4xl mx-auto bg-gradient-to-br from-blue-600 to-purple-700 rounded-2xl sm:rounded-3xl shadow-xl sm:shadow-2xl p-6 sm:p-8 md:p-12 text-white">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-6">Launch Your Next Big Idea with Precision Specs</h2>
            <p class="text-base sm:text-lg text-blue-100 mb-6 sm:mb-10 max-w-2xl mx-auto">Don’t let technical complexity slow you down. Try DevsAI today and unlock professional-grade specifications for free.</p>
            <a href="{{ route('client-response.form') }}" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-xl hover:bg-gradient-to-r hover:from-blue-600 hover:to-purple-700 transform hover:-translate-y-1 transition-all duration-300 shadow-lg">
                Get Started Now
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 ml-1.5 sm:ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Add intersection observer for animations
    document.addEventListener('DOMContentLoaded', function() {
        const animatedElements = document.querySelectorAll('.animate-slide-up, .animate-fade-in');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        animatedElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(el);
        });

        // Neural Network Animation
        function createNeuralNetwork() {
            const neuralNetwork = document.querySelector('.neural-network');
            if (!neuralNetwork) return;

            const nodes = [];
            const connections = [];
            // Responsive node count based on screen size
            const isMobile = window.innerWidth < 640;
            const isTablet = window.innerWidth < 1024;
            const nodeCount = isMobile ? 8 : isTablet ? 12 : 15;

            // Create neural nodes
            for (let i = 0; i < nodeCount; i++) {
                const node = document.createElement('div');
                node.className = 'neural-node';
                node.style.left = Math.random() * 100 + '%';
                node.style.top = Math.random() * 100 + '%';
                node.style.animationDelay = Math.random() * 2 + 's';
                neuralNetwork.appendChild(node);
                nodes.push({
                    element: node,
                    x: parseFloat(node.style.left),
                    y: parseFloat(node.style.top)
                });
            }

            // Create connections between nearby nodes
            const maxDistance = isMobile ? 25 : isTablet ? 28 : 30;
            for (let i = 0; i < nodes.length; i++) {
                for (let j = i + 1; j < nodes.length; j++) {
                    const distance = Math.sqrt(
                        Math.pow(nodes[i].x - nodes[j].x, 2) +
                        Math.pow(nodes[i].y - nodes[j].y, 2)
                    );

                    if (distance < maxDistance && Math.random() > 0.5) {
                        const connection = document.createElement('div');
                        connection.className = 'neural-connection';

                        const angle = Math.atan2(nodes[j].y - nodes[i].y, nodes[j].x - nodes[i].x);
                        const length = distance;

                        connection.style.left = nodes[i].x + '%';
                        connection.style.top = nodes[i].y + '%';
                        connection.style.width = length + 'vw';
                        connection.style.transform = `rotate(${angle}rad)`;
                        connection.style.transformOrigin = '0 50%';
                        connection.style.animationDelay = Math.random() * 3 + 's';

                        neuralNetwork.appendChild(connection);
                    }
                }
            }
        }

        // Matrix Rain Effect
        function createMatrixRain() {
            const matrixContainer = document.querySelector('.absolute.inset-0.overflow-hidden.pointer-events-none');
            if (!matrixContainer) return;

            const characters = '01アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン';
            const isMobile = window.innerWidth < 640;
            const isTablet = window.innerWidth < 1024;

            // Responsive column spacing and count
            const columnSpacing = isMobile ? 15 : isTablet ? 18 : 20;
            const columns = Math.floor(window.innerWidth / columnSpacing);
            const threshold = isMobile ? 0.8 : 0.7; // Fewer columns on mobile

            for (let i = 0; i < columns; i++) {
                if (Math.random() > threshold) {
                    const char = document.createElement('div');
                    char.className = 'matrix-char';
                    char.textContent = characters[Math.floor(Math.random() * characters.length)];
                    char.style.left = i * columnSpacing + 'px';
                    char.style.animationDelay = Math.random() * 8 + 's';
                    char.style.animationDuration = (Math.random() * 4 + 4) + 's';
                    matrixContainer.appendChild(char);
                }
            }
        }

        // Particle System
        function createParticles() {
            const heroSection = document.querySelector('.hero-bg');
            if (!heroSection) return;

            const isMobile = window.innerWidth < 640;
            const isTablet = window.innerWidth < 1024;

            // Responsive particle count
            const particleCount = isMobile ? 10 : isTablet ? 15 : 20;
            const particleSize = isMobile ? '1.5px' : '2px';

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'absolute';
                particle.style.width = particleSize;
                particle.style.height = particleSize;
                particle.style.background = `rgba(99, 102, 241, ${Math.random() * 0.5 + 0.1})`;
                particle.style.borderRadius = '50%';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animation = `float ${Math.random() * 10 + 5}s ease-in-out infinite`;
                particle.style.animationDelay = Math.random() * 5 + 's';
                particle.style.pointerEvents = 'none';
                heroSection.appendChild(particle);
            }
        }

        // Initialize all effects
        createNeuralNetwork();
        createMatrixRain();
        createParticles();

        // Recreate matrix rain periodically (less frequent on mobile)
        const isMobile = window.innerWidth < 640;
        const matrixInterval = isMobile ? 15000 : 10000;
        setInterval(createMatrixRain, matrixInterval);

        // Handle window resize
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                // Clear existing elements
                const neuralNetwork = document.querySelector('.neural-network');
                const matrixContainer = document.querySelector('.absolute.inset-0.overflow-hidden.pointer-events-none');
                const heroSection = document.querySelector('.hero-bg');

                if (neuralNetwork) neuralNetwork.innerHTML = '';
                if (matrixContainer) {
                    const matrixChars = matrixContainer.querySelectorAll('.matrix-char');
                    matrixChars.forEach(char => char.remove());
                }
                if (heroSection) {
                    const particles = heroSection.querySelectorAll('[style*="position: absolute"][style*="border-radius: 50%"]');
                    particles.forEach(particle => particle.remove());
                }

                // Recreate with new dimensions
                createNeuralNetwork();
                createMatrixRain();
                createParticles();
            }, 300);
        });
    });

    // Mouse movement parallax effect (disabled on mobile for performance)
    if (window.innerWidth >= 640) {
        document.addEventListener('mousemove', function(e) {
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            const floatingElements = document.querySelectorAll('.floating-element');
            floatingElements.forEach((element, index) => {
                const speed = (index + 1) * 0.3; // Reduced speed for better performance
                const x = (mouseX - 0.5) * speed;
                const y = (mouseY - 0.5) * speed;

                // Use requestAnimationFrame for smoother animation
                requestAnimationFrame(() => {
                    element.style.transform = element.style.transform.replace(/translate\([^)]*\)/g, '') + ` translate(${x}px, ${y}px)`;
                });
            });
        });
    }
</script>
@endpush