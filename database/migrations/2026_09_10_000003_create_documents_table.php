<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('documents')) {
            Schema::create('documents', function (Blueprint $table) {
                $table->id();
                $table->foreignId('projet_id')
                    ->constrained('projets')
                    ->cascadeOnDelete();
                $table->string('titre');
                $table->string('fichier');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
