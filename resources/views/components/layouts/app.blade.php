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

    <nav class="bg-white shadow-sm py-4">
        <div class="container mx-auto px-6 lg:px-16 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/logo-paud.png') }}" alt="Logo" class="h-10 w-10"> 
            </div>

            <div class="hidden md:flex space-x-8 font-medium">
                <a href="/" class="{{ request()->is('/') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 transition' }}">Beranda</a>
                <a href="/tentang-kami" class="{{ request()->is('tentang-kami') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 transition' }}">Tentang Kami</a>
                <a href="/pendaftaran" class="{{ request()->is('pendaftaran') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 transition' }}">Pendaftaran</a>
            </div>

            <div class="md:hidden">
                <button class="text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
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
</body>
</html>