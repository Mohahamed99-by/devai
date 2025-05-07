@extends('layouts.app')

@section('title', 'Générateur de Fiche Technique - Questionnaire')

@push('styles')
<style>
    .step-content {
        display: none;
    }
    .step-content.active {
        display: block;
    }
    .form-progress-bar {
        height: 4px;
        background-color: #e5e7eb;
        border-radius: 9999px;
        overflow: hidden;
    }
    .form-progress-bar-inner {
        height: 100%;
        background-color: #4f46e5;
        transition: width 0.3s ease;
    }
    .modal-backdrop {
        transition: opacity 0.3s ease;
    }
    .modal-content {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold mb-4">Générateur de Fiche Technique</h1>
            <p class="text-gray-600 mb-2">Bienvenue dans notre outil d'analyse automatisée de projets. Ce questionnaire intelligent nous aidera à comprendre vos besoins.</p>
            <p class="text-gray-600">Après soumission, notre IA analysera vos exigences et générera une fiche technique détaillée incluant les fonctionnalités suggérées, les technologies recommandées et une estimation de délai de développement.</p>
            
            <div class="mt-8">
                <button type="button" onclick="openSimpleModal('project-form-modal')" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Commencer le questionnaire
                </button>
            </div>
        </div>
    </div>
</div>

<x-simple-modal id="project-form-modal" maxWidth="4xl">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Questionnaire de Projet</h2>
            <button type="button" data-dismiss="modal" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="mb-6">
            <div class="form-progress-bar">
                <div class="form-progress-bar-inner" id="progressBar" style="width: 20%"></div>
            </div>
        </div>
        
        <div id="formStepsContainer">
            <!-- Les étapes seront générées dynamiquement par JavaScript -->
        </div>
        
        <form id="projectForm" class="mt-6">
            @csrf
            
            <!-- Step 1: Informations de Base -->
            <div class="step-content active" data-step="1">
                <h3 class="text-xl font-semibold mb-4 pb-2 border-b">Informations de Base</h3>
                
                <!-- Project Type -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Type de Projet *
                    </label>
                    <select name="project_type" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">Sélectionnez un type de projet</option>
                        <option value="web">Application Web</option>
                        <option value="mobile_ios">Application Mobile - iOS</option>
                        <option value="mobile_android">Application Mobile - Android</option>
                        <option value="mobile_cross">Application Mobile - Multi-plateforme</option>
                        <option value="desktop">Logiciel de Bureau</option>
                        <option value="hybrid">Application Hybride</option>
                        <option value="ecommerce">Plateforme E-commerce</option>
                        <option value="cms">Système de Gestion de Contenu</option>
                        <option value="api">API / Service Backend</option>
                    </select>
                    <p class="text-gray-500 text-xs mt-1">Sélectionnez la plateforme principale pour votre projet</p>
                </div>
                
                <!-- Project Description -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Description du Projet *
                    </label>
                    <textarea
                        name="project_description"
                        rows="5"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Décrivez votre projet en détail. Quel problème résout-il ? Quels sont les objectifs principaux ?"
                        required></textarea>
                    <p class="text-gray-500 text-xs mt-1">Soyez aussi précis que possible sur l'objectif et les buts de votre projet</p>
                </div>
                
                <!-- Similar Applications -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Applications Similaires
                    </label>
                    <textarea
                        name="similar_applications"
                        rows="2"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Listez les applications ou sites web existants qui sont similaires à ce que vous souhaitez construire"></textarea>
                    <p class="text-gray-500 text-xs mt-1">Des exemples nous aident à mieux comprendre votre vision</p>
                </div>
                
                <div class="flex justify-end mt-6">
                    <button type="button" class="next-step bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 flex items-center">
                        Suivant
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Autres étapes seront ajoutées par JavaScript -->
            
        </form>
        
        <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm items-center justify-center z-50 hidden" style="display: none;">
            <div class="bg-white p-8 rounded-xl shadow-xl text-center max-w-md w-full">
                <div class="relative w-20 h-20 mx-auto mb-6">
                    <div class="absolute top-0 left-0 w-full h-full rounded-full border-4 border-indigo-200"></div>
                    <div class="absolute top-0 left-0 w-full h-full rounded-full border-4 border-indigo-600 border-t-transparent animate-spin"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <svg class="w-8 h-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Analyse en cours</h3>
                <p class="text-lg font-semibold text-indigo-600 mb-4">Notre IA analyse vos besoins...</p>
                <div class="space-y-2 mb-4">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-indigo-600 rounded-full animate-pulse mr-3"></div>
                        <p class="text-gray-600">Analyse des exigences du projet</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-indigo-600 rounded-full animate-pulse mr-3" style="animation-delay: 0.5s"></div>
                        <p class="text-gray-600">Identification des technologies appropriées</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-indigo-600 rounded-full animate-pulse mr-3" style="animation-delay: 1s"></div>
                        <p class="text-gray-600">Génération des recommandations</p>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">Ce processus peut prendre jusqu'à une minute. Merci de votre patience.</p>
            </div>
        </div>
    </div>
</x-simple-modal>

@endsection

@push('scripts')
<script>
    // Le code JavaScript sera ajouté séparément
</script>
@endpush
