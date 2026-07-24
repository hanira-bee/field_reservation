<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORT CENTER</title>

    <!-- link icon dan font -->
    <link rel="icon" type="image/png" href="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Stack+Sans+Notch:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    @vite('resources/css/app.css')
</head>

<body class="bg-white min-h-screen flex overflow-hidden">
    <!-- /* ---------------------------------- ASIDE --------------------------------- */ -->
    <aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-50 transition-transform duration-300 -translate-x-full">
        <div class="px-6 sm:px-8 pt-6 sm:pt-8 flex items-center gap-2 mb-8 sm:mb-10">
            <h1 class="text-lg sm:text-2xl font-bold text-red-600 tracking-wide">SM SPORT CENTER</h1>
        </div>

        @php
        $activeClass = 'bg-red-50 text-red-700 font-bold shadow-sm';
        $normalClass = 'text-gray-600 hover:bg-gray-100 font-semibold';
        @endphp

        <nav class="flex-1 px-3 sm:px-4 space-y-1 sm:space-y-2">
            <a href="{{ route('home') }}" class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 rounded-2xl transition {{ request()->routeIs('dashboard') ? $activeClass : $normalClass }}">
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
    <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300"></div>

    <!-- /* ----------------------------- KONTEN HALAMAN ----------------------------- */ -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto relative z-10 w-full">
        <!-- /* --------------------------------- HEADER --------------------------------- */ -->
        <header class="flex justify-between items-center px-4 sm:px-8 py-3 sm:py-4 bg-white sticky top-0 z-30">
            <!-- logo -->
            <div class="flex items-center gap-2 sm:gap-3">
                <button class="p-1.5 sm:p-2 text-red-600 hover:bg-gray-100 rounded-lg" onclick="toggleSidebar()">
                    <i class="fas fa-bars text-base sm:text-lg"></i>
                </button>
                <a href="{{ route('home') }}">
                    <span class="font-stack font-extrabold text-red-800 text-xs sm:text-sm md:text-base lg:text-lg">SM SPORT CENTER</span>
                </a>

            </div>
            <!-- navbar -->
            <nav class="font-prompt flex items-center gap-2 sm:gap-3">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg-text-lg">Beranda</a>
                <a href="#" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg-text-lg">Lapangan</a>
                <a href="#" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg-text-lg">Reservasi</a>
                <a href="#" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg-text-lg">Kontak Kami</a>
            </nav>
            <!-- login dan signup -->
            <div class="font-rubik flex items-center gap-2 sm:gap-3">
                <a href="#" class="text-gray-600 hover:text-red-600 text-xs sm:text-sm md:text-base lg-text-lg">Masuk</a>
                <a href="#" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 sm:px-3 sm:py-2 rounded-lg text-xs sm:text-sm md:text-base lg-text-lg">Daftar</a>
            </div>
        </header>

        <!-- /* --------------------------------- KONTEN --------------------------------- */ -->
        <div class="w-full">
            <section class="h-screen text-white text-center">
                <!-- banner -->
                <div class="absolute inset-0">
                    <!-- <img src="/images/banner-home1.jpg" alt="Sport Banner" class="w-full h-full min-h-full object-cover">
                    <div class="absolute inset-0 bg-black/40"></div> -->

                    <!-- Mengubah w-full h-full menjadi fixed untuk efek bg-fixed, dan -z-10 agar berada di paling bawah -->
                    <img src="/images/banner-home1.jpg" alt="Sport Banner" class="fixed inset-0 w-full h-full object-cover -z-10">

                    <!-- Lapisan Hitam Transparan (Overlay) juga diberi -z-10 agar berada di atas gambar tapi di bawah teks -->
                    <div class="fixed inset-0 bg-black/40 -z-10"></div>
                </div>

                <!-- isi konten -->
                <div class="relative z-10 flex flex-col items-center align-center justify-center text-center py-32 px-6">
                    <h1 class="text-5xl font-extrabold text-white drop-shadow-lg">
                        Pengalaman olahraga yang lebih baik
                    </h1>
                    <p class="mt-4 text-lg text-gray-200 max-w-xl">
                        Bangun kesehatan dan gaya hidupmu dengan fasilitas modern dan pengalaman terbaik.
                    </p>
                    <div class="mt-6 flex space-x-4 ">
                        <a href="#"
                            class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-800 transition">
                            <button>Mulai</button>
                        </a>
                        <a href="#"
                            class="px-6 py-3 bg-white text-red-600 font-semibold rounded-lg shadow hover:bg-gray-200 transition">
                            <button>Pelajari</button>
                        </a>
                    </div>
                </div>
            </section>

            <!-- /* -------------------------------- SERVICES -------------------------------- */ -->
            <section class="h-fit w-full bg-red-600 py-10">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-white">Layanan Kami</h2>
                    <p class="text-white text-lg mt-2">
                        Berbagai fasilitas untuk mendukung aktivitas olahraga Anda
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-8">
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                        <i class="fas fa-futbol text-red-600 text-3xl mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Lapangan Futsal</h3>
                        <p class="text-gray-600">Amankan slot waktu Anda dan rasakan atmosfer pertandingan futsal yang kompetitif bersama tim.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                        <i class="fas fa-table-tennis-paddle-ball text-red-600 text-3xl mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Lapangan Badminton</h3>
                        <p class="text-gray-600">Pesan lapangan bulu tangkis pilihan Anda sekarang dan jadwalkan pertandingan terbaik minggu ini.</p>
                    </div>
                </div>

                <div class="flex justify-center align-center p-10">
                    <a href="#" class="animate-bounce hover:animate-none px-6 py-3 bg-white text-lg text-red-600 font-semibold rounded-full shadow border-2 border-red-100 transform hover:scale-110 transition-all duration-150 ease-in-out">
                        <button>Reservasi</button>
                    </a>
                </div>
            </section>

            <!-- /* ---------------------------------- VENUE --------------------------------- */ -->
            <section class="bg-mauve-300 h-fit w-full mx-auto py-16">
                <div class="text-center mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight mb-3">Pilihan Venue Terbaik Kami</h2>
                    <p class="text-md text-gray-500 font-normal max-w-xl mx-auto">
                        Temukan dan pesan lapangan premium standar turnamen yang siap mendukung performa olahraga terbaik Anda.
                    </p>
                </div>

                <!-- Daftar Lapangan -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-10">
                    <!-- Lapangan futsal outdoor-->
                    <a href="#" class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-xs hover:shadow-xl transform hover:-translate-y-1 hover:scale-103 transition-all duration-300 ease-in-out flex flex-col">
                        <div class="relative overflow-hidden aspect-video">
                            <img src="/images/futsal_outdoor.jpg" alt="Lapangan Futsal Outdoor" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                                <h2>Futsal</h2>
                            </span>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors">
                                Lapangan Futsal Outdoor
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                                Lapangan futsal dengan rumput sintetis, berada di ruang terbuka dengan jaring pembatas dan lampu sorot agar mendukung pencahayaan yang baik ketika permainan dimulai.
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                                <span class="text-sm font-semibold text-emerald-600">
                                    <h3>Rp 130.000 / Jam</h3>
                                </span>
                                <span class="text-md font-bold text-red-600 flex items-center gap-1">Detail <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span></span>
                            </div>
                        </div>
                    </a>

                    <!-- Lapangan futsal indoor-->
                    <a href="#" class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-xs hover:shadow-xl transform hover:-translate-y-1 hover:scale-103 transition-all duration-300 ease-in-out flex flex-col">
                        <div class="relative overflow-hidden aspect-video">
                            <img src="/images/futsal_indoor.jpg" alt="Lapangan Futsal Indoor" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                                <h2>Futsal</h2>
                            </span>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors">
                                Lapangan Futsal Indoor
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                                Rumput sintetis yang empuk, meminimalisir risiko cedera. Berada di dalam ruang, cocok untuk latihan atau turnamen di cuaca tidak menentu. Pencahayaan dari lampu gantung dan sorot membuat pengalaman bermain akan jauh lebih baik.
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                                <span class="text-sm font-semibold text-emerald-600">
                                    <h3>Rp 150.000 / Jam</h3>
                                </span>
                                <span class="text-md font-bold text-red-600 flex items-center gap-1">Detail <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span></span>
                            </div>
                        </div>
                    </a>

                    <!-- Lapangan badminton outdoor -->
                    <a href="#" class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-xs hover:shadow-xl transform hover:-translate-y-1 hover:scale-103 transition-all duration-300 ease-in-out flex flex-col">
                        <div class="relative overflow-hidden aspect-video">
                            <img src="/images/badminton_outdoor1.jpg" alt="Lapangan Badminton Outdoor" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                                <h2>Badminton</h2>
                            </span>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors">
                                Lapangan Badminton Outdoor
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                                Fasilitas lapangan dengan area terbuka yang nyaman, pagar jaring yang mengelilingi lapangan dengan lantai semen untuk membuat gerakan semakin lincah dan gesit.
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                                <span class="text-sm font-semibold text-emerald-600">
                                    <h3>Rp 60.000 / Jam</h3>
                                </span>
                                <span class="text-md font-bold text-red-600 flex items-center gap-1">Detail <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span></span>
                            </div>
                        </div>
                    </a>

                    <!-- Lapangan badminton Indoor -->
                    <a href="#" class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-xs hover:shadow-xl transform hover:-translate-y-1 hover:scale-103 transition-all duration-300 ease-in-out flex flex-col">
                        <div class="relative overflow-hidden aspect-video">
                            <img src="/images/badminton_indoor.jpg" alt="Lapangan Badminton Indoor 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                                <h2>Badminton</h2>
                            </span>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors">
                                Lapangan Badminton Indoor 1
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                                Lantai karpet sintetis yang empuk dan lampu sorot dengan pencayaan yang baik sebagai tempat yang nyaman untuk berbagi pengalaman bermain badminton bersama tanpa perlu merasa takut akan risiko cedera.
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                                <span class="text-sm font-semibold text-emerald-600">
                                    <h3>Rp 50.000 / Jam</h3>
                                </span>
                                <span class="text-md font-bold text-red-600 flex items-center gap-1">Detail <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span></span>
                            </div>
                        </div>
                    </a>

                    <!-- Lapangan badminton Indoor 1-->
                    <a href="#" class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-xs hover:shadow-xl transform hover:-translate-y-1 hover:scale-103 transition-all duration-300 ease-in-out flex flex-col">
                        <div class="relative overflow-hidden aspect-video">
                            <img src="/images/badminton_indoor1.jpg" alt="Lapangan Badminton Indoor 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                                <h2>Badminton</h2>
                            </span>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors">
                                Lapangan Badminton Indoor 2
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                                Lapangan indoor dengan permukaan lantai polos yang akan memberikan kebebasan bergerak serta kelincahan kaki anda. Dilengkapi area tempat duduk santai untuk beristirahat di tepi lapangan bersama teman anda.
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                                <span class="text-sm font-semibold text-emerald-600">
                                    <h3>Rp 55.000 / Jam</h3>
                                </span>
                                <span class="text-md font-bold text-red-600 flex items-center gap-1">Detail <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span></span>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
            <!-- /* --------------------------------- FOOTER --------------------------------- */ -->
            <footer class="bg-red-600 text-white font-sans">
                <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-10 items-start border-b border-red-500">
                    <div class="flex flex-col space-y-4">
                        <h1 class="text-3xl font-extrabold tracking-wider uppercase">SM SPORT CENTER</h1>
                        <!-- <a href="#" class="inline-block w-fit text-center border-2 border-white hover:border-white bg-blur hover:bg-white text-white hover:text-red-600 font-semibold px-5 py-2.5 rounded-md text-sm trackin-wide transform hover:scale-105 transition-all duration-150 ease-in-out">
                            <h3>TENTANG KAMI</h3>
                        </a> -->
                    </div>

                    <div class="flex flex-col space-y-4">
                        <h2 class="text-xl font-bold tracking-wide">Tentang Kami</h2>
                        <p class="text-red-100 text-sm leading-relaxed antialiased">
                            SM Sport Center adalah platform reservasi lapangan olahraga premium terbaik untuk bulu tangkis dan futsal, baik arena indoor maupun outdoor. Pesan slot jadwal Anda secara online dengan mudah, cepat, dan aman sebelum kehabisan.
                        </p>
                        <a href="#" class="inline-block w-fit text-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-md text-sm tracking-wide transform hover:scale-105 transition-all duration-105 ease-in-out shadow-md">
                            <button>PESAN SEKARANG</button>
                        </a>
                    </div>

                    <div class="flex flex-col space-y-4">
                        <h2 class="text-xl font-bold tracking-wide">Kontak Kami</h2>

                        <!-- Info Email & Telepon -->
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

                        <!-- Ikon Sosial Media Interaktif (Zoom In + Berubah Warna) -->
                        <div class="flex items-center gap-3 pt-2">
                            <!-- Facebook -->
                            <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center text-white hover:text-red-600 hover:bg-white hover:border-white transform hover:scale-115 transition-all duration-150 ease-in-out">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <!-- Twitter/X -->
                            <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center text-white hover:text-red-600 hover:bg-white hover:border-white transform hover:scale-115 transition-all duration-150 ease-in-out">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <!-- Instagram -->
                            <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center text-white hover:text-red-600 hover:bg-white hover:border-white transform hover:scale-115 transition-all duration-150 ease-in-out">
                                <i class="fab fa-instagram text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!-- /* ------------------------------- JAVASCRIPT ------------------------------- */ -->
    <script>
        // fungsi untuk membuka sidebar (aside)
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>

</html>