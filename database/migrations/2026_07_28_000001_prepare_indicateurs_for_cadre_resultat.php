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
                $column = $table->decimal('valeur_cible', 15, 2)->nullable();
                if (Schema::hasColumn('indicateurs', 'baseline')) {
                    $column->after('baseline');
                }
            }

            if (! Schema::hasColumn('indicateurs', 'periode')) {
                $column = $table->string('periode', 100)->nullable();
                if (Schema::hasColumn('indicateurs', 'valeur_actuelle')) {
                    $column->after('valeur_actuelle');
                }
            }

            if (! Schema::hasColumn('indicateurs', 'est_actif')) {
                $table->boolean('est_actif')->default(true)->after('periode');
            }
        });

        if (
            DB::getDriverName() === 'mysql' &&
            Schema::hasColumn('indicateurs', 'activite_id')
        ) {
            DB::statement('ALTER TABLE indicateurs MODIFY activite_id INT NULL');
        }

        if (
            DB::getDriverName() === 'mysql' &&
            Schema::hasColumn('indicateurs', 'valeur_actuelle')
        ) {
            DB::statement(
                'ALTER TABLE indicateurs MODIFY valeur_actuelle DECIMAL(15, 2) NULL'
            );
        }

        if (
            Schema::hasColumn('indicateurs', 'valeur_cible') &&
            Schema::hasColumn('indicateurs', 'cible_finale')
        ) {
            DB::table('indicateurs')
                ->whereNull('valeur_cible')
                ->update(['valeur_cible' => DB::raw('cible_finale')]);
        }

        if (
            Schema::hasColumn('indicateurs', 'projet_id') &&
            Schema::hasColumn('indicateurs', 'activite_id') &&
            Schema::hasTable('activites') &&
            Schema::hasTable('composantes') &&
            DB::getDriverName() === 'mysql'
        ) {
            DB::statement(
                'UPDATE indicateurs AS i
                 INNER JOIN activites AS a ON a.id = i.activite_id
                 INNER JOIN composantes AS c ON c.id = a.composante_id
                 SET i.projet_id = c.projet_id
                 WHERE i.projet_id IS NULL'
            );
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('indicateurs')) {
            return;
        }

        Schema::table('indicateurs', function (Blueprint $table) {
            if (Schema::hasColumn('indicateurs', 'projet_id')) {
                $table->dropIndex(['projet_id']);
                $table->dropColumn('projet_id');
            }

            if (Schema::hasColumn('indicateurs', 'valeur_cible')) {
                $table->dropColumn('valeur_cible');
            }

            if (Schema::hasColumn('indicateurs', 'periode')) {
                $table->dropColumn('periode');
            }

            if (Schema::hasColumn('indicateurs', 'est_actif')) {
                $table->dropColumn('est_actif');
            }
        });

        // activite_id reste nullable et valeur_actuelle reste décimale afin
        // qu'un rollback ne détruise pas de nouvelles données.
    }
};
