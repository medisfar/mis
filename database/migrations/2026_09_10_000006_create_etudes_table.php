<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('etudes')) {
            Schema::create('etudes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('projet_id')
                    ->constrained('projets')
                    ->cascadeOnDelete();
                $table->string('categorie');
                $table->string('nom');
                $table->text('objectif');
                $table->text('methologie');
                $table->text('resultats_principaux');
                $table->text('reommendations_cles');
                $table->date('date_debut');
                $table->date('date_fin');
                $table->unsignedTinyInteger('statut');
                $table->text('Zones');
                $table->string('partenaire');
                $table->text('lecons_apprises');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('etudes');
    }
};
