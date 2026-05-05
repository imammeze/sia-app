<x-layouts.app title="Pendaftaran | PAUD Tunas Bangsa">
    <div class="container mx-auto px-6 py-12" x-data="{ step: 1 }">
        
        @if(session('success'))
        <div class="max-w-4xl mx-auto mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <div class="flex justify-center mb-10 max-w-3xl mx-auto">
            <div class="flex items-center w-full">
                <div class="flex flex-col items-center relative z-10">
                    <div :class="{'bg-blue-600 text-white': step >= 1, 'bg-gray-200 text-gray-500': step < 1}" class="w-10 h-10 rounded-full flex items-center justify-center font-bold border-2 border-white shadow transition-colors duration-300">1</div>
                    <div class="text-xs font-semibold mt-2 text-center" :class="{'text-blue-600': step >= 1, 'text-gray-400': step < 1}">Identitas Anak</div>
                </div>
                <div class="flex-auto border-t-2 transition-colors duration-300" :class="{'border-blue-600': step >= 2, 'border-gray-200': step < 2}"></div>
                
                <div class="flex flex-col items-center relative z-10">
                    <div :class="{'bg-blue-600 text-white': step >= 2, 'bg-gray-200 text-gray-500': step < 2}" class="w-10 h-10 rounded-full flex items-center justify-center font-bold border-2 border-white shadow transition-colors duration-300">2</div>
                    <div class="text-xs font-semibold mt-2 text-center" :class="{'text-blue-600': step >= 2, 'text-gray-400': step < 2}">Data Orang Tua</div>
                </div>
                <div class="flex-auto border-t-2 transition-colors duration-300" :class="{'border-blue-600': step >= 3, 'border-gray-200': step < 3}"></div>
                
                <div class="flex flex-col items-center relative z-10">
                    <div :class="{'bg-blue-600 text-white': step >= 3, 'bg-gray-200 text-gray-500': step < 3}" class="w-10 h-10 rounded-full flex items-center justify-center font-bold border-2 border-white shadow transition-colors duration-300">3</div>
                    <div class="text-xs font-semibold mt-2 text-center" :class="{'text-blue-600': step >= 3, 'text-gray-400': step < 3}">Data Periodik</div>
                </div>
            </div>
        </div>

        <form action="{{ route('pendaftaran.store') }}" method="POST" class="bg-white p-6 md:p-10 rounded-xl shadow-lg max-w-4xl mx-auto border border-gray-100">
            @csrf

            <div x-show="step === 1" x-transition.opacity.duration.500ms>
                <div class="border-b pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Identitas Anak</h2>
                    <p class="text-gray-500 text-sm">Lengkapi data diri dan alamat peserta didik baru.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Nama Lengkap" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Agama</label>
                        <select name="agama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Tempat Lahir" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">NIK Anak (16 Digit)</label>
                        <input type="text" name="nik" maxlength="16" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan NIK Anak">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">No. Registrasi Akta Lahir</label>
                        <input type="text" name="no_registrasi_akta_lahir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Nomor Registrasi Akta Lahir">
                    </div>

                    <div class="md:col-span-2 mt-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-2">Kontak & Alamat</h3>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Jalan</label>
                        <textarea name="alamat_jalan" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Alamat Jalan"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kelurahan / Desa</label>
                        <input type="text" name="kelurahan_desa" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Kelurahan/Desa">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan</label>
                        <input type="text" name="kecamatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Kecamatan">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor WhatsApp Aktif <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" placeholder="08xxxx" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alat Transportasi ke Sekolah</label>
                        <input type="text" name="alat_transportasi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Jalan Kaki, Sepeda, Motor, dll.">
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="button" @click="step = 2" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2.5 rounded-lg transition shadow-md">Selanjutnya &raquo;</button>
                </div>
            </div>

            <div x-show="step === 2" x-transition.opacity.duration.500ms style="display: none;">
                <div class="border-b pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Data Orang Tua</h2>
                    <p class="text-gray-500 text-sm">Informasi Ayah dan Ibu kandung (atau wali).</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-blue-50 p-5 rounded-lg border border-blue-100">
                        <h3 class="font-bold text-blue-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Data Ayah Kandung
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Masukan Nama Ayah">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Tahun Lahir</label>
                                <input type="number" name="tahun_lahir_ayah" placeholder="Contoh: 1990" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Pendidikan</label>
                                <input type="text" name="pendidikan_ayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Masukan Pendidikan Terakhir Ayah">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Pekerjaan</label>
                                <input type="text" name="pekerjaan_ayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Masukan Pekerjaan Ayah">
                            </div>
                        </div>
                    </div>

                    <div class="bg-pink-50 p-5 rounded-lg border border-pink-100">
                        <h3 class="font-bold text-pink-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Data Ibu Kandung
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Masukan Nama Ibu">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Tahun Lahir</label>
                                <input type="number" name="tahun_lahir_ibu" placeholder="Contoh: 1992" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Pendidikan</label>
                                <input type="text" name="pendidikan_ibu" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Masukan Pendidikan Terakhir Ibu">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Pekerjaan</label>
                                <input type="text" name="pekerjaan_ibu" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Masukan Pekerjaan Ibu">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" @click="step = 1" class="border border-gray-300 text-gray-600 hover:bg-gray-50 font-semibold px-6 py-2.5 rounded-lg transition">&laquo; Kembali</button>
                    <button type="button" @click="step = 3" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2.5 rounded-lg transition shadow-md">Selanjutnya &raquo;</button>
                </div>
            </div>

            <div x-show="step === 3" x-transition.opacity.duration.500ms style="display: none;">
                <div class="border-b pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Data Periodik & Kesejahteraan</h2>
                    <p class="text-gray-500 text-sm">Informasi tambahan untuk profil Dapodik.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tinggi Badan (cm)</label>
                        <input type="number" name="tinggi_badan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Tinggi Badan Anak">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Berat Badan (kg)</label>
                        <input type="number" name="berat_badan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Berat Badan Anak">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Saudara Kandung</label>
                        <input type="number" name="jumlah_saudara_kandung" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Jumlah Saudara Kandung">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jarak Tempat Tinggal ke Sekolah</label>
                        <select name="jarak_ke_sekolah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="Kurang dari 1 km">Kurang dari 1 km</option>
                            <option value="Lebih dari 1 km">Lebih dari 1 km</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 mt-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-3 border-b pb-2">Program Kesejahteraan Sosial</h3>
                        <div class="flex flex-col sm:flex-row gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="penerima_kps_pkh" value="1" class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-sm font-medium text-gray-700">Penerima KPS / PKH</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="penerima_kip" value="1" class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-sm font-medium text-gray-700">Penerima KIP (Kartu Indonesia Pintar)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mt-8">
                    <p class="text-sm text-yellow-800">
                        <strong>Pernyataan:</strong> Saya menyatakan bahwa data yang diisikan di atas adalah benar dan dapat dipertanggungjawabkan.
                    </p>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" @click="step = 2" class="border border-gray-300 text-gray-600 hover:bg-gray-50 font-semibold px-6 py-2.5 rounded-lg transition">&laquo; Kembali</button>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-2.5 rounded-lg shadow-lg flex items-center gap-2 transition transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Kirim Pendaftaran
                    </button>
                </div>
            </div>
            
        </form>
    </div>
</x-layouts.app>