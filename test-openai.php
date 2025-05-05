<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get the OpenAIService
$openAIService = $app->make(\App\Services\OpenAIService::class);

// Test a simple request
try {
    $result = $openAIService->analyzeProjectRequirements([
        'project_type' => 'Test',
        'project_description' => 'Test project',
        'target_audience' => ['test'],
        'key_features' => ['test'],
        'budget_range' => '$1000-$2000',
        'timeline' => '1 month',
        'technical_requirements' => ['PHP'],
        'needs_maintenance' => true
    ]);

    echo "Success! Result: " . json_encode($result, JSON_PRETTY_PRINT);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " (Line: " . $e->getLine() . ")\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
