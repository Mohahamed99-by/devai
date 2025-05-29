<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DiagnoseAssetsCommand extends Command
{
    protected $signature = 'assets:diagnose';
    protected $description = 'Diagnostiquer les problèmes d\'assets sur AWS';

    public function handle()
    {
        $this->info('🔍 Diagnostic des assets - DevsAI');
        $this->line('=====================================');

        // 1. Vérifier Vite
        $this->checkVite();
        
        // 2. Vérifier les assets compilés
        $this->checkCompiledAssets();
        
        // 3. Vérifier les permissions
        $this->checkPermissions();
        
        // 4. Vérifier la configuration
        $this->checkConfiguration();
        
        // 5. Proposer des solutions
        $this->proposeSolutions();

        return 0;
    }

    private function checkVite()
    {
        $this->info('1. Vérification de Vite...');
        
        if (File::exists(base_path('package.json'))) {
            $this->line('   ✅ package.json trouvé');
        } else {
            $this->error('   ❌ package.json manquant');
        }

        if (File::exists(base_path('vite.config.js'))) {
            $this->line('   ✅ vite.config.js trouvé');
        } else {
            $this->error('   ❌ vite.config.js manquant');
        }

        if (File::exists(base_path('node_modules'))) {
            $this->line('   ✅ node_modules présent');
        } else {
            $this->warn('   ⚠️  node_modules manquant - Exécuter: npm install');
        }
    }

    private function checkCompiledAssets()
    {
        $this->info('2. Vérification des assets compilés...');
        
        $buildPath = public_path('build');
        if (File::exists($buildPath)) {
            $this->line('   ✅ Dossier build trouvé');
            
            $manifestPath = $buildPath . '/manifest.json';
            if (File::exists($manifestPath)) {
                $this->line('   ✅ Manifest trouvé');
                
                $manifest = json_decode(File::get($manifestPath), true);
                if (isset($manifest['resources/css/app.css'])) {
                    $this->line('   ✅ CSS compilé trouvé');
                } else {
                    $this->error('   ❌ CSS compilé manquant');
                }
                
                if (isset($manifest['resources/js/app.js'])) {
                    $this->line('   ✅ JS compilé trouvé');
                } else {
                    $this->error('   ❌ JS compilé manquant');
                }
            } else {
                $this->error('   ❌ Manifest manquant');
            }
        } else {
            $this->error('   ❌ Dossier build manquant - Exécuter: npm run build');
        }
    }

    private function checkPermissions()
    {
        $this->info('3. Vérification des permissions...');
        
        $buildPath = public_path('build');
        if (File::exists($buildPath)) {
            $perms = substr(sprintf('%o', fileperms($buildPath)), -4);
            if ($perms >= '0755') {
                $this->line("   ✅ Permissions OK ($perms)");
            } else {
                $this->warn("   ⚠️  Permissions insuffisantes ($perms)");
            }
        }
    }

    private function checkConfiguration()
    {
        $this->info('4. Vérification de la configuration...');
        
        $appUrl = config('app.url');
        $this->line("   APP_URL: $appUrl");
        
        $assetUrl = config('app.asset_url');
        if ($assetUrl) {
            $this->line("   ASSET_URL: $assetUrl");
        } else {
            $this->warn('   ⚠️  ASSET_URL non défini');
        }
        
        $appEnv = config('app.env');
        $this->line("   APP_ENV: $appEnv");
    }

    private function proposeSolutions()
    {
        $this->info('5. Solutions recommandées...');
        $this->line('   📝 Pour corriger les problèmes:');
        $this->line('   1. npm install');
        $this->line('   2. npm run build');
        $this->line('   3. sudo chown -R www-data:www-data public/build');
        $this->line('   4. sudo chmod -R 755 public/build');
        $this->line('   5. php artisan cache:clear');
        $this->line('   6. Redémarrer le serveur web');
    }
}
