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

    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Guru Kami</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="flex flex-col">
                    <img src="{{ asset('assets/images/CuciHaryati.jpeg') }}" alt="Cuci Haryati" class="w-full h-80 object-cover rounded-2xl bg-gray-200 shadow-md">
                    <div class="mt-5 text-left">
                        <h3 class="font-bold text-xl text-gray-900">Cuci Haryati</h3>
                        <p class="text-sm text-blue-600 mt-1">Kepala Sekolah</p>
                    </div>
                </div>

                <div class="flex flex-col">
                    <img src="{{ asset('assets/images/Sulistyani.jpeg') }}" alt="Sulistyani" class="w-full h-80 object-cover rounded-2xl bg-gray-200 shadow-md">
                    <div class="mt-5 text-left">
                        <h3 class="font-bold text-xl text-gray-900">Sulistyani</h3>
                        <p class="text-sm text-blue-600 mt-1">Guru</p>
                    </div>
                </div>

                <div class="flex flex-col">
                    <img src="{{ asset('assets/images/Akhyani.jpeg') }}" alt="Akhyani" class="w-full h-80 object-cover rounded-2xl bg-gray-200 shadow-md">
                    <div class="mt-5 text-left">
                        <h3 class="font-bold text-xl text-gray-900">Akhyani</h3>
                        <p class="text-sm text-blue-600 mt-1">Guru</p>
                    </div>
                </div>

                <div class="flex flex-col">
                    <img src="{{ asset('assets/images/Ika.jpeg') }}" alt="Ika Rusdwuhartanti" class="w-full h-80 object-cover rounded-2xl bg-gray-200 shadow-md">
                    <div class="mt-5 text-left">
                        <h3 class="font-bold text-xl text-gray-900">Ika Rusdwuhartanti</h3>
                        <p class="text-sm text-blue-600 mt-1">Guru</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 lg:px-16 py-16" x-data="{
        isAnim: false,
        startX: 0,
        next() {
            if(this.isAnim) return;
            this.isAnim = true;
            let container = this.$refs.carousel;
            let itemWidth = container.firstElementChild.offsetWidth + 16; 
            
            container.scrollBy({ left: itemWidth, behavior: 'smooth' });
            
            setTimeout(() => {
                container.appendChild(container.firstElementChild);
                container.scrollLeft -= itemWidth;
                this.isAnim = false;
            }, 400); 
        },
        prev() {
            if(this.isAnim) return;
            this.isAnim = true;
            let container = this.$refs.carousel;
            let itemWidth = container.firstElementChild.offsetWidth + 16;
            
            container.prepend(container.lastElementChild);
            container.scrollLeft += itemWidth;
            
            setTimeout(() => {
                container.scrollBy({ left: -itemWidth, behavior: 'smooth' });
                setTimeout(() => {
                    this.isAnim = false;
                }, 400);
            }, 30);
        },
        touchStart(e) {
            this.startX = e.changedTouches[0].screenX;
        },
        touchEnd(e) {
            let endX = e.changedTouches[0].screenX;
            if (this.startX - endX > 50) this.next();
            if (endX - this.startX > 50) this.prev();
        }
    }">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Galeri</h2>
            <div class="flex gap-2">
                <button @click="prev" class="p-2 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="next" class="p-2 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
        
        <div x-ref="carousel" @touchstart="touchStart" @touchend="touchEnd" class="flex overflow-hidden gap-4 pb-4 select-none">
            @for ($i = 1; $i <= 8; $i++)
            <!-- Item {{ $i }} -->
            <div class="snap-center shrink-0 w-full md:w-[calc((100%-1rem)/2)] lg:w-[calc((100%-2rem)/3)] rounded-xl aspect-4/3 overflow-hidden shadow-md group relative bg-black">
                <img src="{{ asset('assets/gallery/galeri' . $i . '.jpeg') }}" class="w-full h-full object-cover opacity-60 transition-all duration-500 group-hover:opacity-100 group-hover:scale-110" alt="Galeri {{ $i }}">
            </div>
            @endfor
        </div>
    </section>

</x-layouts.app>