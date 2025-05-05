<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_responses', function (Blueprint $table) {
            $table->id();
            $table->string('project_type')->nullable();
            $table->text('project_description')->nullable();
            $table->json('target_audience')->nullable();
            $table->json('key_features')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('timeline')->nullable();
            $table->json('technical_requirements')->nullable();
            $table->boolean('needs_maintenance')->default(false);

            // AI analysis fields
            $table->json('ai_suggested_features')->nullable();
            $table->json('ai_suggested_technologies')->nullable();
            $table->string('ai_estimated_duration')->nullable();
            $table->text('ai_analysis_summary')->nullable();
            $table->json('ai_complexity_factors')->nullable();
            $table->decimal('ai_cost_estimate', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_responses');
    }
};
