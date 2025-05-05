<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientResponse extends Model
{
    protected $fillable = [
        'project_type',
        'project_description',
        'similar_applications',
        'target_audience',
        'user_roles',
        'key_features',
        'custom_features',
        'budget_range',
        'timeline',
        'deadline',
        'technical_requirements',
        'external_apis',
        'design_complexity',
        'needs_maintenance',
        'maintenance_type',
        'ai_suggested_features',
        'ai_suggested_technologies',
        'ai_estimated_duration',
        'ai_analysis_summary',
        'ai_complexity_factors',
        'ai_cost_estimate'
    ];

    protected $casts = [
        'target_audience' => 'array',
        'user_roles' => 'array',
        'key_features' => 'array',
        'technical_requirements' => 'array',
        'maintenance_type' => 'array',
        'needs_maintenance' => 'boolean',
        'deadline' => 'date',
        'ai_suggested_features' => 'array',
        'ai_suggested_technologies' => 'array',
        'ai_complexity_factors' => 'array',
        'ai_cost_estimate' => 'decimal:2'
    ];
}