<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email de Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4a6cf7;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        h1 {
            margin: 0;
            font-size: 24px;
        }
        .btn {
            display: inline-block;
            background-color: #4a6cf7;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Email de Test</h1>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $name }},</p>
        
        <p>{{ $content }}</p>
        
        <p>Si vous recevez cet email, cela signifie que la configuration de votre serveur de messagerie fonctionne correctement.</p>
        
        <p>Vous pouvez maintenant utiliser toutes les fonctionnalités de notification par email de la plateforme DevsAI.</p>
        
        <a href="{{ url('/') }}" class="btn">Retour à la plateforme</a>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} DevsAI. Tous droits réservés.</p>
        <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
    </div>
</body>
</html>
