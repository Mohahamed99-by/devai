<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Technical Specification - Project Analysis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ url('/') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Form
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold mb-2">Technical Specification</h1>
            <p class="text-gray-600">AI-Generated Analysis for Your Project</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Original Requirements -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Project Requirements</h2>

                <div class="space-y-5">
                    <div>
                        <h3 class="font-semibold text-blue-700">Project Type</h3>
                        <p class="mt-1">{{ ucfirst(str_replace('_', ' ', $clientResponse->project_type)) }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-700">Description</h3>
                        <p class="mt-1 whitespace-pre-line">{{ $clientResponse->project_description }}</p>
                    </div>

                    @if(!empty($clientResponse->similar_applications))
                    <div>
                        <h3 class="font-semibold text-blue-700">Similar Applications</h3>
                        <p class="mt-1">{{ $clientResponse->similar_applications }}</p>
                    </div>
                    @endif

                    <div>
                        <h3 class="font-semibold text-blue-700">Target Audience</h3>
                        <ul class="list-disc list-inside mt-1">
                            @foreach($clientResponse->target_audience as $audience)
                                <li>{{ ucfirst(str_replace('_', ' ', $audience)) }}</li>
                            @endforeach
                        </ul>
                    </div>

                    @if(!empty($clientResponse->user_roles))
                    <div>
                        <h3 class="font-semibold text-blue-700">User Roles</h3>
                        <ul class="list-disc list-inside mt-1">
                            @foreach($clientResponse->user_roles as $role)
                                <li>{{ ucfirst(str_replace('_', ' ', $role)) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div>
                        <h3 class="font-semibold text-blue-700">Requested Features</h3>
                        <ul class="list-disc list-inside mt-1">
                            @foreach($clientResponse->key_features as $feature)
                                <li>{{ ucfirst(str_replace('_', ' ', $feature)) }}</li>
                            @endforeach
                        </ul>
                    </div>

                    @if(!empty($clientResponse->custom_features))
                    <div>
                        <h3 class="font-semibold text-blue-700">Additional Features</h3>
                        <p class="mt-1">{{ $clientResponse->custom_features }}</p>
                    </div>
                    @endif

                    <div>
                        <h3 class="font-semibold text-blue-700">Budget Range</h3>
                        <p class="mt-1">{{ $clientResponse->budget_range }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-700">Timeline</h3>
                        <p class="mt-1">{{ $clientResponse->timeline }}</p>
                    </div>

                    @if(!empty($clientResponse->deadline))
                    <div>
                        <h3 class="font-semibold text-blue-700">Specific Deadline</h3>
                        <p class="mt-1">{{ $clientResponse->deadline->format('F j, Y') }}</p>
                    </div>
                    @endif

                    @if(!empty($clientResponse->technical_requirements))
                    <div>
                        <h3 class="font-semibold text-blue-700">Technical Requirements</h3>
                        <ul class="list-disc list-inside mt-1">
                            @foreach($clientResponse->technical_requirements as $req)
                                <li>{{ ucfirst(str_replace('_', ' ', $req)) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(!empty($clientResponse->external_apis))
                    <div>
                        <h3 class="font-semibold text-blue-700">External API Integrations</h3>
                        <p class="mt-1">{{ $clientResponse->external_apis }}</p>
                    </div>
                    @endif

                    @if(!empty($clientResponse->design_complexity))
                    <div>
                        <h3 class="font-semibold text-blue-700">UI/UX Design Complexity</h3>
                        <p class="mt-1">{{ ucfirst($clientResponse->design_complexity) }}</p>
                    </div>
                    @endif

                    <div>
                        <h3 class="font-semibold text-blue-700">Maintenance Requirements</h3>
                        <p class="mt-1">{{ $clientResponse->needs_maintenance ? 'Yes' : 'No' }}</p>

                        @if($clientResponse->needs_maintenance && !empty($clientResponse->maintenance_type))
                        <div class="mt-2">
                            <h4 class="font-medium text-gray-700">Maintenance Type:</h4>
                            <ul class="list-disc list-inside ml-4">
                                @foreach($clientResponse->maintenance_type as $type)
                                    <li>{{ ucfirst(str_replace('_', ' ', $type)) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- AI Analysis -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4 pb-2 border-b">AI Technical Analysis</h2>

                <div class="space-y-5">
                    <div>
                        <h3 class="font-semibold text-blue-700">Project Summary</h3>
                        @if(!empty($clientResponse->ai_analysis_summary))
                            <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $clientResponse->ai_analysis_summary }}</p>
                        @else
                            <p class="mt-1 text-gray-500">No analysis summary available</p>
                        @endif
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-700">Recommended Technologies</h3>
                        @if(count($clientResponse->ai_suggested_technologies) > 0)
                            <ul class="mt-1 list-disc list-inside">
                                @foreach($clientResponse->ai_suggested_technologies as $tech)
                                    <li>{{ $tech }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-1 text-gray-500">No technologies suggested</p>
                        @endif
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-700">Recommended Features</h3>
                        @if(count($clientResponse->ai_suggested_features) > 0)
                            <ul class="mt-1 list-disc list-inside">
                                @foreach($clientResponse->ai_suggested_features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-1 text-gray-500">No features suggested</p>
                        @endif
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-700">Complexity Factors</h3>
                        @if(count($clientResponse->ai_complexity_factors) > 0)
                            <ul class="mt-1 list-disc list-inside">
                                @foreach($clientResponse->ai_complexity_factors as $factor)
                                    <li>{{ $factor }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-1 text-gray-500">No complexity factors identified</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 pt-4 border-t">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-700">Estimated Timeline</h3>
                            <p class="mt-1 text-2xl font-bold">{{ $clientResponse->ai_estimated_duration }}</p>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-700">Estimated Budget</h3>
                            <p class="mt-1 text-2xl font-bold">${{ number_format($clientResponse->ai_cost_estimate, 2) }}</p>
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t">
                        <p class="text-sm text-gray-500">
                            This technical specification was automatically generated by AI based on your project requirements.
                            The estimates provided are based on industry standards and may vary depending on specific project details.
                        </p>
                        <p class="text-sm text-gray-500 mt-2">
                            Generated on: {{ now()->format('F j, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ url('/pdf/generate/' . $clientResponse->id) }}" class="inline-block bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                </svg>
                Télécharger en PDF
            </a>
            <a href="{{ url('/') }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Nouvelle Analyse
            </a>
        </div>
    </div>
</body>
</html>