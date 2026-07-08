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
        Schema::create('nilai_perkembangans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('perkembangan_anak_id')->constrained('perkembangan_anaks')->restrictOnDelete();
            $table->foreignUuid('capaian_pembelajaran_id')->constrained('capaian_pembelajarans')->restrictOnDelete();
            $table->enum('tingkat_capaian', ['BB', 'MB', 'BSH', 'BSB']);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['perkembangan_anak_id', 'capaian_pembelajaran_id'], 'nilai_perkembangan_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_perkembangans');
    }
};
