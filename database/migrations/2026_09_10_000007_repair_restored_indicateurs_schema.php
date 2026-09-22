<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('indicateurs')) {
            return;
        }

        Schema::table('indicateurs', function (Blueprint $table) {
            if (! Schema::hasColumn('indicateurs', 'projet_id')) {
                $table->unsignedBigInteger('projet_id')->nullable()->after('id')->index();
            }

            if (! Schema::hasColumn('indicateurs', 'valeur_cible')) {
                $table->decimal('valeur_cible', 15, 2)->nullable()->after('baseline');
            }

            if (! Schema::hasColumn('indicateurs', 'periode')) {
                $table->string('periode', 100)->nullable()->after('valeur_actuelle');
            }

            if (! Schema::hasColumn('indicateurs', 'est_actif')) {
                $table->boolean('est_actif')->default(true)->after('periode');
            }
        });

        DB::table('indicateurs')
            ->whereNull('valeur_cible')
            ->update(['valeur_cible' => DB::raw('cible_finale')]);

        DB::statement(
            'UPDATE indicateurs AS i
             INNER JOIN activites AS a ON a.id = i.activite_id
             INNER JOIN composantes AS c ON c.id = a.composante_id
             SET i.projet_id = c.projet_id
             WHERE i.projet_id IS NULL'
        );
    }

    public function down(): void
    {
        // Recovery migration: preserve restored and subsequently entered data.
    }
};
