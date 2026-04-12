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
        Schema::create('rapors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('peserta_didik_id')->constrained('peserta_didiks')->cascadeOnDelete();
            $table->foreignUuid('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->string('tahun_ajaran'); 
            $table->enum('semester', ['ganjil', 'genap']);
            $table->text('catatan_wali_kelas')->nullable();
            $table->timestamps();
            $table->unique(['peserta_didik_id', 'tahun_ajaran', 'semester']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapors');
    }
};