<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('taches', 'projet_id')) {
            Schema::table('taches', function (Blueprint $table) {
                $table->unsignedBigInteger('projet_id')->nullable()->after('id')->index();
            });
        }

        // Une tâche appartient au même projet que la composante de son activité.
        DB::statement(
            'UPDATE taches AS t
             INNER JOIN activites AS a ON a.id = t.activite_id
             INNER JOIN composantes AS c ON c.id = a.composante_id
             SET t.projet_id = c.projet_id
             WHERE t.projet_id IS NULL'
        );
    }

    public function down(): void
    {
        if (Schema::hasColumn('taches', 'projet_id')) {
            Schema::table('taches', function (Blueprint $table) {
                $table->dropIndex(['projet_id']);
                $table->dropColumn('projet_id');
            });
        }
    }
};
