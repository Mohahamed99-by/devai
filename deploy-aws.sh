#!/bin/bash

echo "🚀 Déploiement complet sur AWS - DevsAI"
echo "======================================"

# Variables
SERVER_IP="ec2-13-49-243-57.eu-north-1.compute.amazonaws.com"
SERVER_USER="ubuntu"
PROJECT_PATH="/var/www/html/devai"

echo "1. Compilation des assets en local..."
npm install
npm run build

echo "2. Upload des fichiers vers le serveur..."
# Copier les assets compilés
scp -r public/build/ ${SERVER_USER}@${SERVER_IP}:${PROJECT_PATH}/public/

# Copier les fichiers de configuration
scp .env.production ${SERVER_USER}@${SERVER_IP}:${PROJECT_PATH}/.env
scp vite.config.js ${SERVER_USER}@${SERVER_IP}:${PROJECT_PATH}/
scp package.json ${SERVER_USER}@${SERVER_IP}:${PROJECT_PATH}/

echo "3. Exécution des commandes sur le serveur..."
ssh ${SERVER_USER}@${SERVER_IP} << 'EOF'
cd /var/www/html/devai

# Installation des dépendances
composer install --no-dev --optimize-autoloader

# Permissions
sudo chown -R www-data:www-data storage bootstrap/cache public/build
sudo chmod -R 775 storage bootstrap/cache
sudo chmod -R 755 public/build

# Cache Laravel
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Optimisation production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migrations
php artisan migrate --force

# Redémarrage des services
sudo systemctl restart apache2
# ou sudo systemctl restart nginx

echo "✅ Déploiement terminé sur le serveur !"
EOF

echo "4. Test de l'application..."
if curl -s http://${SERVER_IP} > /dev/null; then
    echo "   ✅ Application accessible"
else
    echo "   ❌ Application non accessible"
fi

echo ""
echo "✅ Déploiement terminé !"
echo "🌐 Votre application est disponible à : http://${SERVER_IP}"
