<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ivaleurs', function (Blueprint $table) {
            $table->bigInteger('valeur')->change();
            $table->bigInteger('valeur_cible')->nullable()->after('periode');
            $table->timestamps();
            $table->index('indicateur_id');
            $table->unique(['indicateur_id', 'periode']);
        });
    }

    public function down(): void
    {
        Schema::table('ivaleurs', function (Blueprint $table) {
            $table->dropUnique(['indicateur_id', 'periode']);
            $table->dropIndex(['indicateur_id']);
            $table->dropTimestamps();
            $table->dropColumn('valeur_cible');
            $table->decimal('valeur', 10, 0)->change();
        });
    }
};
