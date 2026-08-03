<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('resultats', 'mission_id')) {
            Schema::table('resultats', function (Blueprint $table) {
                $table->unsignedBigInteger('mission_id')->nullable()->after('id')->index();
            });
        }
        if (! Schema::hasColumn('resultats', 'position')) {
            Schema::table('resultats', function (Blueprint $table) {
                $table->unsignedInteger('position')->default(1)->after('description');
            });
        }
        if (Schema::hasColumn('resultats', 'produit_id')) {
            Schema::table('resultats', function (Blueprint $table) {
                $table->integer('produit_id')->nullable()->change();
            });
        }

        if (! Schema::hasTable('odds')) {
            Schema::create('odds', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
            });
        }
        if (! Schema::hasTable('odd_resultat')) {
            Schema::create('odd_resultat', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('odd_id')->index();
                $table->unsignedBigInteger('resultat_id')->index();
                $table->unique(['odd_id', 'resultat_id']);
            });
        }

        if (! Schema::hasColumn('produits', 'resultat_id')) {
            Schema::table('produits', function (Blueprint $table) {
                $table->unsignedBigInteger('resultat_id')->nullable()->after('id')->index();
            });
        }

        // Une ancienne relation N-N était utilisée. Seules les affectations non
        // ambiguës sont reprises automatiquement; les autres resteront à affecter.
        if (Schema::hasTable('produit_resultat')) {
            $affectations = DB::table('produit_resultat')
                ->select('produit_id', DB::raw('MIN(resultat_id) as resultat_id'))
                ->groupBy('produit_id')
                ->havingRaw('COUNT(DISTINCT resultat_id) = 1')
                ->get();

            foreach ($affectations as $affectation) {
                DB::table('produits')
                    ->where('id', $affectation->produit_id)
                    ->whereNull('resultat_id')
                    ->update(['resultat_id' => $affectation->resultat_id]);
            }
        }

        Schema::table('activite_produit', function (Blueprint $table) {
            if (! Schema::hasColumn('activite_produit', 'ssprefecture_id')) {
                $table->unsignedBigInteger('ssprefecture_id')->nullable()->after('produit_id')->index();
            }
            if (! Schema::hasColumn('activite_produit', 'localite_id')) {
                $table->unsignedBigInteger('localite_id')->nullable()->after('ssprefecture_id')->index();
            }
            if (! Schema::hasColumn('activite_produit', 'indicateur_realise')) {
                $table->decimal('indicateur_realise', 15, 2)->nullable()->after('localite_id');
            }
            if (! Schema::hasColumn('activite_produit', 'unite')) {
                $table->string('unite')->nullable()->after('indicateur_realise');
            }
            if (! Schema::hasColumn('activite_produit', 'cout')) {
                $table->decimal('cout', 18, 2)->default(0)->after('unite');
            }
            if (! Schema::hasColumn('activite_produit', 'commentaire')) {
                $table->text('commentaire')->nullable()->after('cout');
            }
        });

        // Reprise géographique des anciennes contributions à partir de l'activité.
        if (Schema::hasColumn('activites', 'localite_id')) {
            DB::statement('
                UPDATE activite_produit ap
                JOIN activites a ON a.id = ap.activite_id
                LEFT JOIN localites l ON l.id = a.localite_id
                SET ap.localite_id = COALESCE(ap.localite_id, a.localite_id),
                    ap.ssprefecture_id = COALESCE(ap.ssprefecture_id, l.ssprefecture_id)
                WHERE ap.localite_id IS NULL OR ap.ssprefecture_id IS NULL
            ');
        }
    }

    public function down(): void
    {
        Schema::table('activite_produit', function (Blueprint $table) {
            foreach ([
                'ssprefecture_id', 'localite_id', 'indicateur_realise',
                'unite', 'cout', 'commentaire',
            ] as $column) {
                if (Schema::hasColumn('activite_produit', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        if (Schema::hasColumn('produits', 'resultat_id')) {
            Schema::table('produits', fn (Blueprint $table) => $table->dropColumn('resultat_id'));
        }

        // Les tables ODD et les colonnes historiques de résultats ne sont pas
        // supprimées au rollback afin d'éviter toute perte de données métier.
    }
};
