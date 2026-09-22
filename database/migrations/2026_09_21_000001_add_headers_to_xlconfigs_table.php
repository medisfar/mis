<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void { Schema::table('xlconfigs', fn (Blueprint $table) => $table->json('headers')->nullable()->after('name')); }
    public function down(): void { Schema::table('xlconfigs', fn (Blueprint $table) => $table->dropColumn('headers')); }
};
