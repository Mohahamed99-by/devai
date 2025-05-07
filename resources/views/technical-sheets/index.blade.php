@extends('layouts.app')

@section('title', 'Fiches Techniques - Générateur de Fiche Technique')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h1 class="text-2xl font-bold mb-6">
            @if(Auth::user()->isAdmin())
                Toutes les Fiches Techniques
            @else
                Mes Fiches Techniques
            @endif
        </h1>
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        
        @if ($clientResponses->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500">Aucune fiche technique trouvée.</p>
                <a href="{{ route('client-response.form') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Créer une nouvelle fiche
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">Type de Projet</th>
                            <th class="py-3 px-4 text-left">Budget</th>
                            <th class="py-3 px-4 text-left">Délai</th>
                            <th class="py-3 px-4 text-left">Statut</th>
                            <th class="py-3 px-4 text-left">Date de Création</th>
                            <th class="py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientResponses as $response)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $response->id }}</td>
                                <td class="py-3 px-4">{{ ucfirst(str_replace('_', ' ', $response->project_type)) }}</td>
                                <td class="py-3 px-4">{{ $response->budget_range }}</td>
                                <td class="py-3 px-4">{{ $response->timeline }}</td>
                                <td class="py-3 px-4">
                                    @if ($response->status === 'draft')
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Brouillon</span>
                                    @elseif ($response->status === 'validated')
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Validé</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">{{ $response->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ url('/client-response/' . $response->id) }}" class="text-blue-500 hover:text-blue-700">
                                            Voir
                                        </a>
                                        
                                        <a href="{{ url('/pdf/generate/' . $response->id) }}" class="text-red-500 hover:text-red-700">
                                            PDF
                                        </a>
                                        
                                        @if(Auth::user()->hasPermission('validate_technical_sheets') && $response->status === 'draft')
                                            <form method="POST" action="{{ route('technical-sheets.validate', $response->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-green-500 hover:text-green-700">
                                                    Valider
                                                </button>
                                            </form>
                                        @endif

                                        @if(Auth::user()->isAdmin())
                                            <form method="POST" action="{{ route('technical-sheets.admin.destroy', $response->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette fiche technique ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        @elseif(Auth::id() === $response->user_id)
                                            <form method="POST" action="{{ route('technical-sheets.destroy', $response->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette fiche technique ?')">
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
            
            <div class="mt-4">
                {{ $clientResponses->links() }}
            </div>
        @endif
    </div>
@endsection
