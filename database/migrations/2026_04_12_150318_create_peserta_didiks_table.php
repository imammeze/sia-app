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
        Schema::create('peserta_didiks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->foreignUuid('kelas_id')->nullable()->constrained('kelas')->nullOnDelete();
            $table->string('nis')->unique()->nullable();

            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nisn')->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_registrasi_akta_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('berkebutuhan_khusus')->nullable();
            
            $table->string('alamat_jalan')->nullable();
            $table->string('dusun')->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('kelurahan_desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten_kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos', 5)->nullable();
            $table->string('jenis_tinggal')->nullable();
            $table->string('alat_transportasi')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email_pribadi')->nullable();
            
            $table->string('no_kks')->nullable();
            $table->boolean('penerima_kps_pkh')->default(false);
            $table->string('no_kps_pkh')->nullable();
            $table->boolean('usulan_layak_pip')->default(false);
            $table->boolean('penerima_kip')->default(false);
            $table->string('no_kip')->nullable();

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

            $table->string('nama_wali')->nullable();
            $table->string('tahun_lahir_wali', 4)->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('penghasilan_wali')->nullable();

            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('jarak_ke_sekolah')->nullable();
            $table->string('waktu_tempuh')->nullable();
            $table->integer('jumlah_saudara_kandung')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_didiks');
    }
};