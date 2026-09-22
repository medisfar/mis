<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('groupements', function (Blueprint $table) {
            $table->renameColumn('mere_conseilere', 'mere_conseillere');
        });
    }

    public function down(): void
    {
        Schema::table('groupements', function (Blueprint $table) {
            $table->renameColumn('mere_conseillere', 'mere_conseilere');
        });
    }
};
