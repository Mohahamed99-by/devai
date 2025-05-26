<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Vérification Base de Données ===\n\n";

// Récupérer la dernière réponse client
$latest = \App\Models\ClientResponse::latest()->first();

if ($latest) {
    echo "Dernière réponse trouvée:\n";
    echo "ID: " . $latest->id . "\n";
    echo "Créée le: " . $latest->created_at . "\n";
    echo "Description: " . substr($latest->project_description, 0, 50) . "...\n\n";
    
    echo "Données d'analyse IA:\n";
    echo "- ai_analysis_summary: " . ($latest->ai_analysis_summary ? 'OUI (' . strlen($latest->ai_analysis_summary) . ' chars)' : 'VIDE') . "\n";
    echo "- ai_suggested_technologies: " . ($latest->ai_suggested_technologies ? 'OUI (' . count($latest->ai_suggested_technologies) . ' items)' : 'VIDE') . "\n";
    echo "- ai_suggested_features: " . ($latest->ai_suggested_features ? 'OUI (' . count($latest->ai_suggested_features) . ' items)' : 'VIDE') . "\n";
    echo "- ai_estimated_duration: " . ($latest->ai_estimated_duration ?: 'VIDE') . "\n";
    echo "- ai_cost_estimate: " . ($latest->ai_cost_estimate ?: 'VIDE') . "\n";
    echo "- ai_complexity_factors: " . ($latest->ai_complexity_factors ? 'OUI (' . count($latest->ai_complexity_factors) . ' items)' : 'VIDE') . "\n";
    
    if ($latest->ai_analysis_summary) {
        echo "\nContenu du résumé:\n";
        echo substr($latest->ai_analysis_summary, 0, 200) . "...\n";
    }
    
    if ($latest->ai_suggested_technologies) {
        echo "\nTechnologies suggérées:\n";
        foreach (array_slice($latest->ai_suggested_technologies, 0, 3) as $tech) {
            echo "- " . $tech . "\n";
        }
    }
    
} else {
    echo "Aucune réponse client trouvée dans la base de données.\n";
}

echo "\n=== Fin de la Vérification ===\n";
