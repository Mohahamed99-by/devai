#!/bin/bash

# Script de correction des permissions pour DevsAI sur AWS
# À exécuter sur le serveur AWS

echo "=== Correction des permissions DevsAI ==="
echo ""

# Vérifier si on est dans le bon répertoire
if [ ! -f "artisan" ]; then
    echo "❌ Erreur: Ce script doit être exécuté depuis le répertoire racine de Laravel"
    echo "   Utilisez: cd /var/www/html/devai && bash fix-permissions.sh"
    exit 1
fi

echo "📁 Répertoire actuel: $(pwd)"
echo ""

# Correction des permissions pour storage
echo "1. Correction des permissions pour storage..."
sudo chown -R www-data:www-data storage/
sudo chmod -R 775 storage/
echo "   ✅ Permissions storage corrigées"

# Correction des permissions pour bootstrap/cache
echo "2. Correction des permissions pour bootstrap/cache..."
sudo chown -R www-data:www-data bootstrap/cache/
sudo chmod -R 775 bootstrap/cache/
echo "   ✅ Permissions bootstrap/cache corrigées"

# Créer le fichier de log s'il n'existe pas
echo "3. Vérification du fichier de log..."
if [ ! -f "storage/logs/laravel.log" ]; then
    echo "   📝 Création du fichier laravel.log..."
    sudo touch storage/logs/laravel.log
fi
sudo chown www-data:www-data storage/logs/laravel.log
sudo chmod 664 storage/logs/laravel.log
echo "   ✅ Fichier de log configuré"

# Vider les caches
echo "4. Nettoyage des caches..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
echo "   ✅ Caches nettoyés"

# Optimisation pour la production
echo "5. Optimisation pour la production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "   ✅ Optimisations appliquées"

# Vérification finale
echo "6. Vérification finale..."
echo "   Propriétaire storage/logs: $(ls -la storage/logs/laravel.log 2>/dev/null || echo 'Fichier non trouvé')"
echo "   Permissions storage: $(ls -ld storage/ | awk '{print $1}')"
echo "   Permissions bootstrap/cache: $(ls -ld bootstrap/cache/ | awk '{print $1}')"

echo ""
echo "✅ Correction des permissions terminée !"
echo ""
echo "🧪 Test recommandé:"
echo "   php artisan email:test --service=admin"
echo ""
