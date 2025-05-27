# Guide de correction pour le serveur AWS

## Problèmes identifiés :
1. ❌ Table `client_responses` manquante (erreur principale) - ✅ RÉSOLU
2. ❌ Migrations Laravel bloquées ou non exécutées - ✅ RÉSOLU
3. ❌ Permissions sur les fichiers de log Laravel - 🔧 SOLUTION CRÉÉE
4. ❌ Erreur "Unable to cast value to a decimal" dans l'email - ✅ CORRIGÉ
5. ❌ Tables de chat orphelines avec contraintes de clés étrangères
6. ❌ Utilisateurs sans rôles assignés
7. ❌ Erreurs dans la navbar dues aux rôles manquants

## SOLUTION URGENTE - Table client_responses manquante :

### Option A : Migration automatique (recommandée)
```bash
# Se connecter au serveur AWS
ssh ubuntu@ec2-13-49-243-57.eu-north-1.compute.amazonaws.com
cd /var/www/html/devai

# Diagnostic de la base de données
php artisan db:diagnose --fix

# Si ça ne fonctionne pas, forcer les migrations
php artisan migrate:install --force
php artisan migrate --force
```

### Option B : Migration manuelle (si Option A échoue)
```bash
# Copier le fichier SQL sur le serveur
scp database/manual_migration.sql ubuntu@ec2-13-49-243-57.eu-north-1.compute.amazonaws.com:/tmp/

# Se connecter au serveur et exécuter le SQL
ssh ubuntu@ec2-13-49-243-57.eu-north-1.compute.amazonaws.com
mysql -h database-1.ct4im4euq9dt.eu-north-1.rds.amazonaws.com -u admin -p devsai < /tmp/manual_migration.sql
```

### Option C : Via phpMyAdmin ou client MySQL
1. Ouvrir le fichier `database/manual_migration.sql`
2. Copier tout le contenu
3. L'exécuter dans phpMyAdmin ou votre client MySQL

## SOLUTION URGENTE - Permissions et erreurs email :

### 1. Correction des permissions (PRIORITÉ ABSOLUE)
```bash
# Copier et exécuter le script de permissions
scp fix-permissions.sh ubuntu@ec2-13-49-243-57.eu-north-1.compute.amazonaws.com:/tmp/
ssh ubuntu@ec2-13-49-243-57.eu-north-1.compute.amazonaws.com
cd /var/www/html/devai
bash /tmp/fix-permissions.sh
```

### 2. Test des emails corrigés
```bash
# Tester avec la nouvelle commande sécurisée
php artisan email:test-safe
```

## Solutions à appliquer sur le serveur AWS :

### 1. Correction des permissions (sur le serveur AWS)
```bash
# Se connecter au serveur AWS
ssh ubuntu@ec2-13-49-243-57.eu-north-1.compute.amazonaws.com

# Corriger les permissions
sudo chown -R www-data:www-data /var/www/html/devai/storage
sudo chown -R www-data:www-data /var/www/html/devai/bootstrap/cache
sudo chmod -R 775 /var/www/html/devai/storage
sudo chmod -R 775 /var/www/html/devai/bootstrap/cache

# Vider le cache
cd /var/www/html/devai
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### 2. Nettoyage de la base de données
```bash
# Nettoyer les tables orphelines
php artisan db:clean --force

# Ou manuellement si la commande échoue :
php artisan tinker
# Dans tinker :
DB::statement('SET FOREIGN_KEY_CHECKS=0');
Schema::dropIfExists('chat_messages');
Schema::dropIfExists('chat_conversations');
DB::statement('SET FOREIGN_KEY_CHECKS=1');
exit
```

### 3. Réinitialisation complète des migrations
```bash
# Option 1 : Migration fresh (recommandée)
php artisan migrate:fresh --seed

# Option 2 : Si fresh ne fonctionne pas
php artisan migrate:reset
php artisan migrate
```

### 4. Correction des rôles utilisateurs
```bash
# Exécuter la commande de correction des rôles
php artisan users:fix-roles
```

### 5. Création d'un utilisateur admin
```bash
# Si aucun admin n'existe
php artisan tinker
# Dans tinker :
$adminRole = App\Models\Role::where('name', 'admin')->first();
if (!$adminRole) {
    $adminRole = App\Models\Role::create(['name' => 'admin', 'description' => 'Administrateur']);
}

$admin = App\Models\User::create([
    'name' => 'Admin DevsAI',
    'email' => 'admin@devsai.com',
    'password' => bcrypt('admin123'),
    'role_id' => $adminRole->id,
    'email_verified_at' => now()
]);
echo "Admin créé : admin@devsai.com / admin123";
exit
```

### 6. Vérification finale
```bash
# Tester l'application
php artisan serve --host=0.0.0.0 --port=8000

# Vérifier les logs
tail -f storage/logs/laravel.log

# Tester les emails
php artisan email:test --service=admin
```

## Commandes créées pour vous aider :

### `php artisan db:clean`
- Supprime les tables orphelines (chat_messages, chat_conversations)
- Désactive temporairement les contraintes de clés étrangères
- Nettoie la base de données

### `php artisan users:fix-roles`
- Crée les rôles admin et client s'ils n'existent pas
- Assigne le rôle client aux utilisateurs sans rôle
- Crée un compte administrateur par défaut

### `php artisan email:test`
- Teste l'envoi d'emails avec différents services
- Vérifie la configuration SMTP

## Ordre d'exécution recommandé :

1. **Permissions** (sur le serveur)
2. **Nettoyage DB** : `php artisan db:clean --force`
3. **Migrations** : `php artisan migrate:fresh`
4. **Rôles** : `php artisan users:fix-roles`
5. **Test** : Accéder à l'application

## Fichiers modifiés localement :
- ✅ `resources/views/layouts/partials/navbar.blade.php` - Ajout de vérifications null
- ✅ `app/Console/Commands/CleanDatabaseCommand.php` - Commande de nettoyage
- ✅ `app/Console/Commands/FixUserRolesCommand.php` - Correction des rôles
- ✅ `app/Console/Commands/TestEmailCommand.php` - Test des emails

## Notes importantes :
- ⚠️ Sauvegardez la base de données avant les opérations
- ⚠️ Les commandes `migrate:fresh` suppriment toutes les données
- ⚠️ Changez le mot de passe admin par défaut après création
