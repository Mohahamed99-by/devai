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
            // Add new fields after project_description
            $table->text('similar_applications')->nullable()->after('project_description');
            $table->json('user_roles')->nullable()->after('target_audience');
            $table->text('custom_features')->nullable()->after('key_features');
            $table->date('deadline')->nullable()->after('timeline');
            $table->text('external_apis')->nullable()->after('technical_requirements');
            $table->string('design_complexity')->nullable()->after('external_apis');
            $table->json('maintenance_type')->nullable()->after('needs_maintenance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_responses', function (Blueprint $table) {
            $table->dropColumn([
                'similar_applications',
                'user_roles',
                'custom_features',
                'deadline',
                'external_apis',
                'design_complexity',
                'maintenance_type'
            ]);
        });
    }
};
