<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('groupements', function (Blueprint $table) {
            $table->string('mere_conseilere')->nullable()->after('nom_groupe');
        });
    }

    public function down(): void
    {
        Schema::table('groupements', function (Blueprint $table) {
            $table->dropColumn('mere_conseilere');
        });
    }
};
