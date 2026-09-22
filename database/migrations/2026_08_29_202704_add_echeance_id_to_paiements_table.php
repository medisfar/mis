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
        if (Schema::hasColumn('paiements', 'credit') && ! Schema::hasColumn('paiements', 'credit_id')) {
            Schema::table('paiements', function (Blueprint $table) {
                $table->renameColumn('credit', 'credit_id');
            });
        }

        if (! Schema::hasColumn('paiements', 'echeance_id')) {
            Schema::table('paiements', function (Blueprint $table) {
                $table->unsignedBigInteger('echeance_id')->nullable()->after('credit_id')->index();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropIndex(['echeance_id']);
            $table->dropColumn('echeance_id');
        });
    }
};
