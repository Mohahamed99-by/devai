@extends('layouts.app')

@section('title', 'DevsAI - Générateur de Fiche Technique Automatique')

@push('styles')
<style>
    /* Figma Design System */
    :root {
        --primary-gradient: linear-gradient(135deg, #2563EB 0%, #7C3AED 100%);
        --secondary-gradient: linear-gradient(135deg, #E6F7FF 0%, #BAE7FF 100%);
        --glass-effect: backdrop-filter: blur(10px) saturate(180%);
    }

    /* Enhanced Figma-inspired styles */
    .figma-shape {
        position: absolute;
        z-index: 0;
    }

    .figma-glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px) saturate(180%);
        -webkit-backdrop-filter: blur(10px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
    }

    .figma-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform-origin: center;
    }

    .figma-card:hover {
        transform: scale(1.02) translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    }

    .figma-button {
        background: var(--primary-gradient);
        border-radius: 16px;
        padding: 16px 32px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .figma-button::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
        transform: translateX(-100%);
        transition: transform 0.6s;
    }

    .figma-button:hover::after {
        transform: translateX(100%);
    }

    .figma-blob {
        animation: figma-morph 20s ease-in-out infinite;
        background-image: var(--primary-gradient);
        border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        position: absolute;
        transition: all 1s ease-in-out;
        filter: blur(20px);
        opacity: 0.5;
    }

    @keyframes figma-morph {
        0% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        25% { border-radius: 40% 60% 70% 30% / 30% 60% 40% 70%; }
        50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        75% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
    }

    .figma-float {
        animation: figma-float 8s ease-in-out infinite;
    }

    @keyframes figma-float {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }

    .hero-gradient {
        background: linear-gradient(135deg, #2563EB 0%, #7C3AED 100%);
        position: relative;
    }

    .hero-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section avec nouveau design Figma -->
    <div class="hero-gradient relative overflow-hidden min-h-screen">
        <!-- Blobs d'arrière-plan -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="figma-blob w-96 h-96 top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
            <div class="figma-blob w-96 h-96 bottom-0 right-0 translate-x-1/2 translate-y-1/2" style="background-image: linear-gradient(135deg, #7C3AED 0%, #2563EB 100%);"></div>
        </div>

        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full mix-blend-overlay filter blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-72 h-72 bg-pink-400 rounded-full mix-blend-overlay filter blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 py-24 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <div class="inline-block mb-4 px-6 py-2 bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-full text-black  text-sm font-medium">
                    Propulsé par l'intelligence artificielle
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                    Générez des <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-300 to-blue-300">fiches techniques</span> en quelques minutes
                </h1>
                <p class="text-xl md:text-2xl mb-10 text-blue-100 max-w-3xl mx-auto">
                    Transformez vos idées de projet en spécifications techniques détaillées grâce à notre plateforme alimentée par l'IA
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('client-response.form') }}" class="inline-flex items-center justify-center figma-button">
                        <span>Commencer l'analyse</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#how-it-works" class="inline-flex items-center justify-center bg-transparent border-2 border-white text-white font-semibold px-8 py-4 rounded-xl hover:bg-white hover:bg-opacity-10 transition duration-300">
                        <span>Comment ça marche</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="mt-16 max-w-5xl mx-auto relative">
                <div class="absolute inset-0 bg-gradient-to-t from-indigo-600 via-transparent to-transparent z-10"></div>
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Dashboard Preview" class="w-full h-auto rounded-xl shadow-2xl">
            </div>
        </div>

        <div class="hero-shape">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-5xl mx-auto">
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-indigo-600">500+</div>
                <div class="text-gray-600 mt-2">Projets analysés</div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-indigo-600">98%</div>
                <div class="text-gray-600 mt-2">Taux de satisfaction</div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-indigo-600">15min</div>
                <div class="text-gray-600 mt-2">Temps moyen d'analyse</div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-indigo-600">24/7</div>
                <div class="text-gray-600 mt-2">Disponibilité</div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="how-it-works" class="container mx-auto px-4 py-20">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium mb-4">
                Comment ça fonctionne
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-6 gradient-text">Un processus simple et efficace</h2>
            <p class="text-xl text-gray-600">Notre plateforme utilise l'intelligence artificielle pour transformer vos idées en spécifications techniques détaillées en seulement trois étapes.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-xl feature-card">
                <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">1. Décrivez votre projet</h3>
                <p class="text-gray-600">Remplissez notre formulaire intelligent avec les détails de votre projet, vos besoins et vos contraintes techniques.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-xl feature-card">
                <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">2. Analyse par IA</h3>
                <p class="text-gray-600">Notre intelligence artificielle avancée analyse vos besoins et génère des recommandations techniques précises et adaptées.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-xl feature-card">
                <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">3. Obtenez votre fiche technique</h3>
                <p class="text-gray-600">Recevez instantanément une fiche technique détaillée avec technologies recommandées, fonctionnalités et estimations de coûts.</p>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="py-20 bg-gradient-to-br from-indigo-50 to-blue-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center max-w-6xl mx-auto">
                <div class="md:w-1/2 mb-12 md:mb-0 md:pr-12">
                    <div class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium mb-4">
                        Avantages
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-8 gradient-text">Pourquoi utiliser notre plateforme ?</h2>

                    <div class="space-y-6">
                        <div class="flex items-start benefit-item">
                            <div class="flex-shrink-0 mt-1 bg-indigo-100 rounded-full p-2">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold mb-1">Gain de temps considérable</h3>
                                <p class="text-gray-600">Générez des spécifications techniques complètes en quelques minutes au lieu de plusieurs jours de travail.</p>
                            </div>
                        </div>

                        <div class="flex items-start benefit-item">
                            <div class="flex-shrink-0 mt-1 bg-indigo-100 rounded-full p-2">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold mb-1">Précision et fiabilité</h3>
                                <p class="text-gray-600">Recommandations basées sur les meilleures pratiques de l'industrie et les technologies les plus récentes.</p>
                            </div>
                        </div>

                        <div class="flex items-start benefit-item">
                            <div class="flex-shrink-0 mt-1 bg-indigo-100 rounded-full p-2">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold mb-1">Estimations budgétaires précises</h3>
                                <p class="text-gray-600">Obtenez des estimations de coûts et de délais réalistes pour mieux planifier vos projets.</p>
                            </div>
                        </div>

                        <div class="flex items-start benefit-item">
                            <div class="flex-shrink-0 mt-1 bg-indigo-100 rounded-full p-2">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold mb-1">Format standardisé</h3>
                                <p class="text-gray-600">Documentation technique cohérente et professionnelle pour tous vos projets.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:w-1/2 relative">
                    <div class="relative z-10">
                        <div class="w-64 h-64 md:w-80 md:h-80 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl shadow-xl overflow-hidden blob-animation mx-auto">
                            <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="AI Analysis" class="w-full h-full object-cover mix-blend-overlay">
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 -mt-12 -mr-12 w-40 h-40 bg-yellow-400 rounded-full opacity-20 blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-12 -ml-12 w-40 h-40 bg-pink-400 rounded-full opacity-20 blur-2xl"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="container mx-auto px-4 py-20 text-center">
        <div class="max-w-4xl mx-auto bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl shadow-xl p-12 text-white">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Prêt à transformer vos idées en spécifications techniques ?</h2>
            <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">Obtenez une fiche technique détaillée en quelques minutes grâce à notre générateur automatique alimenté par l'IA.</p>
            <a href="{{ route('client-response.form') }}" class="inline-flex items-center justify-center figma-button">
                <span>Commencer maintenant</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
@endpush
