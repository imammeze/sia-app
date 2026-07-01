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
        Schema::create('orang_tuas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->string('no_hp')->nullable();
            $table->string('email_pribadi')->nullable();
            
            $table->string('nama_ayah')->nullable();
            $table->string('tahun_lahir_ayah', 4)->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('berkebutuhan_khusus_ayah')->nullable();

            $table->string('nama_ibu')->nullable();
            $table->string('tahun_lahir_ibu', 4)->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('berkebutuhan_khusus_ibu')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tuas');
    }
};
