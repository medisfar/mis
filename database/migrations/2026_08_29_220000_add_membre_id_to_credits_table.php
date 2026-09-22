<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('credits', function (Blueprint $table) {
            $table->unsignedBigInteger('membre_id')->nullable()->after('id')->index();
        });
    }

    public function down(): void
    {
        Schema::table('credits', function (Blueprint $table) {
            $table->dropIndex(['membre_id']);
            $table->dropColumn('membre_id');
        });
    }
};
