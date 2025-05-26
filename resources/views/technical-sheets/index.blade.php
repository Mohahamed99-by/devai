@extends('layouts.app')

@section('title', 'Fiches Techniques - Générateur de Fiche Technique')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-8 h-8 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                @if(Auth::user()->isAdmin())
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Toutes les Fiches Techniques</span>
                @else
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Mes Fiches Techniques</span>
                @endif
            </h1>

            <a href="{{ route('client-response.form') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 text-white font-medium rounded-lg shadow-sm hover:from-indigo-700 hover:to-blue-700 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Nouvelle fiche
            </a>
        </div>

        @if (session('success'))
            <div class="flex items-center p-4 mb-6 text-green-800 rounded-lg bg-green-50 border-l-4 border-green-500 shadow-sm" role="alert">
                <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="ml-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-100 inline-flex h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Fermer</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center p-4 mb-6 text-red-800 rounded-lg bg-red-50 border-l-4 border-red-500 shadow-sm" role="alert">
                <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div class="ml-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-100 inline-flex h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Fermer</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if ($clientResponses->isEmpty())
            <div class="text-center py-12 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl shadow-sm border border-indigo-100">
                <div class="mb-6">
                    <svg class="w-20 h-20 mx-auto text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-indigo-800 mb-2">Aucune fiche technique trouvée</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">Commencez par créer votre première fiche technique pour analyser votre projet avec notre IA.</p>
                <a href="{{ route('client-response.form') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 text-white font-medium rounded-lg shadow-md hover:from-indigo-700 hover:to-blue-700 transition-all duration-200 transform hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Créer une nouvelle fiche
                </a>
            </div>
        @else
            <!-- Table pour écrans larges (md et plus) -->
            <div class="hidden md:block overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-50 to-blue-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">ID</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Type de Projet</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Budget</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Délai</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Statut</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Date de Création</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($clientResponses as $response)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="py-4 px-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $response->id }}</td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-700">{{ ucfirst(str_replace('_', ' ', $response->project_type)) }}</td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-700">{{ $response->budget_range }}</td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-700">{{ $response->timeline }}</td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    @if ($response->status === 'draft')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                            Brouillon
                                        </span>
                                    @elseif ($response->status === 'validated')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Validé
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-700">{{ $response->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="{{ url('/client-response/' . $response->id) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900">
                                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Voir
                                        </a>

                                        <a href="{{ url('/pdf/generate/' . $response->id) }}" class="inline-flex items-center text-red-600 hover:text-red-900">
                                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            PDF
                                        </a>

                                        @if(Auth::user()->hasPermission('validate_technical_sheets') && $response->status === 'draft')
                                            <form method="POST" action="{{ route('technical-sheets.validate', $response->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center text-green-600 hover:text-green-900">
                                                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Valider
                                                </button>
                                            </form>
                                        @endif

                                        @if(Auth::user()->isAdmin())
                                            <form method="POST" action="{{ route('technical-sheets.admin.destroy', $response->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette fiche technique ?')">
                                                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Supprimer
                                                </button>
                                            </form>
                                        @elseif(Auth::id() === $response->user_id)
                                            <form method="POST" action="{{ route('technical-sheets.destroy', $response->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette fiche technique ?')">
                                                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Supprimer
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cards pour écrans mobiles (moins de md) -->
            <div class="md:hidden space-y-4">
                @foreach ($clientResponses as $response)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow duration-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $response->project_type)) }}</h3>
                                <p class="text-sm text-gray-500">ID: {{ $response->id }}</p>
                            </div>
                            @if ($response->status === 'draft')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Brouillon
                                </span>
                            @elseif ($response->status === 'validated')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Validé
                                </span>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-2 mb-4 text-sm">
                            <div>
                                <p class="text-gray-500">Budget:</p>
                                <p class="font-medium">{{ $response->budget_range }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Délai:</p>
                                <p class="font-medium">{{ $response->timeline }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-500">Date de création:</p>
                                <p class="font-medium">{{ $response->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-100">
                            <a href="{{ url('/client-response/' . $response->id) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-md text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Voir
                            </a>

                            <a href="{{ url('/pdf/generate/' . $response->id) }}" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-md text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                PDF
                            </a>

                            @if(Auth::user()->hasPermission('validate_technical_sheets') && $response->status === 'draft')
                                <form method="POST" action="{{ route('technical-sheets.validate', $response->id) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 rounded-md text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Valider
                                    </button>
                                </form>
                            @endif

                            @if(Auth::user()->isAdmin())
                                <form method="POST" action="{{ route('technical-sheets.admin.destroy', $response->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-md text-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette fiche technique ?')">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            @elseif(Auth::id() === $response->user_id)
                                <form method="POST" action="{{ route('technical-sheets.destroy', $response->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-md text-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette fiche technique ?')">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <div class="pagination-container">
                    {{ $clientResponses->links() }}
                </div>
            </div>

            <style>
                /* Amélioration du style de pagination */
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
            </style>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    // Script pour fermer les alertes
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner tous les boutons de fermeture d'alerte
        const closeButtons = document.querySelectorAll('[data-dismiss-target]');

        // Ajouter un écouteur d'événement à chaque bouton
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Trouver l'élément parent (l'alerte) et le masquer
                const alert = this.closest('[role="alert"]');
                if (alert) {
                    alert.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
