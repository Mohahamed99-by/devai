<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Fiche Technique - Projet #{{ $clientResponse->id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #1f2937;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            font-size: 14px;
        }

        /* Couleurs modernes et cohérentes */
        :root {
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --primary-light: #dbeafe;
            --primary-lighter: #eff6ff;
            --secondary: #8b5cf6;
            --secondary-light: #ede9fe;
            --accent: #06b6d4;
            --accent-light: #cffafe;
            --success: #10b981;
            --success-light: #d1fae5;
            --warning: #f59e0b;
            --warning-light: #fef3c7;
            --danger: #ef4444;
            --danger-light: #fee2e2;
            --gray-900: #111827;
            --gray-800: #1f2937;
            --gray-700: #374151;
            --gray-600: #4b5563;
            --gray-500: #6b7280;
            --gray-400: #9ca3af;
            --gray-300: #d1d5db;
            --gray-200: #e5e7eb;
            --gray-100: #f3f4f6;
            --gray-50: #f9fafb;
        }

        /* En-tête moderne avec design élégant */
        .header {
            text-align: center;
            margin: -20px -20px 40px -20px;
            padding: 40px 30px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 50%, #8b5cf6 100%);
            color: white;
            border-radius: 0 0 25px 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(59, 130, 246, 0.25);
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(255,255,255,0.08) 0%, transparent 50%);
            opacity: 0.6;
        }

        .header h1 {
            font-size: 36px;
            margin: 0 0 12px 0;
            color: white;
            text-shadow: 0 2px 8px rgba(0,0,0,0.2);
            letter-spacing: -0.5px;
            position: relative;
            z-index: 1;
            font-weight: 700;
        }

        .header p {
            font-size: 16px;
            color: rgba(255,255,255,0.95);
            margin: 8px 0;
            position: relative;
            z-index: 1;
            font-weight: 400;
        }

        .header .project-info {
            background: rgba(255,255,255,0.15);
            padding: 15px 25px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 15px;
            font-weight: 600;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            font-size: 18px;
            position: relative;
            z-index: 1;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 8px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
            border-radius: 4px;
        }

        /* Sections modernes avec design amélioré */
        .section {
            margin-bottom: 35px;
            padding: 25px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid var(--gray-200);
            position: relative;
            overflow: hidden;
        }

        .section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--gray-100);
        }

        .section-icon {
            width: 40px;
            height: 40px;
            margin-right: 15px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            flex-shrink: 0;
        }

        .section h2 {
            color: var(--gray-800);
            font-size: 24px;
            margin: 0;
            font-weight: 600;
            letter-spacing: -0.3px;
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

        /* Tableaux modernes et élégants */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            background: white;
        }

        table, th, td {
            border: none;
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid var(--gray-100);
        }

        th {
            background: linear-gradient(135deg, var(--primary-lighter) 0%, var(--secondary-light) 100%);
            color: var(--primary-dark);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.8px;
            position: relative;
        }

        th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        }

        tr:nth-child(even) {
            background-color: var(--gray-50);
        }

        tr:hover {
            background-color: var(--primary-lighter);
            transition: background-color 0.2s ease;
        }

        td {
            color: var(--gray-700);
            font-weight: 500;
        }

        td strong {
            color: var(--gray-800);
            font-weight: 600;
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

        /* Pied de page moderne */
        .footer {
            margin-top: 50px;
            padding: 30px;
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
            border-top: 3px solid var(--primary);
            font-size: 13px;
            color: var(--gray-600);
            text-align: center;
            border-radius: 20px 20px 0 0;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(59,130,246,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
            opacity: 0.5;
        }

        .footer p {
            position: relative;
            z-index: 1;
            margin: 8px 0;
        }

        .footer .copyright {
            font-weight: 600;
            color: var(--primary-dark);
            margin-top: 15px;
            font-size: 14px;
        }

        .page-break {
            page-break-after: always;
            height: 0;
            margin: 0;
            padding: 0;
        }

        /* Badges modernes avec design amélioré */
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border: 1px solid transparent;
        }

        .badge-primary {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-lighter) 100%);
            color: var(--primary-dark);
            border-color: var(--primary-light);
        }

        .badge-success {
            background: linear-gradient(135deg, var(--success-light) 0%, #ecfdf5 100%);
            color: #065f46;
            border-color: var(--success-light);
        }

        .badge-warning {
            background: linear-gradient(135deg, var(--warning-light) 0%, #fffbeb 100%);
            color: #92400e;
            border-color: var(--warning-light);
        }

        .badge-danger {
            background: linear-gradient(135deg, var(--danger-light) 0%, #fef2f2 100%);
            color: #991b1b;
            border-color: var(--danger-light);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🚀 Fiche Technique</h1>
        <div class="project-info">
            {{ $clientResponse->project_name ?? 'Projet #' . $clientResponse->id }}
        </div>
        <p>Générée automatiquement par DevsAI</p>
        <p>{{ $generatedAt->format('d/m/Y à H:i') }}</p>
    </div>

    <div class="section">
        <div class="section-header">
            <div class="section-icon">📋</div>
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
            <div class="section-icon">📝</div>
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
            <div class="section-icon">👥</div>
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
            <div class="section-icon">⚡</div>
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
            <div class="section-icon">🔧</div>
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
            <div class="section-icon">💻</div>
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
            <div class="section-icon">🧠</div>
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
            <div class="section-icon">💰</div>
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
        <p>Cette fiche technique a été générée automatiquement par <strong>DevsAI</strong> 🤖</p>
        <p>Les estimations fournies sont basées sur les standards de l'industrie et peuvent varier en fonction des détails spécifiques du projet.</p>
        <p class="copyright">© {{ date('Y') }} DevsAI - Générateur de Fiche Technique Automatique ⚡</p>
    </div>
</body>
</html>
