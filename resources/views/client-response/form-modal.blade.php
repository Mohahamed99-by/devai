@extends('layouts.app')

@section('title', 'Générateur de Fiche Technique - Questionnaire')

@push('styles')
<style>
    .step-content {
        display: none;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    .step-content.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }
    .form-progress-bar {
        height: 8px;
        background-color: #f3f4f6;
        border-radius: 9999px;
        overflow: hidden;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
    }
    .form-progress-bar-inner {
        height: 100%;
        background: linear-gradient(90deg, var(--tw-gradient-stops));
        --tw-gradient-from: #4f46e5;
        --tw-gradient-to: #a855f7;
        --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        transition: width 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .card-gradient {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
    }
    .btn-gradient {
        background: linear-gradient(90deg, var(--tw-gradient-stops));
        --tw-gradient-from: #4f46e5;
        --tw-gradient-to: #a855f7;
        --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2), 0 2px 4px -1px rgba(79, 70, 229, 0.1);
    }
    .btn-gradient:hover {
        --tw-gradient-from: #4338ca;
        --tw-gradient-to: #9333ea;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3), 0 4px 6px -2px rgba(79, 70, 229, 0.15);
    }
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
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
    .form-input {
        transition: all 0.3s ease;
        border-color: #e5e7eb;
        border-radius: 0.75rem;
    }
    .form-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        transform: translateY(-1px);
    }
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
    }
    .form-hint {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }
    .checkbox-item {
        transition: all 0.2s ease;
    }
    .checkbox-item:hover {
        background-color: rgba(99, 102, 241, 0.05);
        border-radius: 0.5rem;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-6 sm:py-8 md:py-12">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-soft p-5 sm:p-6 md:p-8 mb-6 sm:mb-8 border border-gray-100 animate-fade-in">
            <div class="flex flex-col sm:flex-row sm:items-center mb-6 sm:mb-8">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-primary-600 to-secondary-600 rounded-xl flex items-center justify-center mb-3 sm:mb-0 sm:mr-5 shadow-md mx-auto sm:mx-0 transform transition-transform duration-300 hover:scale-105">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-3xl font-display font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent text-center sm:text-left">Générateur de Fiche Technique</h1>
                    <p class="text-dark-500 text-center sm:text-left mt-1 text-sm sm:text-base">Obtenez une analyse détaillée de votre projet en quelques minutes</p>
                </div>
            </div>

            <div class="card-gradient p-4 sm:p-5 md:p-7 mb-6 sm:mb-8 relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-primary-500/5 to-secondary-500/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>

                <p class="text-dark-700 mb-3 sm:mb-4 leading-relaxed text-sm sm:text-base relative">Bienvenue dans notre outil d'analyse automatisée de projets. Ce questionnaire intelligent nous aidera à comprendre vos besoins.</p>
                <p class="text-dark-700 leading-relaxed text-sm sm:text-base relative">Après soumission, notre <span class="font-semibold text-primary-600">IA</span> analysera vos exigences et générera une fiche technique détaillée incluant les fonctionnalités suggérées, les technologies recommandées et une estimation de délai de développement.</p>
            </div>

            <div class="flex flex-col items-center mt-6 sm:mt-8 md:mt-10">
                <button type="button" onclick="openModal('project-form-modal')" class="btn-gradient text-white px-6 sm:px-8 md:px-10 py-3 sm:py-4 rounded-xl flex items-center pulse-animation w-full sm:w-auto justify-center transform transition-all duration-300 hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 mr-2 sm:mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm sm:text-base md:text-lg font-medium">Commencer le questionnaire</span>
                </button>
                <p class="text-xs sm:text-sm text-dark-500 mt-3 sm:mt-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 mr-1 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Cela ne prendra que quelques minutes
                </p>
            </div>
        </div>
    </div>
</div>

<x-modal id="project-form-modal" maxWidth="5xl">
    <div class="p-4 sm:p-6 md:p-8 lg:p-10 bg-gradient-to-br from-white to-gray-50 overflow-y-auto max-h-[90vh] md:max-h-screen relative">
        <!-- Decorative elements - hidden on very small screens -->
        <div class="absolute top-0 right-0 w-40 sm:w-64 h-40 sm:h-64 bg-gradient-to-br from-primary-500/5 to-secondary-500/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl pointer-events-none hidden sm:block"></div>
        <div class="absolute bottom-0 left-0 w-40 sm:w-64 h-40 sm:h-64 bg-gradient-to-tr from-secondary-500/5 to-accent-500/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl pointer-events-none hidden sm:block"></div>

        <div class="relative">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8">
                <div class="flex items-center mb-4 sm:mb-0 w-full sm:w-auto">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-primary-600 to-secondary-600 rounded-xl flex items-center justify-center mr-3 sm:mr-4 shadow-md transform transition-transform duration-300 hover:scale-105">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-lg sm:text-xl md:text-2xl font-display font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Questionnaire de Projet</h2>
                        <p class="text-dark-500 text-xs sm:text-sm">Partagez les détails de votre projet pour obtenir une analyse personnalisée</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal('project-form-modal')" class="text-dark-400 hover:text-dark-600 transition-colors duration-200 p-2 rounded-xl hover:bg-dark-50 absolute top-2 right-2 sm:top-4 sm:right-4 md:static">
                    <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mb-6 sm:mb-8">
                <div class="form-progress-bar">
                    <div class="form-progress-bar-inner" id="progressBar" style="width: 20%"></div>
                </div>
                <div class="flex justify-between text-xs text-dark-500 mt-2 px-1">
                    <span class="text-[10px] sm:text-xs">Début</span>
                    <span class="text-[10px] sm:text-xs">Progression</span>
                    <span class="text-[10px] sm:text-xs">Fin</span>
                </div>
            </div>

            <div id="formStepsContainer" class="mb-4 sm:mb-6 flex justify-center">
                <!-- Les étapes seront générées dynamiquement par JavaScript -->
            </div>

        <form id="projectForm" class="mt-4 sm:mt-6 md:mt-8 bg-white p-4 sm:p-6 md:p-8 rounded-2xl shadow-soft border border-gray-100">
            @csrf

            <!-- Step 1: Informations de Base -->
            <div class="step-content active" data-step="1">
                <div class="flex items-center mb-5 pb-3 border-b border-primary-100">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-primary-100 rounded-xl flex items-center justify-center mr-3 text-primary-600 font-bold text-base sm:text-lg shadow-sm">1</div>
                    <div>
                        <h3 class="text-lg sm:text-xl font-display font-semibold text-dark-800">Informations de Base</h3>
                        <p class="text-dark-500 text-xs sm:text-sm">Commençons par les informations essentielles de votre projet</p>
                    </div>
                </div>

                <!-- Project Type -->
                <div class="mb-6 sm:mb-8">
                    <label class="form-label text-sm sm:text-base">
                        Type de Projet <span class="text-primary-600">*</span>
                    </label>
                    <select name="project_type" class="form-input w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base border rounded-xl focus:outline-none" required>
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
                    <p class="form-hint">Sélectionnez la plateforme principale pour votre projet</p>
                </div>

                <!-- Project Description -->
                <div class="mb-6 sm:mb-8">
                    <label class="form-label text-sm sm:text-base">
                        Description du Projet <span class="text-primary-600">*</span>
                    </label>
                    <div class="relative">
                        <textarea
                            name="project_description"
                            rows="4"
                            class="form-input w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base border rounded-xl focus:outline-none"
                            placeholder="Décrivez votre projet en détail. Quel problème résout-il ? Quels sont les objectifs principaux ?"
                            required
                            onclick="event.stopPropagation();"
                            onfocus="this.readOnly = false;"
                            onkeydown="event.stopPropagation();"></textarea>
                        <div class="absolute bottom-2 sm:bottom-3 right-2 sm:right-3 text-dark-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                    </div>
                    <p class="form-hint">Soyez aussi précis que possible sur l'objectif et les buts de votre projet</p>
                </div>

                <!-- Similar Applications -->
                <div class="mb-6 sm:mb-8">
                    <label class="form-label text-sm sm:text-base">
                        Applications Similaires
                    </label>
                    <div class="relative">
                        <textarea
                            name="similar_applications"
                            rows="3"
                            class="form-input w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base border rounded-xl focus:outline-none"
                            placeholder="Listez les applications ou sites web existants qui sont similaires à ce que vous souhaitez construire"
                            onclick="event.stopPropagation();"
                            onfocus="this.readOnly = false;"
                            onkeydown="event.stopPropagation();"></textarea>
                        <div class="absolute bottom-2 sm:bottom-3 right-2 sm:right-3 text-dark-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                    </div>
                    <p class="form-hint">Des exemples nous aident à mieux comprendre votre vision</p>
                </div>

                <div class="flex justify-end mt-6 sm:mt-8">
                    <button type="button" class="next-step btn-gradient text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl flex items-center shadow-md w-full sm:w-auto justify-center transform transition-all duration-300 hover:-translate-y-1 text-sm sm:text-base">
                        <span class="mr-2 font-medium">Suivant</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 2: Public Cible -->
            <div class="step-content" data-step="2">
                <div class="flex items-center mb-5 pb-3 border-b border-primary-100">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-primary-100 rounded-xl flex items-center justify-center mr-3 text-primary-600 font-bold text-base sm:text-lg shadow-sm">2</div>
                    <div>
                        <h3 class="text-lg sm:text-xl font-display font-semibold text-dark-800">Public Cible</h3>
                        <p class="text-dark-500 text-xs sm:text-sm">Définissez qui utilisera votre application</p>
                    </div>
                </div>

                <!-- Target Audience -->
                <div class="mb-6 sm:mb-8">
                    <label class="form-label text-sm sm:text-base">
                        Public Cible <span class="text-primary-600">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4 mt-2 sm:mt-3">
                        <div class="checkbox-item flex items-center p-2 sm:p-3 hover:bg-primary-50 rounded-xl transition-colors duration-200">
                            <input type="checkbox" name="target_audience[]" value="clients" class="h-4 w-4 sm:h-5 sm:w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded-md">
                            <label class="ml-2 sm:ml-3 block text-dark-700 text-sm sm:text-base">Clients / Consommateurs</label>
                        </div>
                        <div class="checkbox-item flex items-center p-2 sm:p-3 hover:bg-primary-50 rounded-xl transition-colors duration-200">
                            <input type="checkbox" name="target_audience[]" value="businesses" class="h-4 w-4 sm:h-5 sm:w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded-md">
                            <label class="ml-2 sm:ml-3 block text-dark-700 text-sm sm:text-base">Entreprises (B2B)</label>
                        </div>
                        <div class="checkbox-item flex items-center p-2 sm:p-3 hover:bg-primary-50 rounded-xl transition-colors duration-200">
                            <input type="checkbox" name="target_audience[]" value="internal" class="h-4 w-4 sm:h-5 sm:w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded-md">
                            <label class="ml-2 sm:ml-3 block text-dark-700 text-sm sm:text-base">Utilisateurs internes</label>
                        </div>
                        <div class="checkbox-item flex items-center p-2 sm:p-3 hover:bg-primary-50 rounded-xl transition-colors duration-200">
                            <input type="checkbox" name="target_audience[]" value="technical" class="h-4 w-4 sm:h-5 sm:w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded-md">
                            <label class="ml-2 sm:ml-3 block text-dark-700 text-sm sm:text-base">Utilisateurs techniques</label>
                        </div>
                    </div>
                    <p class="form-hint">Sélectionnez tous les types d'utilisateurs qui utiliseront votre application</p>
                </div>

                <!-- User Demographics -->
                <div class="mb-6 sm:mb-8">
                    <label class="form-label text-sm sm:text-base">
                        Démographie des Utilisateurs
                    </label>
                    <div class="relative">
                        <textarea
                            name="user_demographics"
                            rows="3"
                            class="form-input w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base border rounded-xl focus:outline-none"
                            placeholder="Décrivez les caractéristiques de vos utilisateurs (âge, profession, niveau technique, etc.)"
                            onclick="event.stopPropagation();"
                            onfocus="this.readOnly = false;"
                            onkeydown="event.stopPropagation();"></textarea>
                        <div class="absolute bottom-2 sm:bottom-3 right-2 sm:right-3 text-dark-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="form-hint">Ces informations nous aident à adapter l'interface utilisateur</p>
                </div>

                <!-- User Expectations -->
                <div class="mb-6 sm:mb-8">
                    <label class="form-label text-sm sm:text-base">
                        Attentes des Utilisateurs
                    </label>
                    <div class="relative">
                        <textarea
                            name="user_expectations"
                            rows="3"
                            class="form-input w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base border rounded-xl focus:outline-none"
                            placeholder="Quelles sont les principales attentes de vos utilisateurs ? Quels problèmes cherchent-ils à résoudre ?"
                            onclick="event.stopPropagation();"
                            onfocus="this.readOnly = false;"
                            onkeydown="event.stopPropagation();"></textarea>
                        <div class="absolute bottom-2 sm:bottom-3 right-2 sm:right-3 text-dark-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                    </div>
                    <p class="form-hint">Comprendre les attentes nous aide à prioriser les fonctionnalités</p>
                </div>

                <div class="flex flex-col sm:flex-row justify-between gap-3 sm:gap-4 mt-6 sm:mt-8">
                    <button type="button" class="prev-step bg-white border border-dark-200 text-dark-700 px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:bg-dark-50 transition-all duration-200 flex items-center shadow-sm justify-center sm:justify-start order-2 sm:order-1 hover:-translate-y-1 text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-dark-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">Précédent</span>
                    </button>
                    <button type="button" class="next-step btn-gradient text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl flex items-center shadow-md justify-center sm:justify-start order-1 sm:order-2 transform transition-all duration-300 hover:-translate-y-1 text-sm sm:text-base">
                        <span class="mr-2 font-medium">Suivant</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 3: Fonctionnalités -->
            <div class="step-content" data-step="3">
                <div class="flex items-center mb-4 pb-2 border-b border-indigo-100">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-2 sm:mr-3 text-indigo-600 font-bold text-sm sm:text-base">3</div>
                    <h3 class="text-lg sm:text-xl font-semibold text-indigo-800">Fonctionnalités</h3>
                </div>

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

                <div class="flex flex-col sm:flex-row justify-between gap-3 sm:gap-0 mt-6 sm:mt-8">
                    <button type="button" class="prev-step bg-white border border-gray-300 text-gray-700 px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center shadow-sm justify-center sm:justify-start order-2 sm:order-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm sm:text-base">Précédent</span>
                    </button>
                    <button type="button" class="next-step btn-gradient text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg flex items-center shadow-md justify-center sm:justify-start order-1 sm:order-2">
                        <span class="mr-2 text-sm sm:text-base">Suivant</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 4: Contraintes -->
            <div class="step-content" data-step="4">
                <div class="flex items-center mb-4 pb-2 border-b border-indigo-100">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-2 sm:mr-3 text-indigo-600 font-bold text-sm sm:text-base">4</div>
                    <h3 class="text-lg sm:text-xl font-semibold text-indigo-800">Contraintes</h3>
                </div>

                <!-- Budget Range -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Budget Estimé *
                    </label>
                    <select name="budget_range" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">Sélectionnez une fourchette de budget</option>
                        <option value="< 5000DH">Moins de 5 000DH</option>
                        <option value="5000DH - 10000DH">5 000DH - 10 000DH</option>
                        <option value="10000DH - 20000DH">10 000DH - 20 000DH</option>
                        <option value="20000DH - 50000DH">20 000DH - 50 000DH</option>
                        <option value="50000DH - 100000DH">50 000DH - 100 000DH</option>
                        <option value="> 100000DH">Plus de 100 000DH</option>
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

                <div class="flex flex-col sm:flex-row justify-between gap-3 sm:gap-0 mt-6 sm:mt-8">
                    <button type="button" class="prev-step bg-white border border-gray-300 text-gray-700 px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center shadow-sm justify-center sm:justify-start order-2 sm:order-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm sm:text-base">Précédent</span>
                    </button>
                    <button type="button" class="next-step btn-gradient text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg flex items-center shadow-md justify-center sm:justify-start order-1 sm:order-2">
                        <span class="mr-2 text-sm sm:text-base">Suivant</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 5: Exigences Techniques -->
            <div class="step-content" data-step="5">
                <div class="flex items-center mb-4 pb-2 border-b border-indigo-100">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-2 sm:mr-3 text-indigo-600 font-bold text-sm sm:text-base">5</div>
                    <h3 class="text-lg sm:text-xl font-semibold text-indigo-800">Exigences Techniques</h3>
                </div>

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

                <div class="flex flex-col sm:flex-row justify-between gap-3 sm:gap-0 mt-6 sm:mt-8">
                    <button type="button" class="prev-step bg-white border border-gray-300 text-gray-700 px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center shadow-sm justify-center sm:justify-start order-2 sm:order-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm sm:text-base">Précédent</span>
                    </button>
                    <button type="submit" id="submitForm" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-lg hover:from-green-600 hover:to-emerald-700 transition duration-200 flex items-center shadow-md transform hover:-translate-y-1 justify-center sm:justify-start order-1 sm:order-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium text-sm sm:text-base">Soumettre</span>
                    </button>
                </div>
            </div>
        </form>

        <div id="loadingOverlay" class="fixed inset-0 bg-gradient-to-br from-black/60 to-gray-900/60 backdrop-blur-sm items-center justify-center z-50 hidden" style="display: none;">
            <div class="bg-white p-8 rounded-2xl shadow-2xl text-center max-w-lg w-full mx-4 border border-gray-200">
                <!-- Animation principale -->
                <div class="relative w-24 h-24 mx-auto mb-6">
                    <div class="absolute top-0 left-0 w-full h-full rounded-full border-4 border-primary-100"></div>
                    <div class="absolute top-0 left-0 w-full h-full rounded-full border-4 border-primary-600 border-t-transparent animate-spin"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white animate-pulse" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Titre et description -->
                <h3 class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent mb-3">Analyse IA en cours</h3>
                <p class="text-lg font-semibold text-gray-700 mb-6">Notre intelligence artificielle analyse vos besoins...</p>

                <!-- Étapes d'analyse -->
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-start p-3 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-xl border border-primary-100">
                        <div class="w-5 h-5 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full animate-pulse mr-4 flex-shrink-0"></div>
                        <p class="text-gray-700 font-medium text-left">Analyse des exigences du projet</p>
                    </div>
                    <div class="flex items-center justify-start p-3 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-xl border border-primary-100" style="animation-delay: 0.5s">
                        <div class="w-5 h-5 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full animate-pulse mr-4 flex-shrink-0" style="animation-delay: 0.5s"></div>
                        <p class="text-gray-700 font-medium text-left">Identification des technologies appropriées</p>
                    </div>
                    <div class="flex items-center justify-start p-3 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-xl border border-primary-100" style="animation-delay: 1s">
                        <div class="w-5 h-5 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full animate-pulse mr-4 flex-shrink-0" style="animation-delay: 1s"></div>
                        <p class="text-gray-700 font-medium text-left">Génération des recommandations</p>
                    </div>
                    <div class="flex items-center justify-start p-3 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-xl border border-primary-100" style="animation-delay: 1.5s">
                        <div class="w-5 h-5 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full animate-pulse mr-4 flex-shrink-0" style="animation-delay: 1.5s"></div>
                        <p class="text-gray-700 font-medium text-left">Création de votre fiche technique</p>
                    </div>
                </div>

                <!-- Barre de progression -->
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-gradient-to-r from-primary-600 to-secondary-600 h-2 rounded-full animate-pulse" style="width: 75%; transition: width 2s ease-in-out;"></div>
                </div>

                <!-- Message d'information -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-blue-800 text-sm font-medium">Ce processus peut prendre jusqu'à 3 minutes selon la complexité de votre projet.</p>
                    </div>
                </div>

                <!-- Timer -->
                <p class="text-xs text-gray-500" id="loadingTimer">Temps écoulé: <span id="timerSeconds">0</span>s</p>
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

                // Démarrer le timer
                let timerSeconds = 0;
                const timerElement = document.getElementById('timerSeconds');
                const timerInterval = setInterval(() => {
                    timerSeconds++;
                    if (timerElement) {
                        timerElement.textContent = timerSeconds;
                    }
                }, 1000);

                // Envoyer les données au serveur avec un timeout de sécurité étendu
                const fetchTimeout = new Promise((resolve, reject) => {
                    const timeoutId = setTimeout(() => {
                        clearInterval(timerInterval);
                        reject(new Error('La requête a pris trop de temps à s\'exécuter (plus de 3 minutes)'));
                    }, 180000); // 3 minutes de timeout

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
                        clearInterval(timerInterval);
                        if (!response.ok) {
                            // Essayer de lire le corps de la réponse même en cas d'erreur
                            return response.json().then(errorData => {
                                throw new Error(errorData.message || 'Erreur réseau: ' + response.status);
                            }).catch(jsonError => {
                                // Si la réponse n'est pas du JSON valide
                                throw new Error('Erreur réseau: ' + response.status);
                            });
                        }
                        return response.json();
                    })
                    .then(resolve)
                    .catch(reject);
                });

                fetchTimeout
                    .then(data => {
                        clearInterval(timerInterval);

                        // Afficher un message de succès avant la redirection
                        const successMessage = document.createElement('div');
                        successMessage.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                        successMessage.innerHTML = `
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Analyse terminée avec succès !
                            </div>
                        `;
                        document.body.appendChild(successMessage);

                        // Vérifier si l'utilisateur doit s'inscrire
                        if (data.requires_login) {
                            // Stocker l'identifiant temporaire dans le localStorage pour plus de sécurité
                            if (data.temp_identifier) {
                                localStorage.setItem('temp_client_response_id', data.temp_identifier);
                            }
                        }

                        // Rediriger après un court délai pour montrer le message de succès
                        setTimeout(() => {
                            if (data.redirect_url) {
                                window.location.href = data.redirect_url;
                            } else {
                                // Fallback au cas où l'URL de redirection n'est pas fournie
                                window.location.href = '/client-response/' + data.id;
                            }
                        }, 1000);
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        clearInterval(timerInterval);

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

                        // Déterminer le message d'erreur à afficher
                        let errorMessage = error.message;
                        let errorDetails = '';

                        // Traiter les erreurs spécifiques
                        if (errorMessage.includes('500')) {
                            errorMessage = 'Une erreur est survenue sur le serveur. Veuillez réessayer dans quelques instants.';
                            errorDetails = 'Le serveur a rencontré une erreur interne. Notre équipe technique a été notifiée.';
                        } else if (errorMessage.includes('timeout') || errorMessage.includes('trop de temps')) {
                            errorMessage = 'La requête a pris trop de temps à s\'exécuter.';
                            errorDetails = 'Veuillez vérifier votre connexion internet et réessayer.';
                        }

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
                                <p class="text-gray-700 mb-4">${errorMessage}</p>
                                ${errorDetails ? `<p class="text-gray-500 text-sm mb-4">${errorDetails}</p>` : ''}
                                <p class="text-gray-500 text-xs mb-4">Détail technique: ${error.message}</p>
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
