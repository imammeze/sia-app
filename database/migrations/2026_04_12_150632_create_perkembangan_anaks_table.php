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
        Schema::create('perkembangan_anaks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->foreignUuid('peserta_didik_id')->constrained('peserta_didiks')->cascadeOnDelete();
            $table->foreignUuid('guru_id')->constrained('gurus')->cascadeOnDelete();
            
            $table->string('tahun_ajaran', 20); 
            $table->enum('semester', ['ganjil', 'genap']);
            
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->text('komentar_guru')->nullable();
            $table->json('foto_kegiatan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkembangan_anaks');
    }
};