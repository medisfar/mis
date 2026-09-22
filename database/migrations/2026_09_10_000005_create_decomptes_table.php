<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('decomptes')) {
            Schema::create('decomptes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('activite_id')->index();
                $table->unsignedBigInteger('site_id')->default(0)->index();
                $table->unsignedBigInteger('tache_id')->nullable()->index();
                $table->string('libelle');
                $table->decimal('montant', 15, 2);
                $table->date('date_effective');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('decomptes');
    }
};
