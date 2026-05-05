<x-layouts.app title="Beranda | PAUD Tunas Bangsa">
    
    <section class="container mx-auto px-6 lg:px-16 py-12 md:py-20 flex flex-col-reverse md:flex-row items-center gap-12">
        <div class="w-full md:w-1/2 flex flex-col items-start text-center md:text-left">
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                Bermain, Belajar, dan<br>Tumbuh Bersama<br>Penuh Ceria!
            </h1>
            <p class="text-gray-600 mb-8 max-w-lg">
                Berikan si kecil pengalaman belajar yang menyenangkan, interaktif, dan penuh kasih sayang untuk mengoptimalkan masa keemasannya setiap hari.
            </p>
            <a href="/pendaftaran" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition duration-300">
                Daftar Sekarang
            </a>
        </div>
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="{{ asset('assets/images/ilustrasi.png') }}" alt="Ilustrasi PAUD" class="w-full max-w-lg">
        </div>
    </section>

    <section class="container mx-auto px-6 lg:px-16 py-16">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Program Unggulan</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 border-t-4 border-blue-500 rounded-b-lg shadow-sm hover:shadow-md transition text-center">
                <div class="text-blue-500 mb-4 flex justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-2 text-sm">Kelas Eksplorasi Sensori & Motorik</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Aktivitas fisik dan permainan sensorik yang dirancang khusus untuk melatih kecerdasan motorik kasar dan halus, serta merangsang kepekaan sensori anak.</p>
            </div>
            
            <div class="bg-white p-6 border-t-4 border-blue-500 rounded-b-lg shadow-sm hover:shadow-md transition text-center">
                <div class="text-blue-500 mb-4 flex justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-2 text-sm">Pendidikan Karakter & Akhlak</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Membangun pondasi moral yang kuat melalui pembiasaan positif sehari-hari, mengajarkan empati, kemandirian, dan adab yang baik dalam lingkungan yang mendukung.</p>
            </div>

            <div class="bg-white p-6 border-t-4 border-blue-500 rounded-b-lg shadow-sm hover:shadow-md transition text-center">
                <div class="text-blue-500 mb-4 flex justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-2 text-sm">Kreativitas Seni & Imajinasi</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Ruang bebas bagi si kecil untuk menggali potensi seni melalui kegiatan menggambar, mewarnai, kerajinan tangan, dan bermusik.</p>
            </div>

            <div class="bg-white p-6 border-t-4 border-blue-500 rounded-b-lg shadow-sm hover:shadow-md transition text-center">
                <div class="text-blue-500 mb-4 flex justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-2 text-sm">Pengenalan Logika Dasar & Calistung</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Pembekalan belajar membaca, menulis, dan berhitung (calistung) yang imajinatif, dipadukan dengan permainan logika sederhana.</p>
            </div>
        </div>
    </section>

    <section class="bg-blue-600 py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <h2 class="text-3xl font-bold text-center text-white mb-12">Guru Kami</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl overflow-hidden shadow-lg p-2">
                    <img src="{{ asset('assets/images/CuciHaryati.jpeg') }}" alt="Cuci Haryati" class="w-full h-72 object-cover rounded-lg bg-gray-200">
                    <div class="text-center p-4">
                        <h3 class="font-bold text-gray-800">Cuci Haryati</h3>
                        <p class="text-xs text-gray-500 mt-1">Kepala Sekolah</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-lg p-2">
                    <img src="{{ asset('assets/images/Sulistyani.jpeg') }}" alt="Sulistyani" class="w-full h-72 object-cover rounded-lg bg-gray-200">
                    <div class="text-center p-4">
                        <h3 class="font-bold text-gray-800">Sulistyani</h3>
                        <p class="text-xs text-gray-500 mt-1">Guru</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-lg p-2">
                    <img src="{{ asset('assets/images/Akhyani.jpeg') }}" alt="Akhyani" class="w-full h-72 object-cover rounded-lg bg-gray-200">
                    <div class="text-center p-4">
                        <h3 class="font-bold text-gray-800">Akhyani</h3>
                        <p class="text-xs text-gray-500 mt-1">Guru</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-lg p-2">
                    <img src="{{ asset('assets/images/Ika.jpeg') }}" alt="Ika Rusdwuhartanti" class="w-full h-72 object-cover rounded-lg bg-gray-200">
                    <div class="text-center p-4">
                        <h3 class="font-bold text-gray-800">Ika Rusdwuhartanti</h3>
                        <p class="text-xs text-gray-500 mt-1">Guru</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 lg:px-16 py-16">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Galeri</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div class="bg-gray-300 rounded-lg aspect-4/3 w-full"></div>
            <div class="bg-gray-300 rounded-lg aspect-square w-full"></div>
            <div class="bg-gray-300 rounded-lg md:row-span-2 w-full h-full min-h-62.5"></div>
            <div class="bg-gray-300 rounded-lg aspect-square w-full"></div>
            <div class="bg-gray-300 rounded-lg aspect-4/3 w-full"></div>
            <div class="bg-gray-300 rounded-lg aspect-square w-full"></div>
            <div class="bg-gray-300 rounded-lg aspect-square w-full"></div>
            <div class="bg-gray-300 rounded-lg aspect-square w-full hidden md:block"></div>
        </div>
    </section>

</x-layouts.app>