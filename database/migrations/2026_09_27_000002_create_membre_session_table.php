<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membre_session', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membre_id')->constrained('membres')->cascadeOnDelete();
            $table->date('date_session');
            $table->json('donnees');
            $table->timestamps();

            $table->index('date_session');
        });

        if (Schema::hasColumn('membres', 'donnees_importees')) {
            DB::table('membres')
                ->whereNotNull('donnees_importees')
                ->orderBy('id')
                ->chunkById(500, function ($membres): void {
                    $now = now();
                    $sessions = $membres->map(fn ($membre) => [
                        'membre_id' => $membre->id,
                        'date_session' => '2026-01-01',
                        'donnees' => $membre->donnees_importees,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ])->all();

                    DB::table('membre_session')->insert($sessions);
                });

            Schema::table('membres', function (Blueprint $table) {
                $table->dropColumn('donnees_importees');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('membres', 'donnees_importees')) {
            Schema::table('membres', function (Blueprint $table) {
                $table->json('donnees_importees')->nullable()->after('enceinte');
            });

            DB::table('membre_session')
                ->orderBy('id')
                ->get()
                ->each(function ($session): void {
                    DB::table('membres')
                        ->where('id', $session->membre_id)
                        ->update(['donnees_importees' => $session->donnees]);
                });
        }

        Schema::dropIfExists('membre_session');
    }
};
