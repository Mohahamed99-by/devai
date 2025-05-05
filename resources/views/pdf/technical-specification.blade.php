<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Fiche Technique - Projet #{{ $clientResponse->id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #2563eb;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header p {
            color: #666;
            font-size: 14px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            color: #2563eb;
            font-size: 18px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .section h3 {
            color: #4b5563;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .section p {
            margin-top: 0;
            margin-bottom: 10px;
        }
        .section ul {
            margin-top: 0;
            padding-left: 20px;
        }
        .grid {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .col {
            width: 50%;
            padding: 0 10px;
            box-sizing: border-box;
        }
        .highlight-box {
            background-color: #f0f7ff;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .highlight-box h3 {
            margin-top: 0;
        }
        .highlight-box p.value {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0 0;
        }
        .footer {
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8fafc;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Fiche Technique</h1>
        <p>Générée automatiquement par DevsAI - {{ date('d/m/Y') }}</p>
    </div>

    <div class="section">
        <h2>Informations Générales</h2>
        <table>
            <tr>
                <th width="30%">Type de Projet</th>
                <td>{{ ucfirst(str_replace('_', ' ', $clientResponse->project_type)) }}</td>
            </tr>
            <tr>
                <th>Budget</th>
                <td>{{ $clientResponse->budget_range }}</td>
            </tr>
            <tr>
                <th>Délai</th>
                <td>{{ $clientResponse->timeline }}</td>
            </tr>
            @if(!empty($clientResponse->deadline))
            <tr>
                <th>Date Limite</th>
                <td>{{ $clientResponse->deadline->format('d/m/Y') }}</td>
            </tr>
            @endif
            <tr>
                <th>Maintenance</th>
                <td>{{ $clientResponse->needs_maintenance ? 'Oui' : 'Non' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Description du Projet</h2>
        <p>{{ $clientResponse->project_description }}</p>
        
        @if(!empty($clientResponse->similar_applications))
        <h3>Applications Similaires</h3>
        <p>{{ $clientResponse->similar_applications }}</p>
        @endif
    </div>

    <div class="section">
        <h2>Public Cible</h2>
        <ul>
            @foreach($clientResponse->target_audience as $audience)
                <li>{{ ucfirst(str_replace('_', ' ', $audience)) }}</li>
            @endforeach
        </ul>
        
        @if(!empty($clientResponse->user_roles))
        <h3>Rôles Utilisateurs</h3>
        <ul>
            @foreach($clientResponse->user_roles as $role)
                <li>{{ ucfirst(str_replace('_', ' ', $role)) }}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <div class="section">
        <h2>Fonctionnalités</h2>
        <h3>Fonctionnalités Demandées</h3>
        <ul>
            @foreach($clientResponse->key_features as $feature)
                <li>{{ ucfirst(str_replace('_', ' ', $feature)) }}</li>
            @endforeach
        </ul>
        
        @if(!empty($clientResponse->custom_features))
        <h3>Fonctionnalités Additionnelles</h3>
        <p>{{ $clientResponse->custom_features }}</p>
        @endif
        
        @if(count($clientResponse->ai_suggested_features) > 0)
        <h3>Fonctionnalités Suggérées par l'IA</h3>
        <ul>
            @foreach($clientResponse->ai_suggested_features as $feature)
                <li>{{ $feature }}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <div class="page-break"></div>

    <div class="section">
        <h2>Exigences Techniques</h2>
        @if(!empty($clientResponse->technical_requirements))
        <ul>
            @foreach($clientResponse->technical_requirements as $req)
                <li>{{ ucfirst(str_replace('_', ' ', $req)) }}</li>
            @endforeach
        </ul>
        @endif
        
        @if(!empty($clientResponse->external_apis))
        <h3>Intégrations API Externes</h3>
        <p>{{ $clientResponse->external_apis }}</p>
        @endif
        
        @if(!empty($clientResponse->design_complexity))
        <h3>Complexité UI/UX</h3>
        <p>{{ ucfirst($clientResponse->design_complexity) }}</p>
        @endif
    </div>

    <div class="section">
        <h2>Technologies Recommandées</h2>
        @if(count($clientResponse->ai_suggested_technologies) > 0)
        <ul>
            @foreach($clientResponse->ai_suggested_technologies as $tech)
                <li>{{ $tech }}</li>
            @endforeach
        </ul>
        @else
        <p>Aucune technologie suggérée.</p>
        @endif
    </div>

    <div class="section">
        <h2>Analyse de Complexité</h2>
        @if(!empty($clientResponse->ai_analysis_summary))
        <h3>Résumé de l'Analyse</h3>
        <p>{{ $clientResponse->ai_analysis_summary }}</p>
        @endif
        
        @if(count($clientResponse->ai_complexity_factors) > 0)
        <h3>Facteurs de Complexité</h3>
        <ul>
            @foreach($clientResponse->ai_complexity_factors as $factor)
                <li>{{ $factor }}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <div class="section">
        <h2>Estimations</h2>
        <div class="grid">
            <div class="col">
                <div class="highlight-box">
                    <h3>Durée Estimée</h3>
                    <p class="value">{{ $clientResponse->ai_estimated_duration }}</p>
                </div>
            </div>
            <div class="col">
                <div class="highlight-box">
                    <h3>Budget Estimé</h3>
                    <p class="value">${{ number_format($clientResponse->ai_cost_estimate, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Cette fiche technique a été générée automatiquement par DevsAI. Les estimations fournies sont basées sur les standards de l'industrie et peuvent varier en fonction des détails spécifiques du projet.</p>
        <p>© {{ date('Y') }} DevsAI - Générateur de Fiche Technique Automatique</p>
    </div>
</body>
</html>
