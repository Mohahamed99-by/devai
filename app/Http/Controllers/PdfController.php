<?php

namespace App\Http\Controllers;

use App\Models\ClientResponse;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf(ClientResponse $clientResponse)
    {
        // Préparer les données enrichies pour le PDF
        $data = [
            'clientResponse' => $clientResponse,
            'generatedAt' => now(),
            'projectStats' => $this->calculateProjectStats($clientResponse),
            'riskAssessment' => $this->assessProjectRisks($clientResponse),
            'recommendations' => $this->formatRecommendations($clientResponse)
        ];

        $pdf = PDF::loadView('pdf.technical-specification', $data);

        // Configuration du PDF
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);

        $fileName = 'fiche-technique-' . ($clientResponse->project_name ?? 'projet') . '-' . $clientResponse->id . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * Calculer les statistiques du projet
     */
    private function calculateProjectStats(ClientResponse $clientResponse)
    {
        $stats = [
            'total_features' => 0,
            'complexity_score' => 0,
            'estimated_team_size' => 1,
            'risk_level' => 'low'
        ];

        // Compter les fonctionnalités
        if ($clientResponse->key_features) {
            $stats['total_features'] += count($clientResponse->key_features);
        }
        if ($clientResponse->ai_suggested_features) {
            $stats['total_features'] += count($clientResponse->ai_suggested_features);
        }

        // Calculer le score de complexité
        $complexityFactors = 0;
        if ($clientResponse->technical_requirements) {
            $complexityFactors += count($clientResponse->technical_requirements);
        }
        if ($clientResponse->ai_complexity_factors) {
            $complexityFactors += count($clientResponse->ai_complexity_factors);
        }

        $stats['complexity_score'] = min(10, $complexityFactors);

        // Estimer la taille de l'équipe
        if ($stats['complexity_score'] >= 7) {
            $stats['estimated_team_size'] = '4-6 développeurs';
            $stats['risk_level'] = 'high';
        } elseif ($stats['complexity_score'] >= 4) {
            $stats['estimated_team_size'] = '2-3 développeurs';
            $stats['risk_level'] = 'medium';
        } else {
            $stats['estimated_team_size'] = '1-2 développeurs';
            $stats['risk_level'] = 'low';
        }

        return $stats;
    }

    /**
     * Évaluer les risques du projet
     */
    private function assessProjectRisks(ClientResponse $clientResponse)
    {
        $risks = [];

        // Risques liés au budget
        if (strpos(strtolower($clientResponse->budget_range ?? ''), 'moins') !== false) {
            $risks[] = [
                'type' => 'Budget',
                'level' => 'high',
                'description' => 'Budget potentiellement insuffisant pour la complexité du projet'
            ];
        }

        // Risques liés au délai
        if (strpos(strtolower($clientResponse->timeline ?? ''), 'moins') !== false) {
            $risks[] = [
                'type' => 'Délai',
                'level' => 'medium',
                'description' => 'Délai serré qui pourrait impacter la qualité'
            ];
        }

        // Risques techniques
        if ($clientResponse->external_apis) {
            $risks[] = [
                'type' => 'Technique',
                'level' => 'medium',
                'description' => 'Dépendances externes pouvant affecter la stabilité'
            ];
        }

        return $risks;
    }

    /**
     * Formater les recommandations
     */
    private function formatRecommendations(ClientResponse $clientResponse)
    {
        $recommendations = [];

        if ($clientResponse->ai_recommendations && is_array($clientResponse->ai_recommendations)) {
            foreach ($clientResponse->ai_recommendations as $recommendation) {
                if (is_string($recommendation)) {
                    $recommendations[] = $recommendation;
                } elseif (is_array($recommendation) && isset($recommendation['text'])) {
                    $recommendations[] = $recommendation['text'];
                }
            }
        }

        // Ajouter des recommandations par défaut si aucune n'existe
        if (empty($recommendations)) {
            $recommendations = [
                'Effectuer une analyse détaillée des besoins avant le développement',
                'Prévoir des tests réguliers tout au long du projet',
                'Maintenir une communication constante avec le client',
                'Documenter le code et les processus métier'
            ];
        }

        return $recommendations;
    }
}
