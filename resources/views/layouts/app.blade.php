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

    @vite('resources/css/app.css')
</head>

<body class="bg-mauve-900 min-h-screen flex overflow-hidden">
    <!-- /* ----------------------------- KONTEN HALAMAN ----------------------------- */ -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto relative z-10 w-full">
        <!-- /* --------------------------------- HEADER --------------------------------- */ -->
        <header class="flex justify-between items-center px-4 sm:px-8 py-3 sm:py-4 bg-white sticky top-0 z-30">
            <!-- logo -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- <button class="p-1.5 sm:p-2 text-red-600 hover:bg-gray-100 rounded-lg" onclick="">
                    <i class="fas fa-bars text-base sm:text-lg"></i>
                </button> -->
                <a href="#">
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
        <div class="max-w-6xl mx-auto w-full p-4 sm:p-6 md:p-8 space-y-6 sm:space-y-10 pb-20">
            <section class="">
                <div class="absolute inset-0">
                    <img src="/images/banner-home1.jpg" alt="Sport Banner" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40"></div>
                </div>

                <!-- isi konten -->
                <div class="relative z-10 flex flex-col items-center justify-center text-center py-32 px-6">
                    <h1 class="text-5xl font-extrabold text-white drop-shadow-lg">
                        Pengalaman olahraga yang lebih baik
                    </h1>
                    <p class="mt-4 text-lg text-gray-200 max-w-xl">
                        Bangun kesehatan dan gaya hidupmu dengan fasilitas modern dan pengalaman yang baik.
                    </p>
                    <div class="mt-6 flex space-x-4 ">
                        <a href="#"
                            class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-800 transition">
                            Mulai
                        </a>
                        <a href="#"
                            class="px-6 py-3 bg-white text-red-600 font-semibold rounded-lg shadow hover:bg-gray-200 transition">
                            Pelajari
                        </a>
                    </div>
                </div>

                <!-- Decorative Shape -->
                <div class="absolute bottom-0 left-0 right-0 h-28 bg-red-600 clip-path-polygon"></div>
            </section>


        </div>


    </main>



</body>

</html>