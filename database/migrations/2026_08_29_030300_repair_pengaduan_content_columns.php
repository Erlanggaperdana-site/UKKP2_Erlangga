<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('pengaduans', 'isi_pengaduan')) {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->text('isi_pengaduan')->nullable();
            });
        }

        if (! Schema::hasColumn('pengaduans', 'foto')) {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->string('foto')->nullable();
            });
        }

        if (! Schema::hasColumn('pengaduans', 'status')) {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->string('status')->default('pending');
            });
        }
    }

    public function down(): void
    {
        // Kolom dipertahankan demi menjaga data pada database lama.
    }
};
