@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
<section class="relative bg-red-700 text-white py-24 px-6 sm:px-12 overflow-hidden">
    <!-- Dekorasi Latar Belakang Geometris Ringan -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1.5px)] [background-size:16px_16px]"></div>

    <div class="max-w-7xl mx-auto relative z-10 text-center sm:text-left">
        <!-- Judul Utama -->
        <h1 class="font-prompt text-3xl sm:text-5xl font-black uppercase tracking-tight mb-3">
            Tentang Kami
        </h1>
        <!-- Breadcrumb Navigasi -->
        <div class="font-roboto flex items-center justify-center sm:justify-start gap-2 text-xs sm:text-sm text-red-100 font-medium">
            <a href="{{ route('home') }}" class="hover:underline hover:text-white transition">Beranda</a>
            <i class="fa-solid fa-angle-right text-white text-[10px]"></i>
            <span class="text-white font-bold">Tentang Kami</span>
        </div>
    </div>
</section>

<!-- CONTAINER UTAMA UNTUK KONTEN DI BAWAH BANNER -->
<div class="bg-white min-h-screen py-16 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto space-y-24">
        <!-- SEKTOR TWO-COLUMN: VISI MISI & DATA DUMMY FOTO -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Kolom Teks Kiri -->
            <div class="space-y-6">
                <span class="text-xs font-bold text-red-600 uppercase tracking-widest block">Providing Premium Arena</span>
                <h2 class="font-prompt text-2xl sm:text-4xl font-black text-gray-900 leading-tight">
                    Menyediakan Fasilitas Ragam Olahraga Terlengkap
                </h2>
                <p class="font-roboto text-gray-600 text-sm sm:text-base leading-relaxed text-justify">
                    SM Sport Center berkomitmen penuh untuk menghadirkan pengalaman berolahraga terbaik di arena premium berstandar turnamen nasional. Kami percaya bahwa kebugaran tubuh dan kebahagiaan komunitas berawal dari fasilitas lapangan yang aman, nyaman, dan mudah diakses oleh siapa saja.
                </p>
                <p class="font-roboto text-gray-500 text-sm leading-relaxed text-justify">
                    Dengan sistem pemesanan online, Anda tidak perlu lagi khawatir akan bentrok jadwal atau kehabisan slot sesi bermain bersama tim kebanggaan Anda.
                </p>

                <div class="pt-2">
                    <a href="{{ route('lapangan') }}" class="font-rubik group inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-xl text-sm tracking-wide shadow transition transform hover:scale-102">
                        <span>Pesan Lapangan</span>
                        <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Kolom Foto Kanan Bertumpuk (Efek Kreatif seperti Gambar) -->
            <div class="relative px-4">
                <!-- Bingkai Foto Utama -->
                <div class="w-full aspect-[4/3] rounded-2xl overflow-hidden shadow-md">
                    <img src="{{ asset('images/futsal_indoor.jpg') }}" alt="Main Arena" class="w-full h-full object-cover">
                </div>
                <!-- Kotak Badge Mengambang "20+" Versi Sport Center -->
                <div class="absolute -bottom-6 left-10 bg-white border border-gray-100 rounded-2xl shadow-xl p-4 sm:p-5 flex flex-col justify-center items-center text-center max-w-[150px] border-t-4 border-t-red-600">
                    <span class="font-prompt text-2xl sm:text-3xl font-black text-red-600 leading-none">5+</span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide mt-1">Pilihan Lapangan Premium</span>
                </div>
                <!-- Mini Gambar Pendukung -->
                <div class="absolute -right-4 -bottom-10 w-1/2 aspect-video rounded-xl overflow-hidden shadow-lg border-4 border-white hidden sm:block">
                    <img src="{{ asset('images/badminton_indoor.jpg') }}" alt="Sub Arena" class="w-full h-full object-cover">
                </div>
            </div>

        </div>

        <!-- GRID 3 KEUNGGULAN (FITUR KOMPETENSI) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-8">
            <!-- Poin 1 -->
            <div class="bg-gray-50/60 p-6 rounded-2xl border border-gray-100/60 hover:shadow-md transition">
                <span class="material-icons text-red-600 text-3xl mb-3">workspace_premium</span>
                <h4 class="font-prompt text-base font-bold text-gray-900 mb-2">Standar Turnamen Resmi</h4>
                <p class="font-roboto text-gray-500 text-xs sm:text-sm leading-relaxed">
                    Setiap jaring, lantai interlock, hingga karpet vinyl bulu tangkis dirawat berkala demi performa pergerakan maksimal.
                </p>
            </div>
            <!-- Poin 2 -->
            <div class="bg-gray-50/60 p-6 rounded-2xl border border-gray-100/60 hover:shadow-md transition">
                <span class="material-icons text-red-600 text-3xl mb-3">schedule</span>
                <h4 class="font-prompt text-base font-bold text-gray-900 mb-2">Akurasi Jadwal Real-Time</h4>
                <p class="font-roboto text-gray-500 text-xs sm:text-sm leading-relaxed">
                    Sistem kalender terintegrasi yang memastikan tidak ada jadwal bentrok atau manipulasi waktu antar penyewa.
                </p>
            </div>
            <!-- Poin 3 -->
            <div class="bg-gray-50/60 p-6 rounded-2xl border border-gray-100/60 hover:shadow-md transition">
                <span class="material-icons text-red-600 text-3xl mb-3">sentiment_very_satisfied</span>
                <h4 class="font-prompt text-base font-bold text-gray-900 mb-2">Kemudahan & Kenyamanan</h4>
                <p class="font-roboto text-gray-500 text-xs sm:text-sm leading-relaxed">
                    Fasilitas ruang ganti bersih, toilet steril, pencahayaan lateral anti-silau, dan area parkir kendaraan yang aman.
                </p>
            </div>
        </div>
        <!-- BANNER KOMPETENSI SEKTOR TENGAH (Background Abu-abu Lembut) -->
        <div class="bg-gray-50 rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-xs grid grid-cols-1 lg:grid-cols-5 gap-8 items-center">

            <!-- Ilustrasi Foto Kiri (Memakan 2 Kolom) -->
            <div class="lg:col-span-2 rounded-2xl overflow-hidden aspect-video lg:aspect-square shadow-sm">
                <img src="{{ asset('images/futsal_outdoor.jpg') }}" alt="Our Arena Quality" class="w-full h-full object-cover">
            </div>

            <!-- Detail List Kelebihan Kanan (Memakan 3 Kolom) -->
            <div class="lg:col-span-3 space-y-4">
                <h3 class="font-prompt text-2xl font-black text-gray-900 uppercase tracking-tight">
                    Komitmen Layanan Operasional Kami
                </h3>
                <p class="font-roboto text-gray-600 text-sm leading-relaxed">
                    Kami selalu memastikan manajemen internal berjalan dengan profesional demi memberikan transparansi dan keamanan tinggi dalam setiap transaksi sewa lapangan olahraga Anda.
                </p>

                <!-- Daftar Ceklis Fitur Keunggulan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs sm:text-sm font-bold text-gray-700">
                    <div class="flex items-center gap-2">
                        <span class="material-icons text-red-600 text-base">check_circle</span> Konfirmasi Pembayaran 
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-icons text-red-600 text-base">check_circle</span> Sistem Pembatalan Fleksibel
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-icons text-red-600 text-base">check_circle</span> Pengawasan Kebersihan Berkala
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-icons text-red-600 text-base">check_circle</span> Customer Support Responsif
                    </div>
                </div>
            </div>

        </div>

        <!-- GRID DAFTAR TIM STAF MANAJEMEN / MANAGEMENT TEAM -->
        <div class="space-y-10 pt-4">
            <!-- Judul Sektor Tim -->
            <div class="text-center max-w-xl mx-auto space-y-2">
                <h3 class="font-prompt text-2xl sm:text-3xl font-black text-gray-900 uppercase tracking-tight">
                    Our Management Team
                </h3>
                <p class="font-roboto text-xs sm:text-sm text-gray-400">
                    Staf pengurus profesional SM Sport Center yang siap melayani dan menjaga kenyamanan bermain Anda setiap hari.
                </p>
            </div>

            <!-- Grid Foto Anggota Tim dengan Efek Berputar 3D -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- ANGGOTA 1: Operational Manager -->
                <div class="group h-[320px] perspective-1000 cursor-pointer">
                    <div class="relative w-full h-full text-center transition-transform duration-500 transform-style-3d group-hover:rotate-y-180">

                        <!-- SISI DEPAN (Foto & Nama) -->
                        <div class="absolute inset-0 w-full h-full backface-hidden rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden flex flex-col">
                            <div class="w-full aspect-square overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/team_manager.jpg') }}" alt="Verno Akhdan" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4 bg-gray-900 text-white flex-grow flex flex-col justify-center items-start text-left">
                                <h4 class="font-prompt text-sm sm:text-base font-bold tracking-wide">Verno Akhdan</h4>
                                <p class="text-[11px] text-red-400 font-medium mt-0.5">Operational Manager</p>
                            </div>
                        </div>

                        <!-- SISI BELAKANG (Deskripsi Pekerjaan) -->
                        <div class="absolute inset-0 w-full h-full backface-hidden rotate-y-180 rounded-2xl bg-gray-900 border border-gray-800 text-white p-6 flex flex-col justify-center items-center shadow-md">
                            <span class="material-icons text-red-500 text-3xl mb-2">manage_accounts</span>
                            <h4 class="font-prompt text-sm font-bold text-red-400">Job Description</h4>
                            <p class="font-roboto text-xs text-gray-300 text-center leading-relaxed mt-2">
                                Bertanggung jawab penuh atas kelancaran operasional harian arena, manajemen staf, kontrol kualitas fasilitas, serta mengawasi validitas sistem integrasi transaksi reservasi.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- ANGGOTA 2: Event Organizer -->
                <div class="group h-[320px] perspective-1000 cursor-pointer">
                    <div class="relative w-full h-full text-center transition-transform duration-500 transform-style-3d group-hover:rotate-y-180">

                        <!-- SISI DEPAN -->
                        <div class="absolute inset-0 w-full h-full backface-hidden rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden flex flex-col">
                            <div class="w-full aspect-square overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/team_event_organizer.jpg') }}" alt="Hyuda Santoso" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4 bg-gray-900 text-white flex-grow flex flex-col justify-center items-start text-left">
                                <h4 class="font-prompt text-sm sm:text-base font-bold tracking-wide">Hyuda Santoso</h4>
                                <p class="text-[11px] text-red-400 font-medium mt-0.5">Event Organizer</p>
                            </div>
                        </div>

                        <!-- SISI BELAKANG -->
                        <div class="absolute inset-0 w-full h-full backface-hidden rotate-y-180 rounded-2xl bg-gray-900 border border-gray-800 text-white p-6 flex flex-col justify-center items-center shadow-md">
                            <span class="material-icons text-red-500 text-3xl mb-2">emoji_events</span>
                            <h4 class="font-prompt text-sm font-bold text-red-400">Job Description</h4>
                            <p class="font-roboto text-xs text-gray-300 text-center leading-relaxed mt-2">
                                Menyusun, merencanakan, dan mengeksekusi kegiatan turnamen bulu tangkis maupun futsal komunitas, serta mengelola kerja sama sponsor untuk meramaikan event di Sport Center.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- ANGGOTA 3: Customer Service -->
                <div class="group h-[320px] perspective-1000 cursor-pointer">
                    <div class="relative w-full h-full text-center transition-transform duration-500 transform-style-3d group-hover:rotate-y-180">

                        <!-- SISI DEPAN -->
                        <div class="absolute inset-0 w-full h-full backface-hidden rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden flex flex-col">
                            <div class="w-full aspect-square overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/team_customer_service.jpg') }}" alt="Budi Pratama" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4 bg-gray-900 text-white flex-grow flex flex-col justify-center items-start text-left">
                                <h4 class="font-prompt text-sm sm:text-base font-bold tracking-wide">Budi Pratama</h4>
                                <p class="text-[11px] text-red-400 font-medium mt-0.5">Customer Service</p>
                            </div>
                        </div>

                        <!-- SISI BELAKANG -->
                        <div class="absolute inset-0 w-full h-full backface-hidden rotate-y-180 rounded-2xl bg-gray-900 border border-gray-800 text-white p-6 flex flex-col justify-center items-center shadow-md">
                            <span class="material-icons text-red-500 text-3xl mb-2">support_agent</span>
                            <h4 class="font-prompt text-sm font-bold text-red-400">Job Description</h4>
                            <p class="font-roboto text-xs text-gray-300 text-center leading-relaxed mt-2">
                                Melayani keluhan, membantu kendala teknis pembuatan akun pelanggan, mengonfirmasi pengajuan verifikasi pembatalan, serta menyambut tim olahraga yang datang ke meja resepsionis.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- ANGGOTA 4: Maintenance Team -->
                <div class="group h-[320px] perspective-1000 cursor-pointer">
                    <div class="relative w-full h-full text-center transition-transform duration-500 transform-style-3d group-hover:rotate-y-180">

                        <!-- SISI DEPAN -->
                        <div class="absolute inset-0 w-full h-full backface-hidden rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden flex flex-col">
                            <div class="w-full aspect-square overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/team_cleanmain.png') }}" alt="Janitor" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4 bg-gray-900 text-white flex-grow flex flex-col justify-center items-start text-left">
                                <h4 class="font-prompt text-sm sm:text-base font-bold tracking-wide">Janitor & Technical Staff</h4>
                                <p class="text-[11px] text-red-400 font-medium mt-0.5">Cleaning & Maintenance Team</p>
                            </div>
                        </div>

                        <!-- SISI BELAKANG -->
                        <div class="absolute inset-0 w-full h-full backface-hidden rotate-y-180 rounded-2xl bg-gray-900 border border-gray-800 text-white p-6 flex flex-col justify-center items-center shadow-md">
                            <span class="material-icons text-red-500 text-3xl mb-2">cleaning_services</span>
                            <h4 class="font-prompt text-sm font-bold text-red-400">Job Description</h4>
                            <p class="font-roboto text-xs text-gray-300 text-center leading-relaxed mt-2">
                                Menjaga kebersihan total seluruh area lapangan, memastikan toilet steril, membersihkan debu lantai / rumput sehabis sesi tanding, serta pemeliharaan fasilitas lapangan agar tetap prima.
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div> <!-- Penutup Max-w-7xl Inner -->
</div> <!-- Penutup Konten Putih Belakang Banner -->

@endsection