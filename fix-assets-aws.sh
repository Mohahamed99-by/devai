#!/bin/bash

echo "🚀 Correction des assets pour AWS - DevsAI"
echo "=========================================="

# Vérifier si nous sommes dans le bon répertoire
if [ ! -f "package.json" ]; then
    echo "❌ Erreur: package.json non trouvé. Assurez-vous d'être dans le répertoire du projet."
    exit 1
fi

echo "1. Installation des dépendances Node.js..."
npm install

echo "2. Compilation des assets pour la production..."
npm run build

echo "3. Optimisation des permissions..."
sudo chown -R www-data:www-data public/build
sudo chmod -R 755 public/build

echo "4. Nettoyage des caches Laravel..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

echo "5. Optimisation pour la production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "6. Vérification des assets..."
if [ -d "public/build" ]; then
    echo "   ✅ Dossier build créé"
    ls -la public/build/
else
    echo "   ❌ Erreur: Dossier build non créé"
fi

echo "7. Test de l'application..."
php artisan serve --host=0.0.0.0 --port=8000 &
SERVER_PID=$!
sleep 3

# Tester si le serveur répond
if curl -s http://localhost:8000 > /dev/null; then
    echo "   ✅ Serveur démarré avec succès"
else
    echo "   ❌ Erreur: Serveur ne répond pas"
fi

# Arrêter le serveur de test
kill $SERVER_PID 2>/dev/null

echo ""
echo "✅ Correction terminée !"
echo "📝 Prochaines étapes :"
echo "   1. Redémarrer votre serveur web (Apache/Nginx)"
echo "   2. Vérifier que les assets sont servis correctement"
echo "   3. Tester l'application dans le navigateur"
