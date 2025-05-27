<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Services\AdminNotificationService;
use App\Services\AwsEmailService;
use App\Services\MailService;

// Bootstrap Laravel
$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Test d'envoi d'email DevsAI ===\n\n";

// Test 1: Configuration email
echo "1. Vérification de la configuration email:\n";
echo "MAIL_MAILER: " . env('MAIL_MAILER') . "\n";
echo "MAIL_HOST: " . env('MAIL_HOST') . "\n";
echo "MAIL_PORT: " . env('MAIL_PORT') . "\n";
echo "MAIL_USERNAME: " . env('MAIL_USERNAME') . "\n";
echo "MAIL_PASSWORD: " . (env('MAIL_PASSWORD') ? '***configuré***' : 'NON CONFIGURÉ') . "\n";
echo "MAIL_ENCRYPTION: " . env('MAIL_ENCRYPTION') . "\n";
echo "MAIL_FROM_ADDRESS: " . env('MAIL_FROM_ADDRESS') . "\n";
echo "MAIL_ADMIN_EMAIL: " . env('MAIL_ADMIN_EMAIL') . "\n";
echo "MAIL_ENABLED: " . (env('MAIL_ENABLED') ? 'true' : 'false') . "\n\n";

// Test 2: Test de connexion SMTP
echo "2. Test de connexion SMTP:\n";
try {
    $transport = new Swift_SmtpTransport(env('MAIL_HOST'), env('MAIL_PORT'), env('MAIL_ENCRYPTION'));
    $transport->setUsername(env('MAIL_USERNAME'));
    $transport->setPassword(env('MAIL_PASSWORD'));
    
    $mailer = new Swift_Mailer($transport);
    $mailer->getTransport()->start();
    echo "✅ Connexion SMTP réussie\n\n";
} catch (Exception $e) {
    echo "❌ Erreur de connexion SMTP: " . $e->getMessage() . "\n\n";
}

// Test 3: Test avec Laravel Mail
echo "3. Test avec Laravel Mail:\n";
try {
    Mail::raw('Test email depuis DevsAI', function ($message) {
        $message->to(env('MAIL_ADMIN_EMAIL'))
                ->subject('Test Email - DevsAI')
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    });
    echo "✅ Email Laravel envoyé avec succès\n\n";
} catch (Exception $e) {
    echo "❌ Erreur Laravel Mail: " . $e->getMessage() . "\n\n";
}

// Test 4: Test avec AwsEmailService
echo "4. Test avec AwsEmailService:\n";
try {
    $awsEmailService = new AwsEmailService();
    $result = $awsEmailService->sendEmail(
        env('MAIL_ADMIN_EMAIL'),
        'Test AwsEmailService - DevsAI',
        '<h1>Test Email</h1><p>Ceci est un test depuis AwsEmailService</p>',
        env('MAIL_FROM_ADDRESS'),
        env('MAIL_FROM_NAME'),
        env('MAIL_FROM_ADDRESS'),
        env('MAIL_FROM_NAME')
    );
    
    if ($result) {
        echo "✅ AwsEmailService: Email envoyé avec succès\n\n";
    } else {
        echo "❌ AwsEmailService: Échec de l'envoi\n\n";
    }
} catch (Exception $e) {
    echo "❌ Erreur AwsEmailService: " . $e->getMessage() . "\n\n";
}

// Test 5: Test avec MailService
echo "5. Test avec MailService:\n";
try {
    $mailService = new MailService();
    $result = $mailService->sendEmail(
        env('MAIL_ADMIN_EMAIL'),
        'Test MailService - DevsAI',
        '<h1>Test Email</h1><p>Ceci est un test depuis MailService</p>',
        env('MAIL_FROM_ADDRESS'),
        env('MAIL_FROM_NAME'),
        env('MAIL_FROM_ADDRESS'),
        env('MAIL_FROM_NAME')
    );
    
    if ($result) {
        echo "✅ MailService: Email envoyé avec succès\n\n";
    } else {
        echo "❌ MailService: Échec de l'envoi\n\n";
    }
} catch (Exception $e) {
    echo "❌ Erreur MailService: " . $e->getMessage() . "\n\n";
}

echo "=== Fin des tests ===\n";
