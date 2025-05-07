@extends('layouts.app')

@section('title', 'Tableau de Bord Admin - Générateur de Fiche Technique')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .stat-card {
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .gradient-border {
        position: relative;
        border-radius: 0.75rem;
        background: linear-gradient(white, white) padding-box,
                    linear-gradient(to right, #4F46E5, #7C3AED) border-box;
        border: 2px solid transparent;
    }
    
    .chart-container {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .chart-container:hover {
        transform: scale(1.02);
    }
    
    .project-row {
        transition: all 0.2s ease;
    }
    
    .project-row:hover {
        background-color: #F9FAFB;
    }
    
    .pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
        }
    }
</style>
@endpush

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Tableau de Bord</h1>
        <p class="text-gray-600">Bienvenue dans votre espace administrateur, gérez vos fiches techniques et suivez les statistiques.</p>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 stat-card border-l-4 border-indigo-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 mr-4">
                    <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-500 mb-1">Projets Analysés</div>
                    <div class="flex items-center">
                        <span class="text-3xl font-bold text-gray-800">{{ $totalProjects }}</span>
                        <span class="ml-2 text-sm font-medium text-green-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            12%
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6 stat-card border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 mr-4">
                    <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-500 mb-1">Clients</div>
                    <div class="flex items-center">
                        <span class="text-3xl font-bold text-gray-800">{{ $totalClients }}</span>
                        <span class="ml-2 text-sm font-medium text-green-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            8%
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6 stat-card border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 mr-4">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-500 mb-1">En Attente</div>
                    <div class="flex items-center">
                        <span class="text-3xl font-bold text-gray-800">{{ $pendingProjects->count() }}</span>
                        @if($pendingProjects->count() > 5)
                            <span class="ml-2 text-sm font-medium text-yellow-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Attention
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6 stat-card border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 mr-4 pulse">
                    <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-500 mb-1">Urgents</div>
                    <div class="flex items-center">
                        <span class="text-3xl font-bold text-gray-800">{{ $urgentProjects->count() }}</span>
                        @if($urgentProjects->count() > 0)
                            <span class="ml-2 text-sm font-medium text-red-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                Action requise
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Project Types Chart -->
        <div class="bg-white rounded-xl shadow-md p-6 chart-container gradient-border">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>
                Types de Projets
            </h2>
            <div class="h-64">
                <canvas id="projectTypesChart"></canvas>
            </div>
        </div>
        
        <!-- Monthly Stats Chart -->
        <div class="bg-white rounded-xl shadow-md p-6 chart-container gradient-border">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                </svg>
                Projets par Mois
            </h2>
            <div class="h-64">
                <canvas id="monthlyStatsChart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Projects -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Nouveaux Projets
                </h2>
                <a href="{{ route('technical-sheets.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 flex items-center">
                    Voir tout
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            
            @if($newProjects->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-gray-500">Aucun nouveau projet.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($newProjects as $project)
                                <tr class="project-row">
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900">#{{ $project->id }}</span>
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full 
                                            @if($project->project_type == 'web') bg-blue-100 text-blue-800
                                            @elseif($project->project_type == 'mobile') bg-green-100 text-green-800
                                            @elseif($project->project_type == 'desktop') bg-purple-100 text-purple-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $project->project_type)) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $project->user->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-500">{{ $project->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <a href="{{ url('/client-response/' . $project->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                            Voir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        
        <!-- Urgent Projects -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Projets Urgents
                </h2>
                <a href="{{ route('technical-sheets.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 flex items-center">
                    Voir tout
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            
            @if($urgentProjects->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-gray-500">Aucun projet urgent.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($urgentProjects as $project)
                                <tr class="project-row">
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900">#{{ $project->id }}</span>
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full 
                                            @if($project->project_type == 'web') bg-blue-100 text-blue-800
                                            @elseif($project->project_type == 'mobile') bg-green-100 text-green-800
                                            @elseif($project->project_type == 'desktop') bg-purple-100 text-purple-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $project->project_type)) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $project->user->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-red-600">{{ $project->deadline->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <a href="{{ url('/client-response/' . $project->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                            Voir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Project Types Chart
        const projectTypesCtx = document.getElementById('projectTypesChart').getContext('2d');
        const projectTypesChart = new Chart(projectTypesCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($projectTypeStats->pluck('type')) !!},
                datasets: [{
                    data: {!! json_encode($projectTypeStats->pluck('count')) !!},
                    backgroundColor: [
                        '#4F46E5', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        displayColors: false
                    }
                }
            }
        });
        
        // Monthly Stats Chart
        const monthlyStatsCtx = document.getElementById('monthlyStatsChart').getContext('2d');
        const monthlyStatsChart = new Chart(monthlyStatsCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyStats->pluck('month')) !!},
                datasets: [{
                    label: 'Nombre de projets',
                    data: {!! json_encode($monthlyStats->pluck('count')) !!},
                    backgroundColor: 'rgba(79, 70, 229, 0.8)',
                    borderColor: '#4F46E5',
                    borderWidth: 1,
                    borderRadius: 6,
                    barThickness: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        displayColors: false
                    }
                }
            }
        });
    });
</script>
@endpush
