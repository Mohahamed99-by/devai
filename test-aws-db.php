<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Test Connexion AWS RDS ===\n\n";

try {
    // Test de connexion
    $pdo = DB::connection()->getPdo();
    echo "✅ Connexion à AWS RDS réussie\n";
    echo "Driver: " . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . "\n";
    echo "Version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "\n\n";
    
    // Test des tables
    echo "📋 Vérification des tables:\n";
    $tables = DB::select("SHOW TABLES");
    foreach ($tables as $table) {
        $tableName = array_values((array)$table)[0];
        echo "- $tableName\n";
    }
    echo "\n";
    
    // Vérifier la structure de client_responses
    echo "🔍 Structure de la table client_responses:\n";
    $columns = DB::select("DESCRIBE client_responses");
    foreach ($columns as $column) {
        echo "- {$column->Field} ({$column->Type})\n";
    }
    echo "\n";
    
    // Compter les enregistrements
    $count = DB::table('client_responses')->count();
    echo "📊 Nombre d'enregistrements: $count\n\n";
    
    if ($count > 0) {
        // Récupérer le dernier enregistrement
        echo "🔍 Dernier enregistrement:\n";
        $latest = DB::table('client_responses')->latest('id')->first();
        
        echo "ID: {$latest->id}\n";
        echo "Description: " . substr($latest->project_description, 0, 50) . "...\n";
        echo "AI Summary: " . ($latest->ai_analysis_summary ? 'OUI (' . strlen($latest->ai_analysis_summary) . ' chars)' : 'VIDE') . "\n";
        echo "AI Technologies: " . ($latest->ai_suggested_technologies ? 'OUI' : 'VIDE') . "\n";
        echo "AI Features: " . ($latest->ai_suggested_features ? 'OUI' : 'VIDE') . "\n";
        echo "AI Duration: " . ($latest->ai_estimated_duration ?: 'VIDE') . "\n";
        echo "AI Cost: " . ($latest->ai_cost_estimate ?: 'VIDE') . "\n";
        
        if ($latest->ai_analysis_summary) {
            echo "\n📝 Contenu du résumé:\n";
            echo substr($latest->ai_analysis_summary, 0, 200) . "...\n";
        }
    }
    
} catch (\Exception $e) {
    echo "❌ Erreur de connexion: " . $e->getMessage() . "\n";
    echo "Type: " . get_class($e) . "\n";
}

echo "\n=== Fin du Test ===\n";
