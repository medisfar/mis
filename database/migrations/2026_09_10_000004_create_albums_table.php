<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('albums')) {
            Schema::create('albums', function (Blueprint $table) {
                $table->id();
                $table->foreignId('projet_id')
                    ->constrained('projets')
                    ->cascadeOnDelete();
                $table->string('titre');
                $table->date('date_photos');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
