<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientResponse extends Model
{
    protected $fillable = [
        'user_id',
        'temp_identifier',
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
        'ai_detailed_analysis',
        'ai_complexity_factors',
        'ai_recommendations',
        'ai_cost_estimate',
        'status'
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
        'ai_detailed_analysis' => 'array',
        'ai_complexity_factors' => 'array',
        'ai_recommendations' => 'array',
        'ai_cost_estimate' => 'decimal:2'
    ];

    /**
     * Get the user that owns the client response
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the client response is a draft
     */
    public function isDraft()
    {
        return $this->status === 'draft';
    }

    /**
     * Check if the client response is validated
     */
    public function isValidated()
    {
        return $this->status === 'validated';
    }

    /**
     * Get the messages associated with this client response
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}