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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->string('no_pendaftaran')->unique();
            $table->enum('status', ['pending', 'sudah_daftar_ulang', 'batal'])->default('pending');
            $table->date('tanggal_daftar')->default(now());

            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nisn')->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_registrasi_akta_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('berkebutuhan_khusus')->nullable();
            
            $table->foreignUuid('alamat_id')->nullable()->constrained('alamats')->nullOnDelete();
            $table->foreignUuid('orang_tua_id')->nullable()->constrained('orang_tuas')->nullOnDelete();
            
            $table->foreignUuid('data_periodik_id')->nullable()->constrained('data_periodiks')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};