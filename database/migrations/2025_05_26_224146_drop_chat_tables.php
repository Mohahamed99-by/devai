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
        // Supprimer les tables du chatbot si elles existent
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat_conversations');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recréer les tables si nécessaire (optionnel)
        // Nous ne les recréons pas car nous supprimons définitivement le chatbot
    }
};
