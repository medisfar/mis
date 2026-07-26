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
        Schema::create('uploadedfiles', function (Blueprint $table) {
            $table->id();
            
    $table->string('original_name');
    $table->string('stored_path');
    $table->string('modified_path')->nullable();
    $table->string('status')->default('not treated');
    $table->string('uuid');
    $table->string('modified_column')->nullable();
    $table->string('modified_value')->nullable();
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploadedfiles');
    }
};
