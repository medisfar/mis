<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('menage_projet')) {
            Schema::create('menage_projet', function (Blueprint $table) {
                $table->id();
                $table->foreignId('menage_id')
                    ->constrained('menages')
                    ->cascadeOnDelete();
                $table->foreignId('projet_id')
                    ->constrained('projets')
                    ->cascadeOnDelete();
                $table->timestamps();

                $table->unique(['menage_id', 'projet_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('menage_projet');
    }
};
