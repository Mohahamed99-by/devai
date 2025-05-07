<?php

namespace App\Http\Controllers;

use App\Models\ClientResponse;
use App\Models\Role;
use App\Models\User;
use App\Notifications\TechnicalSheetStatusChanged;
use App\Services\OpenAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ClientResponseController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function showForm()
    {
        return view('client-response.form');
    }

    public function showFormModal()
    {
        return view('client-response.form-modal');
    }

    public function store(Request $request)
    {
        // Force JSON response
        $request->headers->set('Accept', 'application/json');

        try {
            $validator = Validator::make($request->all(), [
                'project_type' => 'required|string',
                'project_description' => 'required|string',
                'similar_applications' => 'nullable|string',
                'target_audience' => 'required|array',
                'user_roles' => 'nullable|array',
                'key_features' => 'required|array',
                'custom_features' => 'nullable|string',
                'budget_range' => 'required|string',
                'timeline' => 'required|string',
                'deadline' => 'nullable|date',
                'technical_requirements' => 'nullable|array',
                'external_apis' => 'nullable|string',
                'design_complexity' => 'nullable|string',
                'needs_maintenance' => 'boolean',
                'maintenance_type' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Prepare data for saving
            $validatedData = $validator->validated();

            // Convert arrays to JSON for storage
            $dataToSave = $validatedData;

            // Add user_id if user is authenticated
            if (Auth::check()) {
                $dataToSave['user_id'] = Auth::id();
            }

            // First save the client response
            $clientResponse = ClientResponse::create($dataToSave);

            // Notifier l'utilisateur de la création de sa fiche
            if (Auth::check()) {
                Auth::user()->notify(new TechnicalSheetStatusChanged(
                    $clientResponse,
                    'draft',
                    'Votre fiche technique a été créée avec succès.'
                ));
            }

            // Notifier les administrateurs de la nouvelle fiche
            $adminRole = Role::where('slug', 'admin')->first();
            if ($adminRole) {
                $admins = User::where('role_id', $adminRole->id)->get();
                Notification::send($admins, new TechnicalSheetStatusChanged(
                    $clientResponse,
                    'draft',
                    'Une nouvelle fiche technique a été créée et nécessite votre validation.'
                ));
            }

            // Get AI analysis
            $aiAnalysis = $this->openAIService->analyzeProjectRequirements($validatedData);

            if (isset($aiAnalysis['error'])) {
                Log::error('AI Analysis Error: ' . $aiAnalysis['message']);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to analyze requirements: ' . $aiAnalysis['message']
                ], 500);
            }

            // Update the client response with AI analysis
            $clientResponse->update([
                'ai_suggested_features' => $aiAnalysis['ai_suggested_features'] ?? [],
                'ai_suggested_technologies' => $aiAnalysis['ai_suggested_technologies'] ?? [],
                'ai_estimated_duration' => $aiAnalysis['ai_estimated_duration'] ?? '',
                'ai_analysis_summary' => $aiAnalysis['ai_analysis_summary'] ?? '',
                'ai_complexity_factors' => $aiAnalysis['ai_complexity_factors'] ?? [],
                'ai_cost_estimate' => $aiAnalysis['ai_cost_estimate'] ?? 0.00
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Project requirements analyzed successfully',
                'data' => $clientResponse,
                'id' => $clientResponse->id
            ]);

        } catch (\Exception $e) {
            Log::error('Client Response Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process requirements: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(ClientResponse $clientResponse)
    {
        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $clientResponse
            ]);
        }

        // Vérifier si l'utilisateur est autorisé à voir cette fiche technique
        if (Auth::check() && (Auth::user()->isAdmin() || Auth::id() === $clientResponse->user_id)) {
            return view('client-response.show', compact('clientResponse'));
        }

        // Si l'utilisateur n'est pas connecté ou n'est pas autorisé
        if (Auth::check()) {
            return redirect()->route('technical-sheets.index')
                ->with('error', 'Vous n\'êtes pas autorisé à voir cette fiche technique.');
        } else {
            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour voir cette fiche technique.');
        }
    }

    /**
     * Display a listing of the client's responses.
     */
    public function myResponses()
    {
        $user = Auth::user();

        // Si c'est un administrateur, afficher toutes les fiches
        if ($user->isAdmin()) {
            $clientResponses = ClientResponse::latest()->paginate(10);
        } else {
            // Sinon, afficher uniquement les fiches de l'utilisateur
            $clientResponses = $user->clientResponses()->latest()->paginate(10);
        }

        return view('client-response.my', compact('clientResponses'));
    }
}
