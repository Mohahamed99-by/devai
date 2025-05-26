<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Test d'Analyse OpenAI ===\n\n";

// Données de test similaires à celles du formulaire
$testData = [
    'project_type' => 'web',
    'project_description' => 'jmjzdmz',
    'similar_applications' => 'zdzodjz',
    'target_audience' => ['clients', 'internal'],
    'key_features' => ['Réservation en ligne : Les utilisateurs peuvent sélectionner les services de jardinage, choisir une date et une heure pour l\'intervention.'],
    'budget_range' => '10000DH - 20000DH',
    'timeline' => '1-3 mois',
    'technical_requirements' => ['responsive', 'high_performance', 'security'],
    'needs_maintenance' => true
];

echo "1. Données de test:\n";
foreach ($testData as $key => $value) {
    if (is_array($value)) {
        echo "   - $key: " . implode(', ', $value) . "\n";
    } else {
        echo "   - $key: $value\n";
    }
}
echo "\n";

// Test du service OpenAI
echo "2. Test du Service OpenAI:\n";
try {
    $openAIService = $app->make(\App\Services\OpenAIService::class);
    echo "   - Service instancié: OUI\n";
    
    echo "   - Lancement de l'analyse...\n";
    $startTime = microtime(true);
    
    $result = $openAIService->analyzeProjectRequirements($testData);
    
    $endTime = microtime(true);
    $duration = round($endTime - $startTime, 2);
    
    echo "   - Durée d'analyse: {$duration}s\n";
    echo "   - Analyse terminée: " . (isset($result['error']) && $result['error'] ? 'NON' : 'OUI') . "\n";
    
    if (isset($result['error']) && $result['error']) {
        echo "   - ERREUR: " . $result['message'] . "\n";
    } else {
        echo "   - Résultats obtenus:\n";
        foreach ($result as $key => $value) {
            if (is_array($value)) {
                echo "     * $key: " . count($value) . " éléments\n";
                if (!empty($value)) {
                    echo "       - " . implode(', ', array_slice($value, 0, 2)) . (count($value) > 2 ? '...' : '') . "\n";
                }
            } else {
                echo "     * $key: " . (strlen($value) > 50 ? substr($value, 0, 50) . '...' : $value) . "\n";
            }
        }
    }
    
} catch (\Exception $e) {
    echo "   - ERREUR: " . $e->getMessage() . "\n";
    echo "   - Type: " . get_class($e) . "\n";
    echo "   - Trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== Fin du Test ===\n";
