<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PAUD Tunas Bangsa' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-white text-gray-800">

    <nav class="bg-white shadow-sm py-4" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-6 lg:px-16 flex justify-between items-center">
            
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/logo-paud.png') }}" alt="Logo" class="h-10 w-10"> 
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex space-x-8 font-medium">
                <a href="/" class="{{ request()->is('/') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 transition' }}">Beranda</a>
                <a href="/tentang-kami" class="{{ request()->is('tentang-kami') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 transition' }}">Tentang Kami</a>
                <a href="/pendaftaran" class="{{ request()->is('pendaftaran') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 transition' }}">Pendaftaran</a>
            </div>

            <!-- Tombol Hamburger Mobile -->
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Dropdown Menu Mobile -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-gray-50 border-t mt-4 absolute w-full left-0 z-40 shadow-md" 
             style="display: none;">
            <div class="flex flex-col px-6 py-4 space-y-4 font-medium">
                <a href="/" class="{{ request()->is('/') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 transition' }}">Beranda</a>
                <a href="/tentang-kami" class="{{ request()->is('tentang-kami') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 transition' }}">Tentang Kami</a>
                <a href="/pendaftaran" class="{{ request()->is('pendaftaran') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 transition' }}">Pendaftaran</a>
            </div>
        </div>
    </nav>

    <main class="grow">
        {{ $slot }}
    </main>

    <footer class="bg-gray-500 text-white pt-12 pb-6">
        <div class="container mx-auto px-6 lg:px-16 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('assets/images/logo-paud.png') }}" alt="Logo" class="h-10 w-10">
                    <h3 class="text-xl font-bold">PAUD TUNAS BANGSA</h3>
                </div>
                <p class="text-sm text-gray-200 leading-relaxed">
                    Membimbing tunas bangsa tumbuh cerdas, ceria, dan mandiri. Pendidikan usia dini berkualitas untuk masa depan Indonesia.
                </p>
            </div>

            <div class="md:pl-30">
                <h4 class="text-lg font-semibold mb-4">Navigasi</h4>
                <ul class="space-y-2 text-sm text-gray-200">
                    <li><a href="/" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="/tentang-kami" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="/pendaftaran" class="hover:text-white transition">Pendaftaran</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                <ul class="space-y-3 text-sm text-gray-200">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Jl. Kampus No. 64B RT 06 RW 07, Grendeng, Kec. Purwokerto Utara, Kab. Banyumas, Prov. Jawa Tengah</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>082241098124</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-400 mt-8 pt-6 text-center text-xs text-gray-300">
            &copy; 2026 Pos Paud Tunas Bangsa. All Rights Reserved.
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6282241098124" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 bg-green-500 text-white p-3 rounded-full shadow-lg hover:bg-green-600 hover:-translate-y-1 transition-all duration-300 z-50 flex items-center justify-center">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
        </svg>
    </a>
</body>
</html>