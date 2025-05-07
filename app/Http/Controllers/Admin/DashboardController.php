<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientResponse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Nombre total de projets analysés
        $totalProjects = ClientResponse::count();
        
        // Nombre d'utilisateurs clients
        $totalClients = User::whereHas('role', function($query) {
            $query->where('slug', 'client');
        })->count();
        
        // Statistiques sur les types de projets
        $projectTypeStats = ClientResponse::select('project_type', DB::raw('count(*) as total'))
            ->groupBy('project_type')
            ->get()
            ->map(function($item) {
                return [
                    'type' => ucfirst(str_replace('_', ' ', $item->project_type)),
                    'count' => $item->total
                ];
            });
        
        // Nouveaux projets (créés dans les 7 derniers jours)
        $newProjects = ClientResponse::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Projets en attente (status = draft)
        $pendingProjects = ClientResponse::where('status', 'draft')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Projets urgents (avec deadline dans les 7 prochains jours)
        $urgentProjects = ClientResponse::whereNotNull('deadline')
            ->where('deadline', '<=', Carbon::now()->addDays(7))
            ->where('deadline', '>=', Carbon::now())
            ->orderBy('deadline', 'asc')
            ->take(5)
            ->get();
        
        // Projets incomplets (sans certains champs importants)
        $incompleteProjects = ClientResponse::where(function($query) {
            $query->whereNull('project_description')
                ->orWhereNull('budget_range')
                ->orWhereNull('timeline');
        })
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
        
        // Statistiques mensuelles (nombre de projets par mois)
        $monthlyStats = ClientResponse::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->take(6)
        ->get()
        ->map(function($item) {
            $date = Carbon::createFromDate($item->year, $item->month, 1);
            return [
                'month' => $date->format('M Y'),
                'count' => $item->total
            ];
        });
        
        return view('admin.dashboard', compact(
            'totalProjects',
            'totalClients',
            'projectTypeStats',
            'newProjects',
            'pendingProjects',
            'urgentProjects',
            'incompleteProjects',
            'monthlyStats'
        ));
    }
}
