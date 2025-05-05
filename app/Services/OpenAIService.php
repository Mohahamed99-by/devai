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
            \"ai_suggested_features\": [\"feature1\", \"feature2\"],
            \"ai_suggested_technologies\": [\"tech1\", \"tech2\"],
            \"ai_estimated_duration\": \"X months\",
            \"ai_analysis_summary\": \"Project analysis summary\",
            \"ai_complexity_factors\": [\"factor1\", \"factor2\"],
            \"ai_cost_estimate\": numeric_value
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
        1. A comprehensive list of suggested features that would benefit this project
        2. Recommended technologies for frontend, backend, database, and any other relevant components
        3. A realistic timeline estimation considering the scope and complexity
        4. A summary analysis of the project's feasibility, challenges, and opportunities
        5. Key complexity factors that might impact development
        6. A cost estimate range based on industry standards for similar projects

        Ensure your response is in valid JSON format as specified above.";

        return $prompt;
    }

    private function parseAIResponse(string $response): array
    {
        try {
            $decoded = json_decode($response, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return [
                    'ai_suggested_features' => $decoded['ai_suggested_features'] ?? [],
                    'ai_suggested_technologies' => $decoded['ai_suggested_technologies'] ?? [],
                    'ai_estimated_duration' => $decoded['ai_estimated_duration'] ?? '',
                    'ai_analysis_summary' => $decoded['ai_analysis_summary'] ?? '',
                    'ai_complexity_factors' => $decoded['ai_complexity_factors'] ?? [],
                    'ai_cost_estimate' => floatval($decoded['ai_cost_estimate'] ?? 0)
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