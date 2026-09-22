<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('groupements', 'projet_id')) {
            Schema::table('groupements', function (Blueprint $table) {
                $table->unsignedBigInteger('projet_id')->nullable()->after('id')->index();
            });
        }

        if (
            Schema::hasColumn('groupements', 'site_id')
            && Schema::hasColumn('sites', 'projet_id')
        ) {
            DB::statement(
                'UPDATE groupements g
                 INNER JOIN sites s ON s.id = g.site_id
                 SET g.projet_id = s.projet_id
                 WHERE g.projet_id IS NULL'
            );
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('groupements', 'projet_id')) {
            Schema::table('groupements', function (Blueprint $table) {
                $table->dropIndex(['projet_id']);
                $table->dropColumn('projet_id');
            });
        }
    }
};
