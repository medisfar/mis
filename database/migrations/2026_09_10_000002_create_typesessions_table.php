<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('typesessions')) {
            Schema::create('typesessions', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('typesessions');
    }
};
