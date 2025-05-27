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
            margin: 0;
            padding: 0;
            background-color: #fff;
        } 

        /* Couleurs modernes */
        :root {
            --primary: #4f46e5;
            --primary-light: #e0e7ff;
            --secondary: #8b5cf6;
            --secondary-light: #ede9fe;
            --success: #10b981;
            --success-light: #d1fae5;
            --warning: #f59e0b;
            --warning-light: #fef3c7;
            --danger: #ef4444;
            --danger-light: #fee2e2;
            --gray-dark: #374151;
            --gray: #6b7280;
            --gray-light: #f3f4f6;
        }

        /* En-tête avec dégradé */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 30px 20px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-radius: 0 0 15px 15px;
            position: relative;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            color: white;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .header p {
            font-size: 14px;
            color: rgba(255,255,255,0.9);
            margin: 0;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 6px;
            background-color: white;
            border-radius: 3px;
        }

        /* Sections avec icônes */
        .section {
            margin-bottom: 30px;
            padding: 0 20px;
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-icon {
            width: 32px;
            height: 32px;
            margin-right: 10px;
            background-color: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: bold;
            font-size: 16px;
        }

        .section h2 {
            color: var(--primary);
            font-size: 20px;
            margin: 0;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--primary-light);
        }

        .section h3 {
            color: var(--gray-dark);
            font-size: 16px;
            margin: 15px 0 8px;
            display: flex;
            align-items: center;
        }

        .section h3::before {
            content: '•';
            color: var(--secondary);
            margin-right: 8px;
            font-size: 20px;
        }

        .section p {
            margin: 8px 0 15px;
            color: var(--gray);
        }

        /* Listes améliorées */
        .section ul {
            margin: 10px 0;
            padding-left: 15px;
            list-style-type: none;
        }

        .section ul li {
            position: relative;
            padding: 4px 0 4px 25px;
            margin-bottom: 5px;
        }

        .section ul li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--success);
            font-weight: bold;
        }

        /* Tableaux modernes */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        table, th, td {
            border: none;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: var(--gray-light);
        }

        /* Boîtes de mise en évidence */
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
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--secondary-light) 100%);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-left: 4px solid var(--primary);
        }

        .highlight-box h3 {
            margin-top: 0;
            color: var(--primary);
            font-size: 16px;
            border: none;
            padding: 0;
        }

        .highlight-box h3::before {
            display: none;
        }

        .highlight-box p.value {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0 0;
            color: var(--gray-dark);
        }

        /* Pied de page */
        .footer {
            margin-top: 40px;
            padding: 20px;
            background-color: var(--gray-light);
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: var(--gray);
            text-align: center;
            border-radius: 15px 15px 0 0;
        }

        .page-break {
            page-break-after: always;
            height: 0;
            margin: 0;
            padding: 0;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 5px;
        }

        .badge-primary {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .badge-success {
            background-color: var(--success-light);
            color: var(--success);
        }

        .badge-warning {
            background-color: var(--warning-light);
            color: var(--warning);
        }

        .badge-danger {
            background-color: var(--danger-light);
            color: var(--danger);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Fiche Technique</h1>
        <p>{{ $clientResponse->project_name ?? 'Projet #' . $clientResponse->id }}</p>
        <p>Générée automatiquement par DevsAI - {{ $generatedAt->format('d/m/Y à H:i') }}</p>
    </div>

    <div class="section">
        <div class="section-header">
            <div class="section-icon">i</div>
            <h2>Informations Générales</h2>
        </div>
        <table>
            <tr>
                <th width="30%">ID Projet</th>
                <td>#{{ $clientResponse->id }}</td>
            </tr>
            @if($clientResponse->project_name)
            <tr>
                <th>Nom du Projet</th>
                <td><strong>{{ $clientResponse->project_name }}</strong></td>
            </tr>
            @endif
            <tr>
                <th>Type de Projet</th>
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
                <th>Statut</th>
                <td>
                    @if($clientResponse->status === 'validated')
                        <span class="badge badge-success">Validé</span>
                    @elseif($clientResponse->status === 'draft')
                        <span class="badge badge-warning">Brouillon</span>
                    @else
                        <span class="badge badge-primary">{{ ucfirst($clientResponse->status) }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Maintenance</th>
                <td>
                    @if($clientResponse->needs_maintenance)
                        <span class="badge badge-success">Oui</span>
                        @if($clientResponse->maintenance_type && count($clientResponse->maintenance_type) > 0)
                            <div style="margin-top: 5px; font-size: 12px;">
                                Types: {{ implode(', ', array_map('ucfirst', $clientResponse->maintenance_type)) }}
                            </div>
                        @endif
                    @else
                        <span class="badge badge-warning">Non</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Date de Création</th>
                <td>{{ $clientResponse->created_at->format('d/m/Y à H:i') }}</td>
            </tr>
            @if($clientResponse->user)
            <tr>
                <th>Client</th>
                <td>{{ $clientResponse->user->name }} ({{ $clientResponse->user->email }})</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="section">
        <div class="section-header">
            <div class="section-icon">D</div>
            <h2>Description du Projet</h2>
        </div>
        <p>{{ $clientResponse->project_description }}</p>

        @if(!empty($clientResponse->similar_applications))
        <h3>Applications Similaires</h3>
        <p>{{ $clientResponse->similar_applications }}</p>
        @endif
    </div>

    <div class="section">
        <div class="section-header">
            <div class="section-icon">U</div>
            <h2>Public Cible</h2>
        </div>
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
        <div class="section-header">
            <div class="section-icon">F</div>
            <h2>Fonctionnalités</h2>
        </div>
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
                @if(is_array($feature) && isset($feature['name']))
                    <li>
                        <strong>{{ $feature['name'] }}</strong>
                        @if(isset($feature['priority']))
                            @php
                                $priorityClass = 'badge-primary';
                                if (strtolower($feature['priority']) == 'high') {
                                    $priorityClass = 'badge-danger';
                                } elseif (strtolower($feature['priority']) == 'medium') {
                                    $priorityClass = 'badge-warning';
                                } elseif (strtolower($feature['priority']) == 'low') {
                                    $priorityClass = 'badge-success';
                                }
                            @endphp
                            <span class="badge {{ $priorityClass }}">{{ $feature['priority'] }}</span>
                        @endif
                        @if(isset($feature['description']))
                            <div style="margin-top: 3px; color: var(--gray);">{{ $feature['description'] }}</div>
                        @endif
                    </li>
                @else
                    <li>{{ is_string($feature) ? $feature : 'Fonctionnalité non spécifiée' }}</li>
                @endif
            @endforeach
        </ul>
        @endif
    </div>

    <div class="page-break"></div>

    <div class="section">
        <div class="section-header">
            <div class="section-icon">T</div>
            <h2>Exigences Techniques</h2>
        </div>
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
        <p>
            {{ ucfirst($clientResponse->design_complexity) }}
            @php
                $complexityClass = 'badge-primary';
                if (strtolower($clientResponse->design_complexity) == 'high') {
                    $complexityClass = 'badge-danger';
                } elseif (strtolower($clientResponse->design_complexity) == 'medium') {
                    $complexityClass = 'badge-warning';
                } elseif (strtolower($clientResponse->design_complexity) == 'low') {
                    $complexityClass = 'badge-success';
                }
            @endphp
            <span class="badge {{ $complexityClass }}">{{ ucfirst($clientResponse->design_complexity) }}</span>
        </p>
        @endif
    </div>

    <div class="section">
        <div class="section-header">
            <div class="section-icon">S</div>
            <h2>Technologies Recommandées</h2>
        </div>
        @if(count($clientResponse->ai_suggested_technologies) > 0)
        <ul>
            @foreach($clientResponse->ai_suggested_technologies as $tech)
                <li>{{ is_string($tech) ? $tech : 'Technologie non spécifiée' }}</li>
            @endforeach
        </ul>
        @else
        <p>Aucune technologie suggérée.</p>
        @endif
    </div>

    <div class="section">
        <div class="section-header">
            <div class="section-icon">A</div>
            <h2>Analyse de Complexité</h2>
        </div>
        @if(!empty($clientResponse->ai_analysis_summary))
        <div style="background-color: var(--primary-light); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="margin-top: 0;">Résumé de l'Analyse</h3>
            <p style="margin-bottom: 0;">{{ $clientResponse->ai_analysis_summary }}</p>
        </div>
        @endif

        @if(count($clientResponse->ai_complexity_factors) > 0)
        <h3>Facteurs de Complexité</h3>
        <ul>
            @foreach($clientResponse->ai_complexity_factors as $factor)
                <li>{{ is_string($factor) ? $factor : 'Facteur non spécifié' }}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <div class="section">
        <div class="section-header">
            <div class="section-icon">E</div>
            <h2>Estimations</h2>
        </div>
        <div class="grid">
            <div class="col">
                <div class="highlight-box">
                    <h3>Durée Estimée</h3>
                    <p class="value">{{ is_string($clientResponse->ai_estimated_duration) ? $clientResponse->ai_estimated_duration : 'Non estimé' }}</p>
                </div>
            </div>
            <div class="col">
                <div class="highlight-box">
                    <h3>Budget Estimé</h3>
                    <p class="value">{{ number_format($clientResponse->ai_cost_estimate, 2) }} €</p>
                </div>
            </div>
        </div>

        <div style="margin-top: 20px; padding: 15px; background-color: var(--warning-light); border-radius: 8px; border-left: 4px solid var(--warning);">
            <p style="margin: 0; color: var(--gray-dark); font-size: 14px;">
                <strong>Note:</strong> Ces estimations sont basées sur les informations fournies et peuvent varier en fonction des spécificités du projet et des ressources disponibles.
            </p>
        </div>
    </div>

    <div class="footer">
        <p>Cette fiche technique a été générée automatiquement par DevsAI. Les estimations fournies sont basées sur les standards de l'industrie et peuvent varier en fonction des détails spécifiques du projet.</p>
        <p style="margin-top: 10px; font-weight: bold;">© {{ date('Y') }} DevsAI - Générateur de Fiche Technique Automatique</p>
    </div>
</body>
</html>
