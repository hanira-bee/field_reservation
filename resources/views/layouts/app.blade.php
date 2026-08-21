<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORT CENTER</title>

    <!-- link icon dan font -->
    <link rel="icon" type="image/png" href="/images/volleyball-solid.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Stack+Sans+Notch:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://tailwindcss.com"></script>

    <style>
        /* Animasi bergerak maju mundur untuk panah kanan */
        @keyframes pingpongRight {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(6px);
            }

            /* Jarak lompatan panah ke kanan */
        }

        /* Animasi bergerak maju mundur untuk panah kiri */
        @keyframes pingpongLeft {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-6px);
            }

            /* Jarak lompatan panah ke kiri */
        }
    </style>

    @vite('resources/css/app.css')

    @stack('head')
</head>

<body class="bg-white min-h-screen">
    <div class="min-h-screen flex">
        <!-- /* ---------------------------------- ASIDE (SIDEBAR MOBILE)--------------------------------- */ -->
        <aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-50 transition-transform duration-300 -translate-x-full md:-translate-x-full">
            <div class="px-6 sm:px-8 pt-6 sm:pt-8 flex items-center gap-2 mb-8 sm:mb-10">
                <h1 class="text-lg sm:text-2xl font-bold text-red-600 tracking-wide">SM SPORT CENTER</h1>
            </div>

            @php
            $activeClass = 'bg-red-50 text-red-700 font-bold shadow-sm';
            $normalClass = 'text-gray-600 hover:bg-gray-100 font-semibold';
            @endphp

            <nav class="flex-1 px-3 sm:px-4 space-y-1 sm:space-y-2">
                <a href="{{ route('home') }}" class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 rounded-2xl transition {{ request()->routeIs('home') ? $activeClass : $normalClass }}">
                    <i class="fas fa-chart-pie text-sm sm:text-base w-5 sm:w-6 text-center"></i>
                    <span class="text-sm sm:text-base">
                        <h2>Beranda</h2>
                    </span>
                </a>

                <a href="{{ route('lapangan') }}" class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 rounded-2xl transition {{ request()->routeIs('lapangan') ? $activeClass : $normalClass }}">
                    <i class="fas fa-table-cells text-sm sm:text-base w-5 sm:w-6 text-center"></i>
                    <span class="text-sm sm:text-base">
                        <h2>Lapangan</h2>
                    </span>
                </a>

                <a href="{{ route('kontak') }}" class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 rounded-2xl transition {{ request()->routeIs('kontak') ? $activeClass : $normalClass }}">
                    <i class="fas fa-envelope text-sm sm:text-base w-5 sm:w-6 text-center"></i>
                    <span class="text-sm sm:text-base">
                        <h2>Kontak Kami</h2>
                    </span>
                </a>

                <a href="{{ route('tentang') }}" class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 rounded-2xl transition {{ request()->routeIs('tentang') ? $activeClass : $normalClass }}">
                    <i class="fas fa-table-cells text-sm sm:text-base w-5 sm:w-6 text-center"></i>
                    <span class="text-sm sm:text-base">
                        <h2>Tentang Kami</h2>
                    </span>
                </a>
            </nav>
        </aside>

        <!-- /* --------------------------------- OVERLAY -------------------------------- */ -->
        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300 md:hidden"></div>

        <!-- /* ------------------------------- KONTEN HALAMAN ------------------------------- */ -->
        <main class="flex-1 flex flex-col min-h-screen overflow-y-auto relative z-10 w-full pt-16 sm:pt-20">
            <!-- /* --------------------------------- HEADER --------------------------------- */ -->
            <header class="w-full flex flex-wrap items-center justify-between gap-3 px-4 sm:px-8 py-2 sm:py-4 bg-white fixed top-0 z-30 shadow-sm">

                <!-- logo & Mobile Menu Trigger -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <button class="p-1.5 sm:p-2 text-red-600 hover:bg-gray-100 rounded-lg md:hidden flex items-center justify-center" onclick="toggleSidebar()">
                        <i class="fas fa-bars text-base sm:text-lg"></i>
                    </button>
                    <a href="{{ route('home') }}">
                        <span class="font-stack font-extrabold text-red-800 text-xs sm:text-sm md:text-base lg:text-lg tracking-wider">SM SPORT CENTER</span>
                    </a>
                </div>

                <!-- /* --------------------------------- NAVBAR MENU --------------------------------- */ -->
                <nav class="font-prompt hidden md:flex items-center gap-1 sm:gap-2">
                    <a href="{{ route('home') }}" class="text-xs sm:text-sm md:text-base px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('home') ? 'text-red-600 font-bold bg-red-50' : 'text-gray-600 hover:text-red-600 hover:bg-gray-50' }}">Beranda</a>
                    <a href="{{ route('lapangan') }}" class="text-xs sm:text-sm md:text-base px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('lapangan') ? 'text-red-600 font-bold bg-red-50' : 'text-gray-600 hover:text-red-600 hover:bg-gray-50' }}">Lapangan</a>
                    <a href="{{ route('kontak') }}" class="text-xs sm:text-sm md:text-base px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('kontak') ? 'text-red-600 font-bold bg-red-50' : 'text-gray-600 hover:text-red-600 hover:bg-gray-50' }}">Kontak Kami</a>
                    <a href="{{ route('tentang') }}" class="text-xs sm:text-sm md:text-base px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('tentang') ? 'text-red-600 font-bold bg-red-50' : 'text-gray-600 hover:text-red-600 hover:bg-gray-50' }}">Tentang Kami</a>
                </nav>

                <!-- /* ----------------------------- USER PROFILE / AUTH BUTTONS ----------------------------- */ -->
                <div class="font-rubik flex items-center gap-2 sm:gap-3 ml-auto md:ml-0">
                    @auth
                    <!-- TAMPILAN JIKA PENGGUNA SUDAH LOGIN -->
                    <div class="relative inline-block text-left" id="user-profile-dropdown">
                        <!-- Tombol Profil (Pemicu Klik) -->
                        <button type="button" onclick="toggleDropdownProfil()" class="flex items-center gap-3 bg-gray-50 border border-gray-100 pl-3 pr-4 py-1.5 rounded-full shadow-xs hover:bg-gray-100 transition duration-150 focus:outline-none cursor-pointer">
                            <!-- Lingkaran Avatar Inisial Huruf Nama -->
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-red-600 text-white flex items-center justify-center font-bold text-xs sm:text-sm uppercase shadow-xs">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>

                            <!-- Info Nama Pengguna -->
                            <div class="hidden sm:block text-left max-w-[120px]">
                                <p class="text-xs font-bold text-gray-800 truncate leading-none mb-0.5">{{ Auth::user()->name }}</p>
                                <span class="text-[9px] font-semibold text-gray-400 uppercase tracking-wider block">Menu Akun</span>
                            </div>
                            <!-- Ikon Panah Kecil -->
                            <span class="material-icons text-gray-400 text-sm transition-transform duration-200" id="dropdown-arrow">expand_more</span>
                        </button>

                        <!-- KOTAK KARTU MENU MELAYANG (DROPDOWN CARD) -->
                        <!-- Sembunyikan secara default dengan class 'hidden' dan 'opacity-0' -->
                        <div id="dropdown-menu-card" class="hidden opacity-0 transform scale-95 transition-all duration-150 absolute right-0 mt-2 w-52 rounded-2xl bg-white border border-gray-100 shadow-xl py-2 z-50 origin-top-right">

                            <!-- Header Kecil Info Akun -->
                            <div class="px-4 py-2 border-b border-gray-50">
                                <p class="text-xs font-black text-gray-800 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-gray-400 font-mono truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>

                            <!-- Kumpulan Tautan Opsi Akun -->
                            <div class="p-1 space-y-0.5 text-xs font-bold text-gray-600">
                                <!-- Jika yang Login Admin: Sediakan Akses ke Dashboard -->
                                @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl hover:bg-red-50 hover:text-red-600 transition">
                                    <span class="material-icons text-base">dashboard</span> Dashboard Admin
                                </a>
                                @endif

                                <!-- Opsi 1: Riwayat Pesanan (Fitur Utama) -->
                                <a href="{{ route('pelanggan.riwayat') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl hover:bg-red-50 hover:text-red-600 transition">
                                    <span class="material-icons text-base">airplane_ticket</span> Riwayat Pesanan
                                </a>

                                <a href="{{ route('pelanggan.profil.edit') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl hover:bg-red-50 hover:text-red-600 transition">
                                    <span class="material-icons text-base">manage_accounts</span> Edit Profil
                                </a>

                                <!-- Opsi 3: Tombol Keluar (Logout) -->
                                <form method="POST" action="{{ route('logout') }}" class="block border-t border-gray-50 pt-1 mt-1">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center gap-2.5 px-3 py-2.5 rounded-xl hover:bg-red-50 text-gray-400 hover:text-red-600 transition font-bold cursor-pointer">
                                        <span class="material-icons text-base">logout</span> Keluar Akun
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- TAMPILAN JIKA PENGGUNA ADALAH TAMU (GUEST) -->
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-red-600 font-semibold text-xs sm:text-sm md:text-base px-3 py-2 rounded-xl transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2 rounded-full text-xs sm:text-sm md:text-base shadow-xs transform hover:scale-102 transition duration-150">
                        Daftar
                    </a>
                    @endauth
                </div>
            </header>


            <!-- KONTEN PELANGGAN -->
            <div class="w-full flex-1">

                @yield('content')

                <!-- /* --------------------------------- FOOTER --------------------------------- */ -->
                <footer class="bg-red-600 text-white font-sans">
                    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-10 items-start border-b border-red-500">
                        <div class="flex flex-col space-y-4 relative min-h-[180px]">
                            <h1 class="text-3xl font-extrabold tracking-wider uppercase z-20 relative">SM SPORT CENTER</h1>
                            <div class="absolute bottom-0 left-0 w-48 h-48 z-10 pointer-events-none opacity-15 overflow-hidden">
                                <i class="fas fa-volleyball text-white text-[12rem] leading-none"></i>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-4 group">
                            <h2 class="text-xl font-bold tracking-wide">Tentang Kami</h2>
                            <p class="text-red-100 text-sm leading-relaxed antialiased">
                                SM Sport Center adalah platform reservasi lapangan olahraga premium terbaik untuk bulu tangkis dan futsal, baik arena indoor maupun outdoor. Pesan slot jadwal Anda secara online dengan mudah, cepat, dan aman sebelum kehabisan.
                            </p>
                            <a href="{{ route('pelajari') }}" class="btn text-xs px-6 py-3 bg-white text-red-600 font-semibold rounded-lg shadow hover:bg-gray-200 ">
                                <div class="flex justify-between">
                                    <p>Pelajari cara reservasi</p>
                                    <i class="fa-solid fa-arrow-right-long transition-transform duration-300 group-hover:animate-[pingpongRight_0.8s_infinite]"></i>
                                </div>

                            </a>
                        </div>

                        <div class="flex flex-col space-y-4">
                            <h2 class="text-xl font-bold tracking-wide">Kontak Kami</h2>
                            <div class="space-y-2 text-sm text-red-100">
                                <div class="flex items-center gap-2 group cursor-pointer w-fit">
                                    <span class="material-icons text-lg transition-transform group-hover:scale-110">
                                        <h3 class="text-base">Email</h3>
                                    </span>
                                    <p class="hover:underline">support@sportcenter.com</p>
                                </div>
                                <div class="flex items-center gap-2 group cursor-pointer w-fit">
                                    <span class="material-icons text-lg transition-transform group-hover:scale-110">
                                        <h3 class="text-base">Telepon</h3>
                                    </span>
                                    <p class="hover:underline">+62 891 2345 6789</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 pt-2">
                                <!-- facebook -->
                                <a href="https://web.facebook.com/login/?locale=id_ID&_rdc=1&_rdr#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center text-white hover:text-red-600 hover:bg-white hover:border-white transform hover:scale-115 transition-all duration-150 ease-in-out">
                                    <i class="fab fa-facebook-f text-sm"></i>
                                </a>
                                <!-- twitter -->
                                <a href="https://x.com/?lang=id" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center text-white hover:text-red-600 hover:bg-white hover:border-white transform hover:scale-115 transition-all duration-150 ease-in-out">
                                    <i class="fab fa-twitter text-sm"></i>
                                </a>
                                <!-- instagram -->
                                <a href="https://www.instagram.com/" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center text-white hover:text-red-600 hover:bg-white hover:border-white transform hover:scale-115 transition-all duration-150 ease-in-out">
                                    <i class="fab fa-instagram text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>


        </main>
    </div>

    <!-- /* ------------------------------- JAVASCRIPT ------------------------------- */ -->
    <script>
        // fungsi untuk membuka sidebar (aside)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // otomasi dropdown untuk profil
        function toggleDropdownProfil() {
            const card = document.getElementById('dropdown-menu-card');
            const arrow = document.getElementById('dropdown-arrow');

            if (card.classList.contains('hidden')) {
                // Buka Dropdown dengan Efek Animasi
                card.classList.remove('hidden');
                setTimeout(() => {
                    card.classList.remove('opacity-0', 'scale-95');
                    card.classList.add('opacity-100', 'scale-100');
                }, 10);
                arrow.style.transform = 'rotate(180deg)';
            } else {
                // Tutup Dropdown
                card.classList.remove('opacity-100', 'scale-100');
                card.classList.add('opacity-0', 'scale-95');
                arrow.style.transform = 'rotate(0deg)';
                setTimeout(() => {
                    card.classList.add('hidden');
                }, 150); // Sesuai durasi transition-all 150ms
            }
        }

        // Fitur Pengaman UX: Menutup dropdown otomatis jika pengguna mengklik area luar profil
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('user-profile-dropdown');
            const card = document.getElementById('dropdown-menu-card');
            const arrow = document.getElementById('dropdown-arrow');

            if (dropdown && !dropdown.contains(e.target)) {
                if (card && !card.classList.contains('hidden')) {
                    card.classList.remove('opacity-100', 'scale-100');
                    card.classList.add('opacity-0', 'scale-95');
                    if (arrow) arrow.style.transform = 'rotate(0deg)';
                    setTimeout(() => {
                        card.classList.add('hidden');
                    }, 150);
                }
            }
        });
    </script>
</body>

</html>