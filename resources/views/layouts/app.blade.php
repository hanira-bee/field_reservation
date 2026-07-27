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

    @vite('resources/css/app.css')
</head>

<body class="bg-white min-h-screen">
    <div class="min-h-screen flex">
        <!-- /* ---------------------------------- ASIDE --------------------------------- */ -->
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

                <a href="{{ route('reservasi') }}" class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 rounded-2xl transition {{ request()->routeIs('reservasi') ? $activeClass : $normalClass }}">
                    <i class="fas fa-calendar-check text-sm sm:text-base w-5 sm:w-6 text-center"></i>
                    <span class="text-sm sm:text-base">
                        <h2>Reservasi</h2>
                    </span>
                </a>

                <a href="{{ route('kontak') }}" class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 rounded-2xl transition {{ request()->routeIs('kontak') ? $activeClass : $normalClass }}">
                    <i class="fas fa-envelope text-sm sm:text-base w-5 sm:w-6 text-center"></i>
                    <span class="text-sm sm:text-base">
                        <h2>Kontak Kami</h2>
                    </span>
                </a>
            </nav>
        </aside>

        <!-- /* --------------------------------- OVERLAY -------------------------------- */ -->
        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300 md:hidden"></div>

        <!-- /* ------------------------------- KONTEN HALAMAN ------------------------------- */ -->
        <main class="flex-1 flex flex-col min-h-screen overflow-y-auto relative z-10 w-full">
            <!-- /* --------------------------------- HEADER --------------------------------- */ -->
            <header class="w-full flex flex-wrap items-center justify-between gap-3 px-4 sm:px-8 py-2 sm:py-4 bg-white fixed top-0 z-30 shadow-sm">
                <!-- logo -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <button class="p-1.5 sm:p-2 text-red-600 hover:bg-gray-100 rounded-lg md:hidden" onclick="toggleSidebar()">
                        <i class="fas fa-bars text-base sm:text-lg"></i>
                    </button>
                    <a href="{{ route('home') }}">
                        <span class="font-stack font-extrabold text-red-800 text-xs sm:text-sm md:text-base lg:text-lg">SM SPORT CENTER</span>
                    </a>
                </div>

                <!-- /* --------------------------------- NAVBAR --------------------------------- */ -->
                <nav class="font-prompt hidden md:flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('home') }}" class="text-xs sm:text-sm md:text-base lg:text-lg {{ request()->routeIs('home') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Beranda</a>
                    <a href="{{ route('lapangan') }}" class="text-xs sm:text-sm md:text-base lg:text-lg {{ request()->routeIs('lapangan') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Lapangan</a>
                    <a href="{{ route('reservasi') }}" class="text-xs sm:text-sm md:text-base lg:text-lg {{ request()->routeIs('reservasi') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Reservasi</a>
                    <a href="{{ route('kontak') }}" class="text-xs sm:text-sm md:text-base lg:text-lg {{ request()->routeIs('kontak') ? 'text-red-600 font-semibold' : 'text-gray-600 hover:text-red-600' }}">Kontak Kami</a>
                </nav>

                <!-- login dan signup -->
                <div class="font-rubik flex items-center gap-2 sm:gap-3 ml-auto md:ml-0">
                    @auth
                        <span class="text-sm text-gray-700">Halo, {{ Auth::user()->name }}</span>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg:text-lg">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg:text-lg">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 sm:px-3 sm:py-2 rounded-lg text-xs sm:text-sm md:text-base">Daftar</a>
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

                        <div class="flex flex-col space-y-4">
                            <h2 class="text-xl font-bold tracking-wide">Tentang Kami</h2>
                            <p class="text-red-100 text-sm leading-relaxed antialiased">
                                SM Sport Center adalah platform reservasi lapangan olahraga premium terbaik untuk bulu tangkis dan futsal, baik arena indoor maupun outdoor. Pesan slot jadwal Anda secara online dengan mudah, cepat, dan aman sebelum kehabisan.
                            </p>
                            <a href="{{ route('reservasi') }}" class="inline-block w-fit text-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-md text-sm tracking-wide transform hover:scale-105 transition-all duration-105 ease-in-out shadow-md">
                                PESAN SEKARANG
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
                                    <p class="hover:underline">+62 812-3456-7890</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 pt-2">
                                <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center text-white hover:text-red-600 hover:bg-white hover:border-white transform hover:scale-115 transition-all duration-150 ease-in-out">
                                    <i class="fab fa-facebook-f text-sm"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center text-white hover:text-red-600 hover:bg-white hover:border-white transform hover:scale-115 transition-all duration-150 ease-in-out">
                                    <i class="fab fa-twitter text-sm"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center text-white hover:text-red-600 hover:bg-white hover:border-white transform hover:scale-115 transition-all duration-150 ease-in-out">
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
    </script>
</body>

</html>