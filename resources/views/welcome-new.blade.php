@extends('layouts.app')

@section('title', 'DevsAI - Générateur de Fiche Technique Automatique')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Générateur de Fiche Technique Automatique</h1>
                <p class="text-xl mb-8">Transformez vos idées de projet en spécifications techniques détaillées grâce à l'intelligence artificielle</p>
                <a href="{{ route('client-response.form') }}" class="inline-block bg-white text-blue-700 font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-blue-50 transition duration-300">
                    Commencer l'analyse
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Comment ça fonctionne</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 text-xl font-bold">1</div>
                <h3 class="text-xl font-semibold mb-3">Décrivez votre projet</h3>
                <p class="text-gray-600">Remplissez notre formulaire intelligent avec les détails de votre projet, vos besoins et vos contraintes.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 text-xl font-bold">2</div>
                <h3 class="text-xl font-semibold mb-3">Analyse par IA</h3>
                <p class="text-gray-600">Notre intelligence artificielle analyse vos besoins et génère des recommandations techniques précises.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 text-xl font-bold">3</div>
                <h3 class="text-xl font-semibold mb-3">Obtenez votre fiche technique</h3>
                <p class="text-gray-600">Recevez instantanément une fiche technique détaillée avec technologies, fonctionnalités et estimations.</p>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Avantages</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold mb-1">Gain de temps</h3>
                        <p class="text-gray-600">Générez des spécifications techniques en quelques minutes au lieu de plusieurs heures.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold mb-1">Précision</h3>
                        <p class="text-gray-600">Recommandations basées sur les meilleures pratiques et technologies actuelles.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold mb-1">Standardisation</h3>
                        <p class="text-gray-600">Format cohérent pour toutes vos fiches techniques de projet.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold mb-1">Estimations fiables</h3>
                        <p class="text-gray-600">Obtenez des estimations de durée et de coût basées sur l'analyse IA.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="container mx-auto px-4 py-16 text-center">
        <h2 class="text-3xl font-bold mb-6">Prêt à analyser votre projet ?</h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Obtenez une fiche technique détaillée en quelques minutes grâce à notre générateur automatique.</p>
        <a href="{{ route('client-response.form') }}" class="inline-block bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300">
            Commencer maintenant
        </a>
    </div>
@endsection
