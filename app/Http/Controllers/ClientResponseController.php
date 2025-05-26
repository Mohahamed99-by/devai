<?php

namespace App\Http\Controllers;

use App\Models\ClientResponse;
use App\Models\Role;
use App\Models\User;
use App\Notifications\TechnicalSheetStatusChanged;
use App\Services\AdminNotificationService;
use App\Services\OpenAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ClientResponseController extends Controller
{
    protected $openAIService;
    protected $adminNotificationService;

    public function __construct(OpenAIService $openAIService, AdminNotificationService $adminNotificationService)
    {
        $this->openAIService = $openAIService;
        $this->adminNotificationService = $adminNotificationService;
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

            // Générer un identifiant unique pour les utilisateurs non-authentifiés
            $tempIdentifier = null;

            // Add user_id if user is authenticated
            if (Auth::check()) {
                $dataToSave['user_id'] = Auth::id();
                $dataToSave['status'] = 'draft';
            } else {
                // Pour les utilisateurs non-authentifiés, générer un identifiant temporaire
                $tempIdentifier = Str::uuid()->toString();
                $dataToSave['status'] = 'temporary';

                // Stocker l'identifiant temporaire en session
                Session::put('temp_client_response_id', $tempIdentifier);
            }

            // First save the client response
            $clientResponse = ClientResponse::create($dataToSave);

            // Si c'est un utilisateur non-authentifié, stocker l'identifiant temporaire
            if (!Auth::check() && $tempIdentifier) {
                $clientResponse->temp_identifier = $tempIdentifier;
                $clientResponse->save();
            }

            // Notifier l'utilisateur de la création de sa fiche (seulement si authentifié)
            try {
                if (Auth::check()) {
                    Auth::user()->notify(new TechnicalSheetStatusChanged(
                        $clientResponse,
                        'draft',
                        'Votre fiche technique a été créée avec succès.'
                    ));

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
                }
            } catch (\Exception $e) {
                // Enregistrer l'erreur mais ne pas interrompre le processus
                Log::warning('Erreur lors de l\'envoi des notifications: ' . $e->getMessage());
            }

            // Get AI analysis
            try {
                Log::info('Début de l\'analyse IA pour la réponse client ID: ' . $clientResponse->id);
                $aiAnalysis = $this->openAIService->analyzeProjectRequirements($validatedData);

                if (isset($aiAnalysis['error'])) {
                    Log::error('AI Analysis Error: ' . $aiAnalysis['message']);
                    // Utiliser des données par défaut si l'analyse échoue
                    $aiAnalysis = $this->getDefaultAnalysis($validatedData);
                }

                // Sauvegarder l'analyse IA
                try {
                    $updateData = [
                        'ai_suggested_features' => $aiAnalysis['ai_suggested_features'] ?? [],
                        'ai_suggested_technologies' => $aiAnalysis['ai_suggested_technologies'] ?? [],
                        'ai_estimated_duration' => $aiAnalysis['ai_estimated_duration'] ?? '',
                        'ai_analysis_summary' => $aiAnalysis['ai_analysis_summary'] ?? '',
                        'ai_detailed_analysis' => $aiAnalysis['ai_detailed_analysis'] ?? [],
                        'ai_complexity_factors' => $aiAnalysis['ai_complexity_factors'] ?? [],
                        'ai_recommendations' => $aiAnalysis['ai_recommendations'] ?? [],
                        'ai_cost_estimate' => $aiAnalysis['ai_cost_estimate'] ?? 0.00
                    ];

                    $clientResponse->update($updateData);
                    Log::info('Analyse IA sauvegardée avec succès pour la réponse client ID: ' . $clientResponse->id);

                } catch (\Exception $dbError) {
                    Log::error('Erreur lors de la sauvegarde de l\'analyse IA: ' . $dbError->getMessage());

                    // Stocker temporairement les données en session si la DB échoue
                    Session::put('temp_ai_analysis_' . $clientResponse->id, $aiAnalysis);
                    Log::info('Analyse IA stockée temporairement en session');
                }

            } catch (\Exception $e) {
                Log::error('Erreur lors de l\'analyse IA: ' . $e->getMessage());

                // Utiliser des données par défaut et les stocker en session
                $defaultAnalysis = $this->getDefaultAnalysis($validatedData);
                Session::put('temp_ai_analysis_' . $clientResponse->id, $defaultAnalysis);
            }

            // Envoyer un seul e-mail de notification à l'administrateur
            $userName = Auth::check() ? Auth::user()->name : 'Utilisateur non-authentifié';
            $this->sendUnifiedAdminNotification($clientResponse, $userName);
            Log::info('Email de notification unifié envoyé à l\'administrateur');

            // Préparer la réponse
            $responseData = [
                'status' => 'success',
                'message' => 'Project requirements analyzed successfully',
                'data' => $clientResponse,
                'id' => $clientResponse->id
            ];

            // Ajouter des informations pour les utilisateurs non-authentifiés
            if (!Auth::check()) {
                $responseData['requires_login'] = true;
                $responseData['temp_identifier'] = $tempIdentifier;
                $responseData['redirect_url'] = route('client-response.confirmation', $clientResponse->id);
            } else {
                $responseData['redirect_url'] = route('client-response.show', $clientResponse->id);
            }

            return response()->json($responseData);

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
        // Récupérer les données d'analyse depuis la session si elles existent
        $tempAnalysis = Session::get('temp_ai_analysis_' . $clientResponse->id);

        // Si les données d'analyse sont vides en base mais existent en session, les utiliser
        if ($tempAnalysis && empty($clientResponse->ai_analysis_summary)) {
            // Fusionner les données temporaires avec l'objet clientResponse
            foreach ($tempAnalysis as $key => $value) {
                $clientResponse->$key = $value;
            }
            Log::info('Données d\'analyse récupérées depuis la session pour ID: ' . $clientResponse->id);
        }

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

        // Vérifier si c'est une fiche temporaire et si l'utilisateur a l'identifiant temporaire en session
        $tempIdentifier = Session::get('temp_client_response_id');
        if (!Auth::check() && $clientResponse->status === 'temporary' &&
            $tempIdentifier && $clientResponse->temp_identifier === $tempIdentifier) {
            // L'utilisateur non-authentifié peut voir sa propre fiche temporaire
            return view('client-response.show', [
                'clientResponse' => $clientResponse,
                'requiresRegistration' => true
            ]);
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

    /**
     * Afficher la page de confirmation après soumission du formulaire
     */
    public function showConfirmation(ClientResponse $clientResponse)
    {
        // Vérifier si c'est une fiche temporaire et si l'utilisateur a l'identifiant temporaire en session
        $tempIdentifier = Session::get('temp_client_response_id');

        if (!Auth::check() && $clientResponse->status === 'temporary' &&
            $tempIdentifier && $clientResponse->temp_identifier === $tempIdentifier) {
            // L'utilisateur non-authentifié peut voir sa page de confirmation
            return view('client-response.confirmation', [
                'clientResponseId' => $clientResponse->id
            ]);
        }

        // Si l'utilisateur est authentifié, rediriger vers la page des fiches techniques
        if (Auth::check()) {
            return redirect()->route('client-response.my')
                ->with('success', 'Votre fiche technique est disponible dans votre espace personnel.');
        }

        // Si l'utilisateur n'est pas authentifié et n'a pas l'identifiant temporaire, rediriger vers la fiche
        return redirect()->route('client-response.show', $clientResponse->id);
    }

    /**
     * Envoie une notification unifiée par email à l'administrateur
     *
     * @param ClientResponse $clientResponse
     * @param string $userName
     * @return void
     */
    protected function sendUnifiedAdminNotification(ClientResponse $clientResponse, string $userName)
    {
        try {
            // Utiliser le service d'administration pour envoyer un seul email
            $this->adminNotificationService->sendUnifiedNotification($clientResponse, $userName);

            // Trouver tous les administrateurs pour les notifications dans l'application
            $adminRole = Role::where('slug', 'admin')->first();
            $admins = $adminRole ? User::where('role_id', $adminRole->id)->get() : collect([]);

            // Envoyer la notification à chaque administrateur dans l'application
            foreach ($admins as $admin) {
                $admin->notify(new \App\Notifications\NewAnswerNotification($clientResponse));
            }

            Log::info('Notification unifiée envoyée à l\'administrateur', [
                'client_response_id' => $clientResponse->id
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de la notification unifiée à l\'administrateur', [
                'error' => $e->getMessage(),
                'client_response_id' => $clientResponse->id
            ]);
        }
    }

    /**
     * Méthode obsolète maintenue pour compatibilité
     * @deprecated Utiliser sendUnifiedAdminNotification à la place
     */
    protected function notifyAdminAboutNewAnswer(ClientResponse $clientResponse)
    {
        $userName = Auth::check() ? Auth::user()->name : 'Utilisateur non-authentifié';
        $this->sendUnifiedAdminNotification($clientResponse, $userName);
    }

    /**
     * Associer une réponse temporaire à un utilisateur après inscription
     */
    public function associateTemporaryResponse(Request $request)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vous devez être connecté pour associer une fiche technique.'
            ], 401);
        }

        // Récupérer l'identifiant temporaire depuis la session
        $tempIdentifier = Session::get('temp_client_response_id');

        if (!$tempIdentifier) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aucune fiche technique temporaire trouvée.'
            ], 404);
        }

        // Trouver la réponse temporaire
        $clientResponse = ClientResponse::where('temp_identifier', $tempIdentifier)
            ->where('status', 'temporary')
            ->first();

        if (!$clientResponse) {
            return response()->json([
                'status' => 'error',
                'message' => 'Fiche technique temporaire introuvable.'
            ], 404);
        }

        // Associer la réponse à l'utilisateur
        $clientResponse->user_id = Auth::id();
        $clientResponse->status = 'draft';
        $clientResponse->save();

        // Notifier l'utilisateur
        Auth::user()->notify(new TechnicalSheetStatusChanged(
            $clientResponse,
            'draft',
            'Votre fiche technique a été associée à votre compte avec succès.'
        ));

        // Notifier les administrateurs
        $adminRole = Role::where('slug', 'admin')->first();
        if ($adminRole) {
            $admins = User::where('role_id', $adminRole->id)->get();
            Notification::send($admins, new TechnicalSheetStatusChanged(
                $clientResponse,
                'draft',
                'Une nouvelle fiche technique a été associée à un utilisateur et nécessite votre validation.'
            ));
        }

        // Envoyer un seul e-mail de notification à l'administrateur
        $this->sendUnifiedAdminNotification($clientResponse, Auth::user()->name);
        Log::info('Email de notification unifié envoyé à l\'administrateur');

        // Supprimer l'identifiant temporaire de la session
        Session::forget('temp_client_response_id');

        return response()->json([
            'status' => 'success',
            'message' => 'Fiche technique associée avec succès.',
            'data' => $clientResponse
        ]);
    }

    /**
     * Générer une analyse par défaut basée sur les données du projet
     */
    private function getDefaultAnalysis($projectData)
    {
        $projectType = $projectData['project_type'] ?? 'web';
        $budget = $projectData['budget_range'] ?? '';
        $timeline = $projectData['timeline'] ?? '';

        // Technologies par défaut selon le type de projet
        $defaultTechnologies = [
            'web' => [
                '[Frontend] HTML5, CSS3, JavaScript, React/Vue.js',
                '[Backend] PHP/Laravel, Node.js',
                '[Base de données] MySQL, PostgreSQL',
                '[Sécurité] HTTPS, Authentification JWT'
            ],
            'mobile' => [
                '[Mobile] React Native, Flutter',
                '[Backend] Node.js, Firebase',
                '[Base de données] MongoDB, Firebase Firestore',
                '[Services] Push Notifications, Analytics'
            ],
            'desktop' => [
                '[Desktop] Electron, .NET, Java',
                '[Base de données] SQLite, PostgreSQL',
                '[Interface] Modern UI Framework',
                '[Sécurité] Encryption, Secure Storage'
            ]
        ];

        $technologies = $defaultTechnologies[strtolower($projectType)] ?? $defaultTechnologies['web'];

        // Estimation du budget basée sur la fourchette
        $estimatedCost = 15000.00;
        if (strpos($budget, '5000') !== false) {
            $estimatedCost = 7500.00;
        } elseif (strpos($budget, '10000') !== false) {
            $estimatedCost = 12500.00;
        } elseif (strpos($budget, '20000') !== false) {
            $estimatedCost = 25000.00;
        }

        // Durée estimée basée sur le timeline
        $estimatedDuration = '2-4 mois';
        if (strpos($timeline, '1-3') !== false) {
            $estimatedDuration = '2-3 mois';
        } elseif (strpos($timeline, '3-6') !== false) {
            $estimatedDuration = '4-6 mois';
        } elseif (strpos($timeline, '6+') !== false) {
            $estimatedDuration = '6-12 mois';
        }

        return [
            'ai_suggested_features' => [
                'Interface utilisateur moderne et intuitive',
                'Système de gestion des données robuste',
                'Fonctionnalités de sécurité avancées',
                'Optimisation des performances',
                'Responsive design pour tous les appareils'
            ],
            'ai_suggested_technologies' => $technologies,
            'ai_estimated_duration' => $estimatedDuration,
            'ai_analysis_summary' => "Projet {$projectType} nécessitant une approche structurée avec des technologies modernes. Le projet présente une complexité modérée et nécessitera une planification soignée pour respecter les délais et le budget. L'architecture proposée garantit la scalabilité et la maintenabilité.",
            'ai_complexity_factors' => [
                'Intégration de multiples fonctionnalités',
                'Exigences de performance et de sécurité',
                'Compatibilité multi-plateforme',
                'Gestion des données utilisateur',
                'Tests et validation qualité'
            ],
            'ai_cost_estimate' => $estimatedCost,
            'ai_detailed_analysis' => [
                'strengths' => [
                    'Projet bien défini avec des objectifs clairs',
                    'Technologies éprouvées et stables',
                    'Budget approprié pour les fonctionnalités demandées'
                ],
                'challenges' => [
                    'Intégration complexe de plusieurs composants',
                    'Optimisation des performances requise',
                    'Tests approfondis nécessaires'
                ]
            ],
            'ai_recommendations' => [
                'Utiliser un framework moderne pour accélérer le développement',
                'Implémenter des tests automatisés dès le début',
                'Prévoir une phase de test utilisateur approfondie',
                'Planifier la maintenance et les mises à jour post-lancement',
                'Documenter le code pour faciliter la maintenance future'
            ]
        ];
    }

    /**
     * Relancer l'analyse IA pour une fiche technique existante
     */
    public function reanalyze(ClientResponse $clientResponse)
    {
        try {
            Log::info('Relancement de l\'analyse IA pour la réponse client ID: ' . $clientResponse->id);

            // Préparer les données pour l'analyse
            $projectData = [
                'project_type' => $clientResponse->project_type,
                'project_description' => $clientResponse->project_description,
                'similar_applications' => $clientResponse->similar_applications,
                'target_audience' => $clientResponse->target_audience,
                'user_roles' => $clientResponse->user_roles,
                'key_features' => $clientResponse->key_features,
                'custom_features' => $clientResponse->custom_features,
                'budget_range' => $clientResponse->budget_range,
                'timeline' => $clientResponse->timeline,
                'deadline' => $clientResponse->deadline,
                'technical_requirements' => $clientResponse->technical_requirements,
                'external_apis' => $clientResponse->external_apis,
                'design_complexity' => $clientResponse->design_complexity,
                'needs_maintenance' => $clientResponse->needs_maintenance,
                'maintenance_type' => $clientResponse->maintenance_type,
            ];

            // Lancer l'analyse IA
            $aiAnalysis = null;
            try {
                $aiAnalysis = $this->openAIService->analyzeProjectRequirements($projectData);

                if (isset($aiAnalysis['error'])) {
                    Log::error('AI Analysis Error during reanalysis: ' . $aiAnalysis['message']);
                    $aiAnalysis = null;
                }
            } catch (\Exception $e) {
                Log::error('Erreur lors de la re-analyse IA: ' . $e->getMessage());
                $aiAnalysis = null;
            }

            // Si l'analyse IA a échoué, utiliser l'analyse par défaut
            if (!$aiAnalysis || isset($aiAnalysis['error'])) {
                Log::info('Utilisation de l\'analyse par défaut pour la re-analyse ID: ' . $clientResponse->id);
                $aiAnalysis = $this->getDefaultAnalysis($projectData);
            }

            // Sauvegarder la nouvelle analyse
            try {
                $updateData = [
                    'ai_suggested_features' => $aiAnalysis['ai_suggested_features'] ?? [],
                    'ai_suggested_technologies' => $aiAnalysis['ai_suggested_technologies'] ?? [],
                    'ai_estimated_duration' => $aiAnalysis['ai_estimated_duration'] ?? '',
                    'ai_analysis_summary' => $aiAnalysis['ai_analysis_summary'] ?? '',
                    'ai_detailed_analysis' => $aiAnalysis['ai_detailed_analysis'] ?? [],
                    'ai_complexity_factors' => $aiAnalysis['ai_complexity_factors'] ?? [],
                    'ai_recommendations' => $aiAnalysis['ai_recommendations'] ?? [],
                    'ai_cost_estimate' => $aiAnalysis['ai_cost_estimate'] ?? 0.00
                ];

                $clientResponse->update($updateData);
                Log::info('Re-analyse sauvegardée avec succès pour la réponse client ID: ' . $clientResponse->id);

                // Supprimer les données temporaires de la session
                Session::forget('temp_ai_analysis_' . $clientResponse->id);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Analyse IA mise à jour avec succès',
                    'redirect_url' => route('client-response.show', $clientResponse->id)
                ]);

            } catch (\Exception $dbError) {
                Log::error('Erreur lors de la sauvegarde de la re-analyse: ' . $dbError->getMessage());

                // Stocker temporairement les données en session si la DB échoue
                Session::put('temp_ai_analysis_' . $clientResponse->id, $aiAnalysis);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Analyse IA mise à jour (stockée temporairement)',
                    'redirect_url' => route('client-response.show', $clientResponse->id)
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Erreur lors de la re-analyse: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la mise à jour de l\'analyse: ' . $e->getMessage()
            ], 500);
        }
    }
}
