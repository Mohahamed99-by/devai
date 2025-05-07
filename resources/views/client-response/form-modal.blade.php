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
                <button type="button" onclick="openModal('project-form-modal')" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Commencer le questionnaire
                </button>
            </div>
        </div>
    </div>
</div>

<x-modal id="project-form-modal" maxWidth="4xl">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Questionnaire de Projet</h2>
            <button type="button" onclick="closeModal('project-form-modal')" class="text-gray-400 hover:text-gray-500">
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
                        required
                        onclick="event.stopPropagation();"
                        onfocus="this.readOnly = false;"
                        onkeydown="event.stopPropagation();"></textarea>
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
                        placeholder="Listez les applications ou sites web existants qui sont similaires à ce que vous souhaitez construire"
                        onclick="event.stopPropagation();"
                        onfocus="this.readOnly = false;"
                        onkeydown="event.stopPropagation();"></textarea>
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

            <!-- Step 2: Public Cible -->
            <div class="step-content" data-step="2">
                <h3 class="text-xl font-semibold mb-4 pb-2 border-b">Public Cible</h3>

                <!-- Target Audience -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Public Cible *
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="target_audience[]" value="clients" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Clients / Consommateurs</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="target_audience[]" value="businesses" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Entreprises (B2B)</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="target_audience[]" value="internal" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Utilisateurs internes</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="target_audience[]" value="technical" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Utilisateurs techniques</label>
                        </div>
                    </div>
                    <p class="text-gray-500 text-xs mt-1">Sélectionnez tous les types d'utilisateurs qui utiliseront votre application</p>
                </div>

                <!-- User Demographics -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Démographie des Utilisateurs
                    </label>
                    <textarea
                        name="user_demographics"
                        rows="3"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Décrivez les caractéristiques de vos utilisateurs (âge, profession, niveau technique, etc.)"
                        onclick="event.stopPropagation();"
                        onfocus="this.readOnly = false;"
                        onkeydown="event.stopPropagation();"></textarea>
                    <p class="text-gray-500 text-xs mt-1">Ces informations nous aident à adapter l'interface utilisateur</p>
                </div>

                <!-- User Expectations -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Attentes des Utilisateurs
                    </label>
                    <textarea
                        name="user_expectations"
                        rows="3"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Quelles sont les principales attentes de vos utilisateurs ? Quels problèmes cherchent-ils à résoudre ?"
                        onclick="event.stopPropagation();"
                        onfocus="this.readOnly = false;"
                        onkeydown="event.stopPropagation();"></textarea>
                    <p class="text-gray-500 text-xs mt-1">Comprendre les attentes nous aide à prioriser les fonctionnalités</p>
                </div>

                <div class="flex justify-between mt-6">
                    <button type="button" class="prev-step bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Précédent
                    </button>
                    <button type="button" class="next-step bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 flex items-center">
                        Suivant
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 3: Fonctionnalités -->
            <div class="step-content" data-step="3">
                <h3 class="text-xl font-semibold mb-4 pb-2 border-b">Fonctionnalités</h3>

                <!-- Key Features -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Fonctionnalités Clés *
                    </label>
                    <div id="features-container">
                        <div class="feature-item mb-2 flex items-center">
                            <input type="text" name="key_features[]" class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Décrivez une fonctionnalité" required>
                            <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-feature hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button type="button" id="add-feature" class="mt-2 text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Ajouter une fonctionnalité
                    </button>
                    <p class="text-gray-500 text-xs mt-1">Listez les fonctionnalités principales que votre application doit avoir</p>
                </div>

                <!-- Nice-to-Have Features -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Fonctionnalités Souhaitables (non essentielles)
                    </label>
                    <div id="optional-features-container">
                        <div class="optional-feature-item mb-2 flex items-center">
                            <input type="text" name="optional_features[]" class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Décrivez une fonctionnalité optionnelle">
                            <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-optional-feature hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button type="button" id="add-optional-feature" class="mt-2 text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Ajouter une fonctionnalité optionnelle
                    </button>
                    <p class="text-gray-500 text-xs mt-1">Fonctionnalités qui seraient utiles mais non essentielles pour la première version</p>
                </div>

                <div class="flex justify-between mt-6">
                    <button type="button" class="prev-step bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Précédent
                    </button>
                    <button type="button" class="next-step bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 flex items-center">
                        Suivant
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 4: Contraintes -->
            <div class="step-content" data-step="4">
                <h3 class="text-xl font-semibold mb-4 pb-2 border-b">Contraintes</h3>

                <!-- Budget Range -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Budget Estimé *
                    </label>
                    <select name="budget_range" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">Sélectionnez une fourchette de budget</option>
                        <option value="< 5000€">Moins de 5 000€</option>
                        <option value="5000€ - 10000€">5 000€ - 10 000€</option>
                        <option value="10000€ - 20000€">10 000€ - 20 000€</option>
                        <option value="20000€ - 50000€">20 000€ - 50 000€</option>
                        <option value="50000€ - 100000€">50 000€ - 100 000€</option>
                        <option value="> 100000€">Plus de 100 000€</option>
                    </select>
                    <p class="text-gray-500 text-xs mt-1">Cette information nous aide à recommander des solutions adaptées à votre budget</p>
                </div>

                <!-- Timeline -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Délai Souhaité *
                    </label>
                    <select name="timeline" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">Sélectionnez un délai</option>
                        <option value="< 1 mois">Moins d'1 mois</option>
                        <option value="1-3 mois">1-3 mois</option>
                        <option value="3-6 mois">3-6 mois</option>
                        <option value="6-12 mois">6-12 mois</option>
                        <option value="> 12 mois">Plus de 12 mois</option>
                    </select>
                    <p class="text-gray-500 text-xs mt-1">Quand souhaitez-vous que le projet soit terminé ?</p>
                </div>

                <!-- Maintenance -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Maintenance & Support
                    </label>
                    <div class="mt-2">
                        <div class="flex items-center">
                            <input type="radio" id="maintenance_yes" name="needs_maintenance" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <label for="maintenance_yes" class="ml-2 block text-gray-700">Oui, je souhaite un plan de maintenance</label>
                        </div>
                        <div class="flex items-center mt-2">
                            <input type="radio" id="maintenance_no" name="needs_maintenance" value="0" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <label for="maintenance_no" class="ml-2 block text-gray-700">Non, pas besoin de maintenance</label>
                        </div>
                    </div>
                    <p class="text-gray-500 text-xs mt-1">Avez-vous besoin d'un plan de maintenance après le lancement ?</p>
                </div>

                <div class="flex justify-between mt-6">
                    <button type="button" class="prev-step bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Précédent
                    </button>
                    <button type="button" class="next-step bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 flex items-center">
                        Suivant
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 5: Exigences Techniques -->
            <div class="step-content" data-step="5">
                <h3 class="text-xl font-semibold mb-4 pb-2 border-b">Exigences Techniques</h3>

                <!-- Technical Requirements -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Exigences Techniques
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="technical_requirements[]" value="responsive" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Design Responsive</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="technical_requirements[]" value="offline" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Fonctionnement Hors-ligne</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="technical_requirements[]" value="high_performance" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Haute Performance</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="technical_requirements[]" value="scalability" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Évolutivité</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="technical_requirements[]" value="security" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Sécurité Renforcée</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="technical_requirements[]" value="accessibility" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Accessibilité (WCAG)</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="technical_requirements[]" value="multilingual" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Support Multilingue</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="technical_requirements[]" value="analytics" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 block text-gray-700">Analytique & Rapports</label>
                        </div>
                    </div>
                    <p class="text-gray-500 text-xs mt-1">Sélectionnez toutes les exigences techniques applicables</p>
                </div>

                <!-- Integration Requirements -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Intégrations Requises
                    </label>
                    <textarea
                        name="integration_requirements"
                        rows="3"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Listez les systèmes, APIs ou services tiers avec lesquels votre application doit s'intégrer"
                        onclick="event.stopPropagation();"
                        onfocus="this.readOnly = false;"
                        onkeydown="event.stopPropagation();"></textarea>
                    <p class="text-gray-500 text-xs mt-1">Par exemple: Stripe, Google Maps, systèmes CRM, etc.</p>
                </div>

                <!-- Additional Information -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Informations Supplémentaires
                    </label>
                    <textarea
                        name="additional_information"
                        rows="3"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Toute autre information pertinente que vous souhaitez partager"
                        onclick="event.stopPropagation();"
                        onfocus="this.readOnly = false;"
                        onkeydown="event.stopPropagation();"></textarea>
                    <p class="text-gray-500 text-xs mt-1">Détails supplémentaires qui pourraient nous aider à mieux comprendre vos besoins</p>
                </div>

                <div class="flex justify-between mt-6">
                    <button type="button" class="prev-step bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Précédent
                    </button>
                    <button type="submit" id="submitForm" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Soumettre
                    </button>
                </div>
            </div>
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
</x-modal>

@endsection

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('projectForm');
        const steps = document.querySelectorAll('.step-content');
        const progressBar = document.getElementById('progressBar');
        const formStepsContainer = document.getElementById('formStepsContainer');
        const loadingOverlay = document.getElementById('loadingOverlay');
        let currentStep = 1;
        const totalSteps = steps.length;

        // Initialiser la barre de progression
        updateProgressBar();

        // Initialiser l'indicateur d'étapes
        updateStepsIndicator();

        // Initialiser les champs de texte et textarea
        initializeFormFields();

        // Gérer les boutons suivant
        document.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', function() {
                // Valider les champs de l'étape actuelle
                if (validateCurrentStep()) {
                    goToStep(currentStep + 1);
                }
            });
        });

        // Gérer les boutons précédent
        document.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', function() {
                goToStep(currentStep - 1);
            });
        });

        // Ajouter des fonctionnalités
        document.getElementById('add-feature').addEventListener('click', function() {
            addFeatureField('features-container', 'feature-item', 'key_features[]', 'remove-feature');
        });

        // Ajouter des fonctionnalités optionnelles
        document.getElementById('add-optional-feature').addEventListener('click', function() {
            addFeatureField('optional-features-container', 'optional-feature-item', 'optional_features[]', 'remove-optional-feature');
        });

        // Gérer la suppression des fonctionnalités
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-feature')) {
                e.target.closest('.feature-item').remove();
                updateRemoveButtons('features-container', 'feature-item', 'remove-feature');
            }
            if (e.target.closest('.remove-optional-feature')) {
                e.target.closest('.optional-feature-item').remove();
                updateRemoveButtons('optional-features-container', 'optional-feature-item', 'remove-optional-feature');
            }
        });

        // Gérer la soumission du formulaire
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (validateCurrentStep()) {
                // Désactiver le bouton de soumission pour éviter les soumissions multiples
                const submitButton = document.getElementById('submitForm');
                submitButton.disabled = true;
                submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Traitement en cours...
                `;

                // Afficher l'overlay de chargement
                loadingOverlay.classList.remove('hidden');
                loadingOverlay.style.display = 'flex';

                // Collecter les données du formulaire
                const formData = new FormData(form);
                const data = {};

                // Convertir les données en objet
                for (let [key, value] of formData.entries()) {
                    if (key.endsWith('[]')) {
                        const arrayKey = key.slice(0, -2);
                        if (!data[arrayKey]) {
                            data[arrayKey] = [];
                        }
                        if (value.trim() !== '') {
                            data[arrayKey].push(value);
                        }
                    } else {
                        data[key] = value;
                    }
                }

                // Envoyer les données au serveur avec un timeout de sécurité
                const fetchTimeout = new Promise((resolve, reject) => {
                    const timeoutId = setTimeout(() => {
                        reject(new Error('La requête a pris trop de temps à s\'exécuter'));
                    }, 60000); // 60 secondes de timeout

                    fetch('/client-response', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        clearTimeout(timeoutId);
                        if (!response.ok) {
                            throw new Error('Erreur réseau: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(resolve)
                    .catch(reject);
                });

                fetchTimeout
                    .then(data => {
                        // Rediriger vers la page de résultat
                        window.location.href = '/client-response/' + data.id;
                    })
                    .catch(error => {
                        console.error('Erreur:', error);

                        // Masquer l'overlay de chargement
                        loadingOverlay.classList.add('hidden');
                        loadingOverlay.style.display = 'none';

                        // Réactiver le bouton de soumission
                        submitButton.disabled = false;
                        submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                        submitButton.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Soumettre
                        `;

                        // Afficher un message d'erreur plus détaillé
                        const errorModal = document.createElement('div');
                        errorModal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                        errorModal.innerHTML = `
                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold text-red-600">Erreur lors de la soumission</h3>
                                    <button type="button" class="text-gray-400 hover:text-gray-500" id="closeErrorModal">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-gray-700 mb-4">Une erreur est survenue lors de la soumission du formulaire. Veuillez réessayer.</p>
                                <p class="text-gray-500 text-sm mb-4">Détail technique: ${error.message}</p>
                                <div class="flex justify-end">
                                    <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" id="confirmErrorModal">
                                        Compris
                                    </button>
                                </div>
                            </div>
                        `;
                        document.body.appendChild(errorModal);

                        // Gérer la fermeture du modal d'erreur
                        document.getElementById('closeErrorModal').addEventListener('click', function() {
                            errorModal.remove();
                        });
                        document.getElementById('confirmErrorModal').addEventListener('click', function() {
                            errorModal.remove();
                        });
                    });
            }
        });

        // Fonctions utilitaires
        function goToStep(step) {
            if (step < 1 || step > totalSteps) return;

            // Masquer toutes les étapes
            steps.forEach(s => s.classList.remove('active'));

            // Afficher l'étape actuelle
            steps[step - 1].classList.add('active');

            // Mettre à jour l'étape actuelle
            currentStep = step;

            // Mettre à jour la barre de progression
            updateProgressBar();

            // Mettre à jour l'indicateur d'étapes
            updateStepsIndicator();

            // Faire défiler vers le haut
            window.scrollTo(0, 0);

            // Activer le premier champ de l'étape actuelle
            setTimeout(() => {
                const activeStep = steps[step - 1];
                const firstInput = activeStep.querySelector('input:not([type="hidden"]), textarea, select');
                if (firstInput) {
                    firstInput.focus();
                }

                // S'assurer que tous les champs de l'étape sont activés
                const formInputs = activeStep.querySelectorAll('input:not([type="hidden"]), textarea, select');
                formInputs.forEach(input => {
                    // Réinitialiser l'état du champ si nécessaire
                    if (input.disabled) {
                        input.disabled = false;
                    }
                });
            }, 50);
        }

        function updateProgressBar() {
            const progress = (currentStep / totalSteps) * 100;
            progressBar.style.width = progress + '%';
        }

        function updateStepsIndicator() {
            // Mettre à jour l'indicateur d'étapes
            formStepsContainer.innerHTML = '';

            const stepsNames = ['Informations de Base', 'Public Cible', 'Fonctionnalités', 'Contraintes', 'Exigences Techniques'];
            // Créer un élément temporaire pour contenir les étapes
            formStepsContainer.innerHTML = `
                <div class="py-4">
                    <div class="max-w-3xl mx-auto">
                        <div class="flex items-center justify-between">
                            ${stepsNames.map((step, index) => `
                                <div class="flex items-center">
                                    <div class="${index + 1 <= currentStep ? 'bg-indigo-600' : 'bg-gray-300'} rounded-full h-8 w-8 flex items-center justify-center text-white font-semibold">
                                        ${index + 1}
                                    </div>
                                    <div class="ml-2 ${index + 1 <= currentStep ? 'text-indigo-600 font-medium' : 'text-gray-500'}">
                                        ${step}
                                    </div>
                                </div>
                                ${index < stepsNames.length - 1 ? `
                                    <div class="flex-1 mx-4">
                                        <div class="h-1 ${index + 1 < currentStep ? 'bg-indigo-600' : 'bg-gray-300'}"></div>
                                    </div>
                                ` : ''}
                            `).join('')}
                        </div>
                    </div>
                </div>
            `;

            // Nous avons déjà mis à jour le contenu directement
        }

        function validateCurrentStep() {
            const currentStepElement = steps[currentStep - 1];
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            // Validation spécifique pour les checkboxes
            if (currentStep === 2) {
                const checkboxes = currentStepElement.querySelectorAll('input[name="target_audience[]"]');
                let checked = false;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        checked = true;
                    }
                });

                if (!checked) {
                    checkboxes.forEach(checkbox => {
                        checkbox.closest('div').classList.add('border', 'border-red-500', 'rounded');
                    });
                    isValid = false;
                } else {
                    checkboxes.forEach(checkbox => {
                        checkbox.closest('div').classList.remove('border', 'border-red-500', 'rounded');
                    });
                }
            }

            return isValid;
        }

        function addFeatureField(containerId, itemClass, inputName, removeButtonClass) {
            const container = document.getElementById(containerId);
            const newItem = document.createElement('div');
            newItem.className = `${itemClass} mb-2 flex items-center`;
            newItem.innerHTML = `
                <input type="text" name="${inputName}" class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Décrivez une fonctionnalité">
                <button type="button" class="ml-2 text-red-500 hover:text-red-700 ${removeButtonClass}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            container.appendChild(newItem);

            // Mettre à jour les boutons de suppression
            updateRemoveButtons(containerId, itemClass, removeButtonClass);
        }

        function updateRemoveButtons(containerId, itemClass, removeButtonClass) {
            const container = document.getElementById(containerId);
            const items = container.querySelectorAll(`.${itemClass}`);

            // Masquer tous les boutons de suppression si un seul élément
            if (items.length === 1) {
                items[0].querySelector(`.${removeButtonClass}`).classList.add('hidden');
            } else {
                // Afficher tous les boutons de suppression
                items.forEach(item => {
                    item.querySelector(`.${removeButtonClass}`).classList.remove('hidden');
                });
            }
        }

        // Initialiser les boutons de suppression
        updateRemoveButtons('features-container', 'feature-item', 'remove-feature');
        updateRemoveButtons('optional-features-container', 'optional-feature-item', 'remove-optional-feature');

        // Fonction pour initialiser les champs de formulaire
        function initializeFormFields() {
            // S'assurer que tous les champs de texte et textarea sont activés
            const allInputs = form.querySelectorAll('input[type="text"], textarea, select');
            allInputs.forEach(input => {
                // Ajouter des événements pour s'assurer que les champs sont activés
                input.addEventListener('click', function(e) {
                    // Empêcher la propagation pour éviter que le modal ne se ferme
                    e.stopPropagation();
                });

                // Forcer l'activation des champs
                input.disabled = false;

                // Pour les textarea, ajouter un gestionnaire spécial
                if (input.tagName === 'TEXTAREA') {
                    input.addEventListener('focus', function() {
                        // S'assurer que le textarea est éditable
                        this.readOnly = false;
                    });

                    // Empêcher la fermeture du modal lors de la saisie
                    input.addEventListener('keydown', function(e) {
                        e.stopPropagation();
                    });
                }
            });

            // Activer le premier champ de l'étape active
            const activeStep = document.querySelector('.step-content.active');
            if (activeStep) {
                const firstInput = activeStep.querySelector('input[type="text"], textarea, select');
                if (firstInput) {
                    // Petit délai pour s'assurer que le champ est prêt
                    setTimeout(() => {
                        firstInput.focus();
                    }, 100);
                }
            }
        }
    });
</script>
@endpush
