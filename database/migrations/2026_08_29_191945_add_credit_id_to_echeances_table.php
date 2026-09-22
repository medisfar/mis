<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('echeances', function (Blueprint $table) {
            $table->unsignedBigInteger('credit_id')->nullable()->after('id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('echeances', function (Blueprint $table) {
            $table->dropIndex(['credit_id']);
            $table->dropColumn('credit_id');
        });
    }
};
