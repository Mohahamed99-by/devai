<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    public function __construct()
    {
        // No initialization needed, we'll use the OpenAI facade directly
    }

    public function generateChatResponse($messages, $options = [])
    {
        try {
            $response = OpenAI::chat()->create([
                'model' => config('openai.model', 'gpt-3.5-turbo'),
                'messages' => $messages,
                'temperature' => $options['temperature'] ?? 0.7,
                'max_tokens' => $options['max_tokens'] ?? 500,
            ]);

            if (isset($response->choices[0]->message->content)) {
                return $response->choices[0]->message->content;
            } else {
                Log::error('OpenAI API Error: Invalid response format');
                return "Désolé, je n'ai pas pu générer une réponse. Veuillez réessayer plus tard.";
            }
        } catch (\Exception $e) {
            Log::error('OpenAI Service Error: ' . $e->getMessage());
            return "Désolé, une erreur s'est produite. Veuillez réessayer plus tard.";
        }
    }

    public function generateSystemPrompt($user)
    {
        $prompt = "Vous êtes un assistant virtuel pour la plateforme de génération de fiches techniques. ";

        if ($user->isAdmin()) {
            $prompt .= "Vous aidez un administrateur de la plateforme à gérer les fiches techniques et à répondre aux questions des utilisateurs.";
        } else {
            $prompt .= "Vous aidez un utilisateur à comprendre comment utiliser la plateforme, à créer des fiches techniques et à comprendre les recommandations générées.";
        }

        $prompt .= " Répondez de manière concise et professionnelle en français. Si vous ne connaissez pas la réponse à une question, dites-le honnêtement.";

        return $prompt;
    }

    public function analyzeProjectRequirements(array $clientResponse): array
    {
        try {
            $prompt = $this->buildAnalysisPrompt($clientResponse);

            $response = OpenAI::chat()->create([
                'model' => config('openai.model', 'gpt-4'),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an expert software project analyzer. Analyze the project requirements and provide detailed technical recommendations in a structured JSON format.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 1000
            ]);

            if (!isset($response->choices[0]->message->content)) {
                throw new \Exception('Réponse OpenAI invalide: contenu manquant');
            }

            $content = $response->choices[0]->message->content;
            return $this->parseAIResponse($content);

        } catch (\Exception $e) {
            Log::error('OpenAI API Error: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    private function buildAnalysisPrompt(array $data): string
    {
        $prompt = "You are an expert software project analyzer with extensive experience in web, mobile, and software development.
        Analyze the following project requirements in detail and provide a comprehensive technical assessment.

        Please provide a JSON response with the following structure:
        {
            \"ai_suggested_features\": [
                {\"name\": \"Feature Name\", \"description\": \"Detailed description of the feature\", \"priority\": \"High/Medium/Low\"}
            ],
            \"ai_suggested_technologies\": {
                \"frontend\": [\"tech1\", \"tech2\"],
                \"backend\": [\"tech1\", \"tech2\"],
                \"database\": [\"tech1\", \"tech2\"],
                \"devops\": [\"tech1\", \"tech2\"],
                \"other\": [\"tech1\", \"tech2\"]
            },
            \"ai_estimated_duration\": {
                \"total\": \"X months\",
                \"breakdown\": {
                    \"planning\": \"X weeks\",
                    \"development\": \"X weeks\",
                    \"testing\": \"X weeks\",
                    \"deployment\": \"X weeks\"
                }
            },
            \"ai_analysis_summary\": \"Project analysis summary\",
            \"ai_detailed_analysis\": {
                \"strengths\": [\"strength1\", \"strength2\"],
                \"challenges\": [\"challenge1\", \"challenge2\"],
                \"opportunities\": [\"opportunity1\", \"opportunity2\"],
                \"risks\": [\"risk1\", \"risk2\"]
            },
            \"ai_complexity_factors\": [
                {\"factor\": \"Factor name\", \"impact\": \"Description of impact\", \"mitigation\": \"Mitigation strategy\"}
            ],
            \"ai_cost_estimate\": {
                \"total\": numeric_value,
                \"breakdown\": {
                    \"development\": numeric_value,
                    \"design\": numeric_value,
                    \"testing\": numeric_value,
                    \"deployment\": numeric_value,
                    \"maintenance\": numeric_value
                }
            },
            \"ai_recommendations\": [\"recommendation1\", \"recommendation2\"]
        }

        PROJECT DETAILS:
        Type: {$data['project_type']}
        Description: {$data['project_description']}";

        // Add similar applications if available
        if (!empty($data['similar_applications'])) {
            $prompt .= "\nSimilar Applications: {$data['similar_applications']}";
        }

        $prompt .= "\nTarget Audience: " . json_encode($data['target_audience']);

        // Add user roles if available
        if (!empty($data['user_roles'])) {
            $prompt .= "\nUser Roles: " . json_encode($data['user_roles']);
        }

        $prompt .= "\nKey Features: " . json_encode($data['key_features']);

        // Add custom features if available
        if (!empty($data['custom_features'])) {
            $prompt .= "\nAdditional Features: {$data['custom_features']}";
        }

        $prompt .= "\nBudget Range: {$data['budget_range']}
        Timeline: {$data['timeline']}";

        // Add deadline if available
        if (!empty($data['deadline'])) {
            $prompt .= "\nSpecific Deadline: {$data['deadline']}";
        }

        $prompt .= "\nTechnical Requirements: " . json_encode($data['technical_requirements']);

        // Add external APIs if available
        if (!empty($data['external_apis'])) {
            $prompt .= "\nExternal API Integrations: {$data['external_apis']}";
        }

        // Add design complexity if available
        if (!empty($data['design_complexity'])) {
            $prompt .= "\nUI/UX Design Complexity: {$data['design_complexity']}";
        }

        $prompt .= "\nNeeds Maintenance: " . json_encode($data['needs_maintenance']);

        // Add maintenance type if available
        if (!empty($data['maintenance_type'])) {
            $prompt .= "\nMaintenance Type: " . json_encode($data['maintenance_type']);
        }

        $prompt .= "\n\nBased on the above information, provide a detailed analysis including:
        1. A comprehensive list of suggested features that would benefit this project, with detailed descriptions and priority levels
        2. Recommended technologies for frontend, backend, database, DevOps, and any other relevant components, with justification for each choice
        3. A realistic timeline estimation with a breakdown of different phases (planning, development, testing, deployment)
        4. A detailed analysis of the project's strengths, challenges, opportunities, and risks
        5. Key complexity factors that might impact development, their potential impact, and mitigation strategies
        6. A detailed cost estimate breakdown based on industry standards for similar projects
        7. Specific recommendations to ensure project success

        Your analysis should be thorough and detailed, providing actionable insights that would help the client make informed decisions about their project. Consider industry best practices, current technology trends, and potential future scalability needs.

        Ensure your response is in valid JSON format as specified above. Make sure to provide detailed explanations rather than just brief statements.";

        return $prompt;
    }

    private function parseAIResponse(string $response): array
    {
        try {
            $decoded = json_decode($response, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                // Process suggested features - flatten if needed
                $features = $decoded['ai_suggested_features'] ?? [];
                $processedFeatures = [];

                if (is_array($features)) {
                    // Check if we have the new detailed format or the old simple format
                    if (isset($features[0]) && is_array($features[0]) && isset($features[0]['name'])) {
                        // New detailed format - keep as is
                        $processedFeatures = $features;
                    } else {
                        // Old simple format or unexpected format - use as is
                        $processedFeatures = $features;
                    }
                }

                // Process technologies - handle both object and array formats
                $technologies = $decoded['ai_suggested_technologies'] ?? [];
                $processedTechnologies = [];

                if (is_array($technologies)) {
                    if (isset($technologies['frontend']) || isset($technologies['backend'])) {
                        // New format with categories - flatten with prefixes
                        foreach ($technologies as $category => $techs) {
                            if (is_array($techs)) {
                                foreach ($techs as $tech) {
                                    $processedTechnologies[] = "[$category] $tech";
                                }
                            }
                        }
                    } else {
                        // Old simple format or unexpected format - use as is
                        $processedTechnologies = $technologies;
                    }
                }

                // Process duration - handle both string and object formats
                $duration = $decoded['ai_estimated_duration'] ?? '';
                $processedDuration = '';

                if (is_array($duration) && isset($duration['total'])) {
                    // New detailed format
                    $processedDuration = $duration['total'];
                    if (isset($duration['breakdown']) && is_array($duration['breakdown'])) {
                        $processedDuration .= " (";
                        $breakdownParts = [];
                        foreach ($duration['breakdown'] as $phase => $time) {
                            $breakdownParts[] = "$phase: $time";
                        }
                        $processedDuration .= implode(', ', $breakdownParts) . ")";
                    }
                } else {
                    // Old simple format or unexpected format
                    $processedDuration = is_string($duration) ? $duration : '';
                }

                // Process complexity factors - handle both simple and detailed formats
                $factors = $decoded['ai_complexity_factors'] ?? [];
                $processedFactors = [];

                if (is_array($factors)) {
                    if (isset($factors[0]) && is_array($factors[0]) && isset($factors[0]['factor'])) {
                        // New detailed format
                        foreach ($factors as $factorObj) {
                            $factor = $factorObj['factor'] ?? '';
                            $impact = $factorObj['impact'] ?? '';
                            $mitigation = $factorObj['mitigation'] ?? '';

                            $processedFactors[] = "$factor - Impact: $impact" . ($mitigation ? " - Mitigation: $mitigation" : "");
                        }
                    } else {
                        // Old simple format or unexpected format
                        $processedFactors = $factors;
                    }
                }

                // Process cost estimate - handle both numeric and object formats
                $costEstimate = $decoded['ai_cost_estimate'] ?? 0;
                $processedCostEstimate = 0;

                if (is_array($costEstimate) && isset($costEstimate['total'])) {
                    // New detailed format
                    $processedCostEstimate = floatval($costEstimate['total']);
                } else {
                    // Old simple format or unexpected format
                    $processedCostEstimate = floatval($costEstimate);
                }

                // Get detailed analysis if available
                $detailedAnalysis = $decoded['ai_detailed_analysis'] ?? null;
                $recommendations = $decoded['ai_recommendations'] ?? [];

                return [
                    'ai_suggested_features' => $processedFeatures,
                    'ai_suggested_technologies' => $processedTechnologies,
                    'ai_estimated_duration' => $processedDuration,
                    'ai_analysis_summary' => $decoded['ai_analysis_summary'] ?? '',
                    'ai_complexity_factors' => $processedFactors,
                    'ai_cost_estimate' => $processedCostEstimate,
                    'ai_detailed_analysis' => $detailedAnalysis,
                    'ai_recommendations' => $recommendations
                ];
            }

            Log::warning('Failed to parse JSON response from OpenAI', ['response' => $response]);
            return $this->extractStructuredData($response);

        } catch (\Exception $e) {
            Log::error('Error parsing AI response: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => 'Failed to parse AI response'
            ];
        }
    }

    private function extractStructuredData(string $response): array
    {
        return [
            'ai_suggested_features' => $this->extractFeatures($response),
            'ai_suggested_technologies' => $this->extractTechnologies($response),
            'ai_estimated_duration' => $this->extractDuration($response),
            'ai_analysis_summary' => $this->summarizeAnalysis($response),
            'ai_complexity_factors' => $this->extractComplexityFactors($response),
            'ai_cost_estimate' => $this->extractCostEstimate($response)
        ];
    }

    private function extractFeatures(string $response): array
    {
        preg_match_all('/(?:features?|functionality):\s*(.*?)(?=\n\n|\n[A-Z]|\z)/si', $response, $matches);
        return array_map('trim', $matches[1] ?? []);
    }

    private function extractTechnologies(string $response): array
    {
        preg_match_all('/(?:technolog(?:y|ies)|stack|tools):\s*(.*?)(?=\n\n|\n[A-Z]|\z)/si', $response, $matches);
        return array_map('trim', $matches[1] ?? []);
    }

    private function extractDuration(string $response): string
    {
        preg_match('/(?:duration|timeline|timeframe):\s*(.*?)(?=\n|\z)/i', $response, $match);
        return trim($match[1] ?? '');
    }

    private function summarizeAnalysis(string $response): string
    {
        preg_match('/^(?!.*?(?:features|technologies|duration|complexity|cost)).*?(?=\n\n|\z)/s', $response, $match);
        return trim($match[0] ?? '');
    }

    private function extractComplexityFactors(string $response): array
    {
        preg_match_all('/(?:complexity|challenges|considerations).*?[:-]\s*(.*?)(?=\n\n|\n[A-Z]|\z)/si', $response, $matches);
        return array_map('trim', $matches[1] ?? []);
    }

    private function extractCostEstimate(string $response): float
    {
        preg_match('/(?:cost|budget|estimate).*?[\$£€]?\s*([\d,]+(?:\.\d{2})?)/i', $response, $match);
        return floatval(str_replace(',', '', $match[1] ?? 0));
    }
}