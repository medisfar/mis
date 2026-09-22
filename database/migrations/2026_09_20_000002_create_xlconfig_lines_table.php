<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('xlconfig_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('xlconfig_id')->constrained('xlconfigs')->cascadeOnDelete();
            $table->string('line');
            $table->string('table');
            $table->string('field');
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('xlconfig_lines'); }
};
