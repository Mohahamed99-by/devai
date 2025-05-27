@extends('layouts.app')

@section('title', 'Questionnaire de Projet - Générateur de Fiche Technique')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <a href="{{ url('/') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à l'accueil
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h1 class="text-3xl font-bold mb-4">Questionnaire de Projet</h1>
                <p class="text-gray-600 mb-2">Bienvenue dans notre outil d'analyse automatisée de projets. Ce questionnaire intelligent nous aidera à comprendre vos besoins.</p>
                <p class="text-gray-600">Après soumission, notre IA analysera vos exigences et générera une fiche technique détaillée incluant les fonctionnalités suggérées, les technologies recommandées et une estimation de délai de développement.</p>
            </div>

            <form id="projectForm" class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Informations de Base</h2>

            <!-- Project Type -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Type de Projet *
                </label>
                <select name="project_type" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Sélectionnez un type de projet</option>
                    <option value="web">Application Web</option>
                    <option value="mobile_ios">Application Mobile - iOS</option>
                    <option value="mobile_android">Application Mobile - Android</option>
                    <option value="mobile_cross">Application Mobile - Multi-plateforme</option>
                    <option value="desktop">Logiciel de Bureau</option>
                    <option value="hybrid">Application Hybride</option>
                    <option value="ecommerce">Plateforme E-commerce</option>
                    <option value="cms">Système de Gestion de Contenu</option>
                    <option value="api">API / Service Backend</option>
                </select>
                <p class="text-gray-500 text-xs mt-1">Sélectionnez la plateforme principale pour votre projet</p>
            </div>

            <!-- Project Description -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Description du Projet *
                </label>
                <textarea
                    name="project_description"
                    rows="5"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Décrivez votre projet en détail. Quel problème résout-il ? Quels sont les objectifs principaux ?"
                    required></textarea>
                <p class="text-gray-500 text-xs mt-1">Soyez aussi précis que possible sur l'objectif et les buts de votre projet</p>
            </div>

            <!-- Similar Applications -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Applications Similaires
                </label>
                <textarea
                    name="similar_applications"
                    rows="2"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Listez les applications ou sites web existants qui sont similaires à ce que vous souhaitez construire"></textarea>
                <p class="text-gray-500 text-xs mt-1">Des exemples nous aident à mieux comprendre votre vision</p>
            </div>

            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Public Cible & Utilisateurs</h2>

            <!-- Target Audience -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Public Cible *
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="target_audience[]" value="businesses" class="mr-2">
                        Entreprises (B2B)
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="target_audience[]" value="consumers" class="mr-2">
                        Consommateurs (B2C)
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="target_audience[]" value="enterprise" class="mr-2">
                        Grandes Entreprises
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="target_audience[]" value="internal" class="mr-2">
                        Utilisateurs Internes
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="target_audience[]" value="government" class="mr-2">
                        Secteur Public/Gouvernement
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="target_audience[]" value="education" class="mr-2">
                        Éducation
                    </label>
                </div>
                <p class="text-gray-500 text-xs mt-1">Sélectionnez toutes les options applicables</p>
            </div>

            <!-- User Roles -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Rôles Utilisateurs
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="user_roles[]" value="admin" class="mr-2">
                        Administrateurs
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="user_roles[]" value="regular_users" class="mr-2">
                        Utilisateurs Réguliers
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="user_roles[]" value="guests" class="mr-2">
                        Utilisateurs Invités
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="user_roles[]" value="moderators" class="mr-2">
                        Modérateurs
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="user_roles[]" value="content_creators" class="mr-2">
                        Créateurs de Contenu
                    </label>
                </div>
                <p class="text-gray-500 text-xs mt-1">Quels types d'utilisateurs interagiront avec votre application ?</p>
            </div>

            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Fonctionnalités</h2>

            <!-- Key Features -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Fonctionnalités Clés *
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="authentication" class="mr-2">
                        Authentification Utilisateur
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="payment" class="mr-2">
                        Intégration de Paiement
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="api" class="mr-2">
                        Intégration API
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="realtime" class="mr-2">
                        Fonctionnalités en Temps Réel
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="offline" class="mr-2">
                        Fonctionnalité Hors Ligne
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="search" class="mr-2">
                        Fonctionnalité de Recherche
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="file_upload" class="mr-2">
                        Gestion de Fichiers
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="notifications" class="mr-2">
                        Notifications
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="analytics" class="mr-2">
                        Analytique/Rapports
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="messaging" class="mr-2">
                        Messagerie/Chat
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="geolocation" class="mr-2">
                        Géolocalisation
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="key_features[]" value="social" class="mr-2">
                        Fonctionnalités Sociales
                    </label>
                </div>
                <p class="text-gray-500 text-xs mt-1">Sélectionnez toutes les fonctionnalités applicables à votre projet</p>
            </div>

            <!-- Custom Features -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Fonctionnalités Additionnelles
                </label>
                <textarea
                    name="custom_features"
                    rows="3"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Décrivez toute fonctionnalité supplémentaire ou spécifique non mentionnée ci-dessus"></textarea>
                <p class="text-gray-500 text-xs mt-1">Listez les fonctionnalités personnalisées spécifiques à votre projet</p>
            </div>

            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Contraintes du Projet</h2>

            <!-- Budget Range -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Fourchette de Budget *
                </label>
                <select name="budget_range" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Sélectionnez une fourchette de budget</option>
                    <option value="Moins de 5 000 €">Moins de 5 000 €</option>
                    <option value="5 000 € - 10 000 €">5 000 € - 10 000 €</option>
                    <option value="10 000 € - 25 000 €">10 000 € - 25 000 €</option>
                    <option value="25 000 € - 50 000 €">25 000 € - 50 000 €</option>
                    <option value="50 000 € - 100 000 €">50 000 € - 100 000 €</option>
                    <option value="Plus de 100 000 €">Plus de 100 000 €</option>
                </select>
                <p class="text-gray-500 text-xs mt-1">Budget approximatif pour le développement</p>
            </div>

            <!-- Timeline -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Délai Souhaité *
                </label>
                <select name="timeline" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Sélectionnez un délai</option>
                    <option value="Moins d'1 mois">Moins d'1 mois</option>
                    <option value="1-3 mois">1-3 mois</option>
                    <option value="3-6 mois">3-6 mois</option>
                    <option value="6-12 mois">6-12 mois</option>
                    <option value="Plus de 12 mois">Plus de 12 mois</option>
                </select>
                <p class="text-gray-500 text-xs mt-1">Délai de développement prévu</p>
            </div>

            <!-- Deadline -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Date Limite Spécifique
                </label>
                <input
                    type="date"
                    name="deadline"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-gray-500 text-xs mt-1">Avez-vous une date de lancement spécifique en tête ?</p>
            </div>

            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Exigences Techniques</h2>

            <!-- Technical Requirements -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Exigences Techniques
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="technical_requirements[]" value="mobile_responsive" class="mr-2">
                        Responsive Mobile
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="technical_requirements[]" value="high_performance" class="mr-2">
                        Haute Performance
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="technical_requirements[]" value="scalability" class="mr-2">
                        Évolutivité
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="technical_requirements[]" value="security" class="mr-2">
                        Sécurité Renforcée
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="technical_requirements[]" value="accessibility" class="mr-2">
                        Conformité Accessibilité
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="technical_requirements[]" value="seo" class="mr-2">
                        Optimisation SEO
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="technical_requirements[]" value="multilingual" class="mr-2">
                        Support Multilingue
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="technical_requirements[]" value="third_party_integration" class="mr-2">
                        Intégrations Tierces
                    </label>
                </div>
                <p class="text-gray-500 text-xs mt-1">Sélectionnez toutes les options applicables à votre projet</p>
            </div>

            <!-- External APIs -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Intégrations API Externes
                </label>
                <textarea
                    name="external_apis"
                    rows="2"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Listez les API externes ou services que vous devez intégrer (ex: passerelles de paiement, réseaux sociaux, services de cartographie)"></textarea>
                <p class="text-gray-500 text-xs mt-1">Précisez les services tiers avec lesquels vous devez vous connecter</p>
            </div>

            <!-- Design Complexity -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Complexité du Design UI/UX
                </label>
                <select name="design_complexity" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionnez la complexité</option>
                    <option value="simple">Simple - Design fonctionnel avec éléments basiques</option>
                    <option value="moderate">Modéré - Design personnalisé avec quelques éléments uniques</option>
                    <option value="complex">Complexe - Hautement personnalisé avec interactions avancées</option>
                    <option value="premium">Premium - Design de pointe avec animations et expériences uniques</option>
                </select>
                <p class="text-gray-500 text-xs mt-1">Quelle doit être la complexité de l'interface utilisateur ?</p>
            </div>

            <!-- Maintenance -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Besoins de Maintenance
                </label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="needs_maintenance" value="1" class="mr-2">
                        <span>Nécessite une maintenance continue</span>
                    </label>
                </div>
                <div class="mt-3" id="maintenanceOptions" style="display: none;">
                    <label class="block text-gray-700 text-sm mb-2">
                        Type de Maintenance
                    </label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="maintenance_type[]" value="bug_fixes" class="mr-2">
                            Corrections de bugs et mises à jour
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="maintenance_type[]" value="content_updates" class="mr-2">
                            Mises à jour de contenu
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="maintenance_type[]" value="feature_additions" class="mr-2">
                            Ajout de nouvelles fonctionnalités
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="maintenance_type[]" value="performance_monitoring" class="mr-2">
                            Surveillance des performances
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-8">
                <button type="button" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500" id="resetForm">
                    Réinitialiser
                </button>
                <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center" id="submitButton">
                    <span>Analyser avec l'IA</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>

        <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mx-auto mb-4"></div>
                <p class="text-lg font-semibold">Analyse de vos besoins en cours...</p>
                <p class="text-sm text-gray-600 mt-2">Cela peut prendre un moment pendant que notre IA traite vos informations.</p>
            </div>
        </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
        // Show/hide maintenance options based on checkbox
        document.querySelector('input[name="needs_maintenance"]').addEventListener('change', function() {
            const maintenanceOptions = document.getElementById('maintenanceOptions');
            maintenanceOptions.style.display = this.checked ? 'block' : 'none';
        });

        // Reset form button
        document.getElementById('resetForm').addEventListener('click', function() {
            if (confirm('Are you sure you want to reset the form? All entered data will be lost.')) {
                document.getElementById('projectForm').reset();
                document.getElementById('maintenanceOptions').style.display = 'none';
            }
        });

        // Form submission
        document.getElementById('projectForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const submitButton = document.getElementById('submitButton');
            const loadingOverlay = document.getElementById('loadingOverlay');

            // Create an object to store the form data
            const data = {};

            // Handle checkbox arrays properly
            formData.forEach((value, key) => {
                if (key.endsWith('[]')) {
                    const actualKey = key.slice(0, -2);
                    if (!data[actualKey]) {
                        data[actualKey] = [];
                    }
                    data[actualKey].push(value);
                } else {
                    data[key] = value;
                }
            });

            // Handle needs_maintenance checkbox
            data.needs_maintenance = formData.has('needs_maintenance');

            // Ensure arrays are present even if empty
            if (!data.target_audience) data.target_audience = [];
            if (!data.key_features) data.key_features = [];
            if (!data.technical_requirements) data.technical_requirements = [];
            if (!data.user_roles) data.user_roles = [];
            if (!data.maintenance_type) data.maintenance_type = [];

            try {
                // Show loading overlay
                loadingOverlay.classList.remove('hidden');
                loadingOverlay.classList.add('flex');
                submitButton.disabled = true;

                const response = await fetch('/client-response', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(data)
                });

                // Check if the response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Server returned non-JSON response. Please try again.');
                }

                const result = await response.json();

                if (response.ok) {
                    window.location.href = `/client-response/${result.data.id}`;
                } else {
                    // Hide loading overlay
                    loadingOverlay.classList.add('hidden');
                    loadingOverlay.classList.remove('flex');
                    submitButton.disabled = false;

                    const errorMessage = result.message || 'Failed to submit form';
                    if (result.errors) {
                        const validationErrors = Object.values(result.errors).flat().join('\n');
                        alert('Validation errors:\n' + validationErrors);
                    } else {
                        alert('Error: ' + errorMessage);
                    }
                }
            } catch (error) {
                // Hide loading overlay
                loadingOverlay.classList.add('hidden');
                loadingOverlay.classList.remove('flex');
                submitButton.disabled = false;

                console.error('Error:', error);
                alert('Error submitting form: ' + error.message);
            }
        });
</script>
@endpush