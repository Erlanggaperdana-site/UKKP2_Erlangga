<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengaduan')->unique();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->string('nomor_telepon', 30);
            $table->string('email');
            $table->text('isi_pengaduan');
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'created_at']);
        });
    }
    public function down(): void { Schema::dropIfExists('pengaduans'); }
};
