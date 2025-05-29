<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Nouvelle Activité sur DevsAI</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #4a6cf7 0%, #5a7cfa 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .content {
            padding: 30px 20px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #e9ecef;
        }
        h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        h2 {
            font-size: 20px;
            margin-top: 25px;
            margin-bottom: 15px;
            color: #4a6cf7;
            font-weight: 600;
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
        .status-badge {
            background-color: #10b981;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }
        .divider {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
        .section ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .section li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🚀 Nouvelle Activité sur DevsAI</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9; font-size: 16px;">Un nouveau projet vient d'être soumis</p>
        </div>

        <div class="content">
            <p style="font-size: 16px; margin-bottom: 20px;">Bonjour {{ $admin['name'] ?? 'Admin' }},</p>

            <p style="font-size: 16px; margin-bottom: 25px;">
                Un utilisateur <span class="highlight">{{ $userName ?? 'Utilisateur anonyme' }}</span> vient de soumettre un nouveau projet sur DevsAI.
                <span class="status-badge">Nouveau</span>
            </p>

        <div class="section">
            <h2>👤 Détails de l'Utilisateur</h2>
            <p><strong>Nom:</strong> {{ $userName }}</p>
            <p><strong>Email:</strong> {{ $clientResponse->user ? $clientResponse->user->email : 'Non disponible' }}</p>
            <p><strong>Statut:</strong> {{ $clientResponse->user ? 'Utilisateur enregistré' : 'Utilisateur non-authentifié' }}</p>
            @if($clientResponse->user)
            <p><strong>Date d'inscription:</strong> {{ $clientResponse->user->created_at->format('d/m/Y à H:i') }}</p>
            @endif
            <p><strong>Date de soumission:</strong> {{ now()->format('d/m/Y à H:i:s') }}</p>
        </div>

        <div class="section">
            <h2>📋 Détails du Projet</h2>
            <p><strong>ID Projet:</strong> #{{ $clientResponse->id }}</p>
            @if(!empty($clientResponse->project_name))
            <p><strong>Nom du projet:</strong> {{ $clientResponse->project_name }}</p>
            @endif
            @if(!empty($clientResponse->project_type))
            <p><strong>Type de projet:</strong> {{ ucfirst(str_replace('_', ' ', $clientResponse->project_type)) }}</p>
            @endif
            @if(!empty($clientResponse->project_description))
            <p><strong>Description:</strong> {{ Str::limit($clientResponse->project_description, 200) }}</p>
            @endif
            @if(!empty($clientResponse->target_audience))
            <p><strong>Public cible:</strong>
                @if(is_array($clientResponse->target_audience))
                    {{ implode(', ', array_map('ucfirst', $clientResponse->target_audience)) }}
                @else
                    {{ $clientResponse->target_audience }}
                @endif
            </p>
            @endif
            @if(!empty($clientResponse->key_features))
            <p><strong>Fonctionnalités principales:</strong>
                @if(is_array($clientResponse->key_features))
                    {{ implode(', ', $clientResponse->key_features) }}
                @else
                    {{ Str::limit($clientResponse->key_features, 150) }}
                @endif
            </p>
            @endif
            @if(!empty($clientResponse->budget_range))
            <p><strong>Budget:</strong> {{ $clientResponse->budget_range }}</p>
            @endif
            @if(!empty($clientResponse->timeline))
            <p><strong>Délai:</strong> {{ $clientResponse->timeline }}</p>
            @endif
            <p><strong>Date de soumission:</strong> {{ $clientResponse->created_at ? $clientResponse->created_at->format('d/m/Y à H:i') : now()->format('d/m/Y à H:i') }}</p>
        </div>

        <div class="section">
            <h2>🤖 Analyse par Intelligence Artificielle</h2>
            @if(!empty($clientResponse->ai_analysis_summary))
                <p><strong>Résumé:</strong> {{ Str::limit($clientResponse->ai_analysis_summary, 300) }}</p>
            @else
                <p><em>L'analyse IA est en cours de traitement. Elle sera disponible sous peu sur la plateforme.</em></p>
            @endif

            @if(!empty($clientResponse->ai_estimated_duration))
                <p><strong>⏱️ Durée estimée:</strong> {{ $clientResponse->ai_estimated_duration }}</p>
            @endif

            @if(!empty($clientResponse->ai_cost_estimate))
                <p><strong>💰 Coût estimé:</strong>
                    @if(is_numeric($clientResponse->ai_cost_estimate))
                        {{ number_format($clientResponse->ai_cost_estimate, 0, ',', ' ') }} EUR
                    @else
                        {{ $clientResponse->ai_cost_estimate }}
                    @endif
                </p>
            @endif

            @if(!empty($clientResponse->ai_suggested_technologies) && is_array($clientResponse->ai_suggested_technologies) && count($clientResponse->ai_suggested_technologies) > 0)
                <p><strong>💻 Technologies suggérées:</strong></p>
                <ul>
                    @foreach($clientResponse->ai_suggested_technologies as $tech)
                        <li>{{ is_string($tech) ? $tech : 'Technologie non spécifiée' }}</li>
                    @endforeach
                </ul>
            @endif

            @if(!empty($clientResponse->ai_complexity_factors) && is_array($clientResponse->ai_complexity_factors) && count($clientResponse->ai_complexity_factors) > 0)
                <p><strong>⚠️ Facteurs de complexité:</strong></p>
                <ul>
                    @foreach($clientResponse->ai_complexity_factors as $factor)
                        <li>{{ is_string($factor) ? $factor : 'Facteur non spécifié' }}</li>
                    @endforeach
                </ul>
            @endif

            @if(!empty($clientResponse->ai_suggested_features) && is_array($clientResponse->ai_suggested_features) && count($clientResponse->ai_suggested_features) > 0)
                <p><strong>✨ Fonctionnalités suggérées:</strong></p>
                <ul>
                    @foreach(array_slice($clientResponse->ai_suggested_features, 0, 5) as $feature)
                        <li>
                            @if(is_array($feature) && isset($feature['name']))
                                {{ $feature['name'] }}
                                @if(isset($feature['priority']))
                                    <span style="font-size: 11px; background-color: #e5e7eb; padding: 2px 6px; border-radius: 8px; margin-left: 5px;">{{ $feature['priority'] }}</span>
                                @endif
                            @else
                                {{ is_string($feature) ? $feature : 'Fonctionnalité non spécifiée' }}
                            @endif
                        </li>
                    @endforeach
                    @if(count($clientResponse->ai_suggested_features) > 5)
                        <li><em>... et {{ count($clientResponse->ai_suggested_features) - 5 }} autres fonctionnalités</em></li>
                    @endif
                </ul>
            @endif
        </div>

        <div class="divider"></div>

        <div style="background-color: #f0f9ff; padding: 15px; border-radius: 5px; border-left: 4px solid #4a6cf7;">
            <p style="margin: 0; font-size: 14px;">
                <strong>💡 Actions recommandées :</strong><br>
                • Répondez directement à cet email pour contacter l'utilisateur<br>
                • Consultez les détails complets sur la plateforme<br>
                • Analysez les besoins et préparez une proposition
            </p>
        </div>

            <div style="text-align: center; margin-top: 25px;">
                <a href="{{ url('/client-response/' . $clientResponse->id) }}" class="btn" style="background-color: #4a6cf7; color: white; text-decoration: none; padding: 12px 25px; border-radius: 6px; font-weight: 600; display: inline-block;">
                    📋 Voir les détails complets
                </a>

                @if($clientResponse->user && $clientResponse->user->email)
                <a href="mailto:{{ $clientResponse->user->email }}?subject=Re: Votre projet {{ $clientResponse->project_name ?? 'sur DevsAI' }}" class="btn" style="background-color: #34D399; color: white; text-decoration: none; padding: 12px 25px; border-radius: 6px; font-weight: 600; margin-left: 10px; display: inline-block;">
                    ✉️ Répondre directement
                </a>
                @endif
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} DevsAI. Tous droits réservés.</p>
            <p style="margin-top: 10px;">
                📧 Cet email a été généré automatiquement suite à une nouvelle soumission.<br>
                🔄 Vous pouvez répondre directement pour contacter l'utilisateur.
            </p>
        </div>
    </div>
</body>
</html>
