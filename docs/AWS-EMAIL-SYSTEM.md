# 📧 Système de Notifications Email AWS - DevsAI

## 🎯 Vue d'ensemble

Le système de notifications email de DevsAI a été optimisé pour fonctionner parfaitement sur AWS avec des fallbacks robustes et une gestion d'erreurs avancée.

## 🏗️ Architecture

### Services Principaux

1. **AwsEmailService** - Service principal optimisé pour AWS
2. **AdminNotificationService** - Service de notifications administrateur
3. **MailService** - Service de fallback standard

### Ordre de Priorité des Services

1. **AWS SES** (Priorité 1) - Service email natif AWS
2. **SMTP Gmail** (Priorité 2) - Fallback principal
3. **Mailgun** (Priorité 3) - Fallback secondaire
4. **SendGrid** (Priorité 4) - Fallback tertiaire

## ⚙️ Configuration

### Variables d'Environnement

```env
# Configuration Email de Base
MAIL_ENABLED=true
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=mohamedtolba161@gmail.com
MAIL_PASSWORD=mwpbcvkieaidzhsf
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=mohamedtolba161@gmail.com
MAIL_FROM_NAME="DevsAI Notifications"
MAIL_ADMIN_EMAIL=mohamedtolba161@gmail.com

# Configuration AWS (Optionnel)
AWS_ACCESS_KEY_ID=your_aws_access_key
AWS_SECRET_ACCESS_KEY=your_aws_secret_key
AWS_DEFAULT_REGION=us-east-1
AWS_SES_ENABLED=true

# Configuration Mailgun (Optionnel)
MAILGUN_DOMAIN=your_domain.mailgun.org
MAILGUN_SECRET=your_mailgun_secret

# Configuration SendGrid (Optionnel)
SENDGRID_API_KEY=your_sendgrid_api_key
```

### Fichiers de Configuration

- `config/aws-email.php` - Configuration spécifique AWS
- `config/mail.php` - Configuration Laravel standard
- `config/services.php` - Configuration des services tiers

## 🚀 Utilisation

### Envoi de Notifications Administrateur

```php
use App\Services\AdminNotificationService;

$adminService = app(AdminNotificationService::class);
$result = $adminService->sendUnifiedNotification($clientResponse, $userName);
```

### Envoi d'Email Direct

```php
use App\Services\AwsEmailService;

$awsEmailService = app(AwsEmailService::class);
$result = $awsEmailService->sendEmail(
    $to,
    $subject,
    $htmlContent,
    $from,
    $fromName,
    $replyTo,
    $replyToName
);
```

## 🧪 Tests

### Commande Artisan

```bash
# Tester tous les services
php artisan email:test-aws --service=all

# Tester un service spécifique
php artisan email:test-aws --service=aws
php artisan email:test-aws --service=smtp
php artisan email:test-aws --service=mailgun

# Tester avec une adresse spécifique
php artisan email:test-aws --to=test@example.com
```

### Routes de Test (Développement)

```
GET /test-mail - Test du service MailService
GET /test-unified-notification - Test des notifications unifiées
```

## 📊 Monitoring et Logs

### Logs Spécialisés

- `storage/logs/aws-email.log` - Logs spécifiques AWS
- `storage/logs/laravel.log` - Logs généraux

### Métriques Trackées

- Taux de succès par service
- Temps de réponse
- Erreurs et retry
- Utilisation mémoire

## 🔧 Fonctionnalités Avancées

### Système de Retry

- **3 tentatives maximum** par défaut
- **Délai de 5 secondes** entre les tentatives
- **Fallback automatique** vers le service suivant

### Gestion d'Erreurs

- Logging détaillé de toutes les erreurs
- Fallback automatique entre services
- Notifications d'échec pour monitoring

### Templates Optimisés

- **Template unifié** avec support AWS
- **Compatibilité multi-clients** email
- **Responsive design** intégré

## 🛡️ Sécurité

### Authentification

- Support OAuth2 pour Gmail
- Clés API sécurisées pour services tiers
- Rotation automatique des credentials AWS

### Validation

- Validation des adresses email
- Sanitisation du contenu HTML
- Protection contre le spam

## 📈 Performance

### Optimisations AWS

- **Timeouts optimisés** pour environnement cloud
- **Connexions persistantes** quand possible
- **Rate limiting** intégré

### Cache et Queue

- Support des queues Laravel pour envois en masse
- Cache des templates compilés
- Optimisation mémoire

## 🚨 Dépannage

### Problèmes Courants

1. **Emails non reçus**
   - Vérifier les logs dans `storage/logs/`
   - Tester avec `php artisan email:test-aws`
   - Vérifier la configuration SMTP

2. **Erreurs AWS SES**
   - Vérifier les credentials AWS
   - Confirmer la région AWS
   - Vérifier les limites SES

3. **Timeouts**
   - Augmenter les timeouts dans `config/aws-email.php`
   - Vérifier la connectivité réseau
   - Utiliser les fallbacks

### Commandes de Diagnostic

```bash
# Vérifier la configuration
php artisan config:show mail

# Tester la connectivité
php artisan email:test-aws --service=smtp

# Vérifier les logs
tail -f storage/logs/aws-email.log
```

## 📋 Checklist de Déploiement

### Avant le Déploiement

- [ ] Variables d'environnement configurées
- [ ] Credentials AWS valides (si utilisé)
- [ ] Tests de connectivité réussis
- [ ] Templates email validés
- [ ] Logs configurés

### Après le Déploiement

- [ ] Test d'envoi réel effectué
- [ ] Monitoring activé
- [ ] Alertes configurées
- [ ] Documentation mise à jour
- [ ] Équipe formée

## 🔄 Maintenance

### Tâches Régulières

- Rotation des credentials
- Nettoyage des logs anciens
- Monitoring des métriques
- Tests de fonctionnement

### Mises à Jour

- Mise à jour des dépendances
- Optimisation des templates
- Amélioration des performances
- Ajout de nouveaux services

---

**Version:** 1.0  
**Dernière mise à jour:** 2025-01-04  
**Auteur:** DevsAI Team
