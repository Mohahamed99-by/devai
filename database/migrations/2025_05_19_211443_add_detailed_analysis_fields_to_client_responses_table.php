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
        Schema::table('client_responses', function (Blueprint $table) {
            // Add new fields for detailed analysis
            $table->json('ai_detailed_analysis')->nullable()->after('ai_analysis_summary');
            $table->json('ai_recommendations')->nullable()->after('ai_complexity_factors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_responses', function (Blueprint $table) {
            // Remove the new fields
            $table->dropColumn('ai_detailed_analysis');
            $table->dropColumn('ai_recommendations');
        });
    }
};
