<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('membres', 'donnees_importees')) {
            Schema::table('membres', function (Blueprint $table) {
                $table->json('donnees_importees')->nullable()->after('enceinte');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('membres', 'donnees_importees')) {
            Schema::table('membres', function (Blueprint $table) {
                $table->dropColumn('donnees_importees');
            });
        }
    }
};
