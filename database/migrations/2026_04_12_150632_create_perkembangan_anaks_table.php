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
            
            $table->foreignUuid('tema_id')->nullable()->constrained('temas')->nullOnDelete();
            
            $table->date('tanggal');
            $table->enum('aspek_perkembangan', ['nilai_agama_moral', 'fisik_motorik', 'kognitif', 'bahasa', 'sosial_emosional', 'seni']);
            $table->text('catatan');
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