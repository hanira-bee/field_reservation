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
                    <span class="text-sm sm:text-base"><h2>Beranda</h2></span>
                </a>

                <a href="#" class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 rounded-2xl transition {{ request()->routeIs('lapangan.*') ? $activeClass : $normalClass }}">
                    <i class="fas fa-table-cells text-sm sm:text-base w-5 sm:w-6 text-center"></i>
                    <span class="text-sm sm:text-base"><h2>Lapangan</h2></span>
                </a>

                <a href="#" class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 rounded-2xl transition {{ request()->routeIs('reservasi.*') ? $activeClass : $normalClass }}">
                    <i class="fas fa-calendar-check text-sm sm:text-base w-5 sm:w-6 text-center"></i>
                    <span class="text-sm sm:text-base"><h2>Reservasi</h2></span>
                </a>

                <a href="#" class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 rounded-2xl transition {{ request()->routeIs('kontak.*') ? $activeClass : $normalClass }}">
                    <i class="fas fa-envelope text-sm sm:text-base w-5 sm:w-6 text-center"></i>
                    <span class="text-sm sm:text-base"><h2>Kontak Kami</h2></span>
                </a>
            </nav>
        </aside>

        <!-- /* --------------------------------- OVERLAY -------------------------------- */ -->
        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300 md:hidden"></div>

        <!-- /* ------------------------------- KONTEN HALAMAN ------------------------------- */ -->
        <main class="flex-1 flex flex-col min-h-screen overflow-y-auto relative z-10 w-full">
            <!-- /* --------------------------------- HEADER --------------------------------- */ -->
            <header class="flex flex-wrap items-center justify-between gap-3 px-4 sm:px-8 py-2 bg-white sticky top-0 z-30 shadow-sm">
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
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg:text-lg">Beranda</a>
                    <a href="#" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg:text-lg">Lapangan</a>
                    <a href="#" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg:text-lg">Reservasi</a>
                    <a href="#" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg:text-lg">Kontak Kami</a>
                </nav>

                <!-- login dan signup -->
                <div class="font-rubik flex items-center gap-2 sm:gap-3 ml-auto md:ml-0">
                    <a href="#" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg:text-lg">Masuk</a>
                    <a href="#" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 sm:px-3 sm:py-2 rounded-lg text-xs sm:text-sm md:text-base lg:text-lg">Daftar</a>
                </div>
            </header>

            <!-- KONTEN PELANGGAN -->
            <div class="w-full flex-1">
                @yield('content')
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