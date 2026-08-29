<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('pengaduans', 'nomor_pengaduan')) {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->string('nomor_pengaduan')->nullable()->unique();
            });

            DB::table('pengaduans')
                ->whereNull('nomor_pengaduan')
                ->orderBy('id')
                ->eachById(function (object $pengaduan): void {
                    DB::table('pengaduans')
                        ->where('id', $pengaduan->id)
                        ->update([
                            'nomor_pengaduan' => sprintf('PGD-LGC%08d', $pengaduan->id),
                        ]);
                });
        }

        if (! Schema::hasColumn('pengaduans', 'user_id')) {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            });
        }

        if (! Schema::hasColumn('pengaduans', 'role_id')) {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->foreignId('role_id')->nullable()->constrained()->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Migration ini memperbaiki struktur database lama, sehingga data tidak dihapus saat rollback.
    }
};
