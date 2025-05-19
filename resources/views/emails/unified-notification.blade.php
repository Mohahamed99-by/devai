<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Activité sur DevsAI</title>
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
        h2 {
            font-size: 18px;
            margin-top: 20px;
            color: #4a6cf7;
        }
        .section {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .section p {
            margin: 5px 0;
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
        .highlight {
            color: #4a6cf7;
            font-weight: bold;
        }
        .divider {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Nouvelle Activité sur DevsAI</h1>
    </div>

    <div class="content">
        <p>Bonjour {{ $admin['name'] }},</p>

        <p>Un utilisateur <span class="highlight">{{ $userName }}</span> vient de se connecter à la plateforme DevsAI et a soumis une nouvelle réponse.</p>

        <div class="section">
            <h2>Détails de l'Utilisateur</h2>
            <p><strong>Nom:</strong> {{ $userName }}</p>
            <p><strong>Email:</strong> {{ $clientResponse->user ? $clientResponse->user->email : 'Non disponible' }}</p>
            <p><strong>Date d'inscription:</strong> {{ $clientResponse->user ? $clientResponse->user->created_at->format('d/m/Y') : 'Non disponible' }}</p>
            <p><strong>Heure de connexion:</strong> {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>

        <div class="section">
            <h2>Détails du projet</h2>
            <p><strong>Type de projet:</strong> {{ $clientResponse->project_type }}</p>
            <p><strong>Description:</strong> {{ $clientResponse->project_description }}</p>
            <p><strong>Budget:</strong> {{ $clientResponse->budget_range }}</p>
            <p><strong>Délai:</strong> {{ $clientResponse->timeline }}</p>
        </div>

        @if($clientResponse->ai_analysis_summary)
        <div class="section">
            <h2>Analyse par Intelligence Artificielle</h2>
            <p><strong>Résumé:</strong> {{ $clientResponse->ai_analysis_summary }}</p>

            @if($clientResponse->ai_estimated_duration)
            <p><strong>Durée estimée:</strong> {{ $clientResponse->ai_estimated_duration }}</p>
            @endif

            @if($clientResponse->ai_cost_estimate)
            <p><strong>Coût estimé:</strong> {{ $clientResponse->ai_cost_estimate }}</p>
            @endif

            @if(is_array($clientResponse->ai_complexity_factors) && count($clientResponse->ai_complexity_factors) > 0)
            <p><strong>Facteurs de complexité:</strong></p>
            <ul>
                @foreach($clientResponse->ai_complexity_factors as $factor)
                <li>{{ $factor }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @endif

        <div class="divider"></div>

        <p>Cet email a été envoyé directement par l'utilisateur qui a rempli le formulaire. Vous pouvez lui répondre directement en cliquant sur "Répondre" dans votre client de messagerie.</p>

        <p style="margin-top: 20px;">Vous pouvez également examiner les détails sur la plateforme:</p>

        <a href="{{ url('/client-response/' . $clientResponse->id) }}" class="btn" style="background-color: #34D399;">Voir les détails sur la plateforme</a>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} DevsAI. Tous droits réservés.</p>
        <p>Vous pouvez répondre directement à cet email pour contacter l'utilisateur.</p>
    </div>
</body>
</html>
