@extends('layouts.app')

@section('title', 'Fiche Technique - Analyse de Projet')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ url('/') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour au formulaire
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold mb-2">Fiche Technique</h1>
            <p class="text-gray-600">Analyse générée par IA pour votre projet</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Original Requirements -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Exigences du Projet</h2>

                <div class="space-y-5">
                    <div>
                        <h3 class="font-semibold text-blue-700">Type de Projet</h3>
                        <p class="mt-1">{{ ucfirst(str_replace('_', ' ', $clientResponse->project_type)) }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-700">Description</h3>
                        <p class="mt-1 whitespace-pre-line">{{ $clientResponse->project_description }}</p>
                    </div>

                    @if(!empty($clientResponse->similar_applications))
                    <div>
                        <h3 class="font-semibold text-blue-700">Applications Similaires</h3>
                        <p class="mt-1">{{ $clientResponse->similar_applications }}</p>
                    </div>
                    @endif

                    <div>
                        <h3 class="font-semibold text-blue-700">Public Cible</h3>
                        <ul class="list-disc list-inside mt-1">
                            @foreach($clientResponse->target_audience as $audience)
                                <li>{{ ucfirst(str_replace('_', ' ', $audience)) }}</li>
                            @endforeach
                        </ul>
                    </div>

                    @if(!empty($clientResponse->user_roles))
                    <div>
                        <h3 class="font-semibold text-blue-700">Rôles Utilisateurs</h3>
                        <ul class="list-disc list-inside mt-1">
                            @foreach($clientResponse->user_roles as $role)
                                <li>{{ ucfirst(str_replace('_', ' ', $role)) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div>
                        <h3 class="font-semibold text-blue-700">Fonctionnalités Demandées</h3>
                        <ul class="list-disc list-inside mt-1">
                            @foreach($clientResponse->key_features as $feature)
                                <li>{{ ucfirst(str_replace('_', ' ', $feature)) }}</li>
                            @endforeach
                        </ul>
                    </div>

                    @if(!empty($clientResponse->custom_features))
                    <div>
                        <h3 class="font-semibold text-blue-700">Fonctionnalités Supplémentaires</h3>
                        <p class="mt-1">{{ $clientResponse->custom_features }}</p>
                    </div>
                    @endif

                    <div>
                        <h3 class="font-semibold text-blue-700">Fourchette Budgétaire</h3>
                        <p class="mt-1">{{ $clientResponse->budget_range }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-700">Délai</h3>
                        <p class="mt-1">{{ $clientResponse->timeline }}</p>
                    </div>

                    @if(!empty($clientResponse->deadline))
                    <div>
                        <h3 class="font-semibold text-blue-700">Date Limite Spécifique</h3>
                        <p class="mt-1">{{ $clientResponse->deadline->format('d/m/Y') }}</p>
                    </div>
                    @endif

                    @if(!empty($clientResponse->technical_requirements))
                    <div>
                        <h3 class="font-semibold text-blue-700">Exigences Techniques</h3>
                        <ul class="list-disc list-inside mt-1">
                            @foreach($clientResponse->technical_requirements as $req)
                                <li>{{ ucfirst(str_replace('_', ' ', $req)) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(!empty($clientResponse->external_apis))
                    <div>
                        <h3 class="font-semibold text-blue-700">Intégrations API Externes</h3>
                        <p class="mt-1">{{ $clientResponse->external_apis }}</p>
                    </div>
                    @endif

                    @if(!empty($clientResponse->design_complexity))
                    <div>
                        <h3 class="font-semibold text-blue-700">Complexité du Design UI/UX</h3>
                        <p class="mt-1">{{ ucfirst($clientResponse->design_complexity) }}</p>
                    </div>
                    @endif

                    <div>
                        <h3 class="font-semibold text-blue-700">Besoins de Maintenance</h3>
                        <p class="mt-1">{{ $clientResponse->needs_maintenance ? 'Oui' : 'Non' }}</p>

                        @if($clientResponse->needs_maintenance && !empty($clientResponse->maintenance_type))
                        <div class="mt-2">
                            <h4 class="font-medium text-gray-700">Type de Maintenance :</h4>
                            <ul class="list-disc list-inside ml-4">
                                @foreach($clientResponse->maintenance_type as $type)
                                    <li>{{ ucfirst(str_replace('_', ' ', $type)) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- AI Analysis -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Analyse Technique par IA</h2>

                <div class="space-y-5">
                    <div>
                        <h3 class="font-semibold text-blue-700">Résumé du Projet</h3>
                        @if(!empty($clientResponse->ai_analysis_summary))
                            <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $clientResponse->ai_analysis_summary }}</p>
                        @else
                            <p class="mt-1 text-gray-500">Aucun résumé d'analyse disponible</p>
                        @endif
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-700">Technologies Recommandées</h3>
                        @php
                            $technologies = $clientResponse->ai_suggested_technologies ?? [];
                            $technologies = is_array($technologies) ? $technologies : [];
                        @endphp
                        @if(count($technologies) > 0)
                            <ul class="mt-1 list-disc list-inside">
                                @foreach($technologies as $tech)
                                    <li>{{ $tech }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-1 text-gray-500">Aucune technologie suggérée</p>
                        @endif
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-700">Fonctionnalités Recommandées</h3>
                        @php
                            $features = $clientResponse->ai_suggested_features ?? [];
                            $features = is_array($features) ? $features : [];
                        @endphp
                        @if(count($features) > 0)
                            <ul class="mt-1 list-disc list-inside">
                                @foreach($features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-1 text-gray-500">Aucune fonctionnalité suggérée</p>
                        @endif
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-700">Facteurs de Complexité</h3>
                        @php
                            $factors = $clientResponse->ai_complexity_factors ?? [];
                            $factors = is_array($factors) ? $factors : [];
                        @endphp
                        @if(count($factors) > 0)
                            <ul class="mt-1 list-disc list-inside">
                                @foreach($factors as $factor)
                                    <li>{{ $factor }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-1 text-gray-500">Aucun facteur de complexité identifié</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 pt-4 border-t">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-700">Délai Estimé</h3>
                            <p class="mt-1 text-2xl font-bold">{{ $clientResponse->ai_estimated_duration }}</p>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-700">Budget Estimé</h3>
                            <p class="mt-1 text-2xl font-bold">${{ number_format($clientResponse->ai_cost_estimate, 2) }}</p>
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t">
                        <p class="text-sm text-gray-500">
                            Cette fiche technique a été générée automatiquement par IA en fonction de vos exigences de projet.
                            Les estimations fournies sont basées sur les standards de l'industrie et peuvent varier en fonction des détails spécifiques du projet.
                        </p>
                        <p class="text-sm text-gray-500 mt-2">
                            Générée le : {{ now()->format('d/m/Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($requiresRegistration) && $requiresRegistration)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mt-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Votre fiche technique est prête !</strong> Pour la conserver et y accéder ultérieurement, veuillez créer un compte.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('register') }}" class="inline-block bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 mr-2">
                            Créer un compte
                        </a>
                        <a href="{{ route('login') }}" class="inline-block bg-white border border-yellow-500 text-yellow-700 px-6 py-2 rounded-lg hover:bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ url('/pdf/generate/' . $clientResponse->id) }}" class="inline-block bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                </svg>
                Télécharger en PDF
            </a>
            <a href="{{ url('/') }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Nouvelle Analyse
            </a>
        </div>
    </div>
@endsection