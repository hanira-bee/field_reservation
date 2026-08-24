@extends('layouts.app')
@section('title', 'Pelajari')

@push('head')
<style>
    @media (min-width: 1024px) {
        .step-grid-item::after {
            content: '';
            position: absolute;
            top: 2rem;
            left: 50%;
            width: 100%;
            height: 2px;
            background: #1c304a;
            z-index: 0;
        }

        .step-grid-item:nth-child(5)::after,
        .step-grid-item:nth-child(9)::after {
            /* width: 100%; */
            display: none;
        }

        .step-grid-item:last-child::after {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<!-- navigasi -->
<section class="relative py-4 px-5 sm:px-12 overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10 text-center sm:text-left">
        <!-- breadcrumb navigasi -->
        <div class="font-roboto flex items-center justify-center sm:justify-start gap-2 text-xs sm:text-sm text-red-180 font-medium">
            <a href="{{ route('home') }}" class="text-red-700 hover:underline hover:text-red-900 transition">Beranda</a>
            <i class="fa solid fa-angle-right text-red-700 text-[10px]"></i>
            <span class="text-red-700 font-bold">Petunjuk Penggunaan</span>
        </div>
    </div>
</section>

<!-- panduan cara reservasi -->
<section class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto flex flex-col justify-center">
    <!-- Judul Header Utama -->
    <div class="text-center mb-16">
        <span class="text-xs font-bold uppercase tracking-widest text-red-600 bg-red-50 px-3 py-1.5 rounded-full">Petunjuk Penggunaan</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-3 tracking-tight">Cara Melakukan Reservasi</h2>
        <p class="text-slate-500 mt-2 text-base sm:text-lg max-w-2xl mx-auto">Sentuh atau arahkan kursor pada judul langkah untuk melihat detail instruksi lengkap.</p>
    </div>

    <!-- Container Grid Utama (Sistem Grid Responsif) -->
    <div class="relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-8 lg:gap-y-16 pl-8 sm:pl-0">

        <!-- Garis Alur Vertikal khusus Tampilan HP di Samping Kiri -->
        <div class="absolute left-0 top-2 bottom-2 w-0.5 bg-slate-200 sm:hidden z-0"></div>

        <!-- Langkah 1 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-white text-red-600 shadow-md border border-slate-100 font-extrabold text-xl group-hover:bg-red-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-red-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                01
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-red-600 transition-colors">Registrasi/Login Akun</h3>
                <!-- Box Kecil Hover (Tooltip Deskripsi) -->
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-slate-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                    Pastikan Anda sudah memiliki akun dan melakukan login sebelum memulai proses reservasi.
                </div>
            </div>
        </div>

        <!-- Langkah 2 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-white text-red-600 shadow-md border border-slate-100 font-extrabold text-xl group-hover:bg-red-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-red-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                02
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-red-600 transition-colors">Buka Menu “Lapangan”</h3>
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-slate-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                    Pilih lapangan mana yang ingin digunakan, pastikan lokasi dan jenis lapangan sesuai dengan keinginan anda.
                </div>
            </div>
        </div>

        <!-- Langkah 3 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-white text-red-600 shadow-md border border-slate-100 font-extrabold text-xl group-hover:bg-red-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-red-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                03
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-red-600 transition-colors">Pilih Durasi Sesi</h3>
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-slate-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                    Tentukan lama sesi anda bertanding (1 jam/2 jam).
                </div>
            </div>
        </div>

        <!-- Langkah 4 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-white text-red-600 shadow-md border border-slate-100 font-extrabold text-xl group-hover:bg-red-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-red-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                04
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-red-600 transition-colors">Cek Ketersediaan Jadwal</h3>
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-slate-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                    Pastikan tanggal dan jam yang dipilih masih tersedia pada kalender pada detail lapangan (ditandai dengan warna hijau).
                </div>
            </div>
        </div>
        <!-- Langkah 5 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-white text-red-600 shadow-md border border-slate-100 font-extrabold text-xl group-hover:bg-red-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-red-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                05
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-red-600 transition-colors">Pilih Jam Reservasi</h3>
                <!-- Box Kecil Hover (Tooltip Deskripsi) -->
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-slate-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                    Klik pada waktu yang sesuai.
                </div>
            </div>
        </div>

        <!-- Langkah 6 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-white text-red-600 shadow-md border border-slate-100 font-extrabold text-xl group-hover:bg-red-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-red-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                06
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-red-600 transition-colors">Lakukan Pembayaran</h3>
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-slate-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                    Transfer biaya sewa ke rekening bank yang tertera.
                </div>
            </div>
        </div>

        <!-- Langkah 7 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-white text-red-600 shadow-md border border-slate-100 font-extrabold text-xl group-hover:bg-red-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-red-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                07
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-red-600 transition-colors">Konfirmasi Reservasi</h3>
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-slate-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                    Lengkapi permohonan reservasi melalui sistem.
                </div>
            </div>
        </div>

        <!-- Langkah 8 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-white text-red-600 shadow-md border border-slate-100 font-extrabold text-xl group-hover:bg-red-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-red-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                08
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-red-600 transition-colors">Unggah Bukti Pembayaran</h3>
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-slate-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                    Upload struk pembayaran dengan gambar yang jelas.
                </div>
            </div>
        </div>
        <!-- Langkah 9 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-white text-red-600 shadow-md border border-slate-100 font-extrabold text-xl group-hover:bg-red-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-red-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                09
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-red-600 transition-colors">Verifikasi oleh Admin</h3>
                <!-- Box Kecil Hover (Tooltip Deskripsi) -->
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-slate-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                    Admin akan memeriksa keaslian transaksi untuk mencegah penipuan.
                </div>
            </div>
        </div>

        <!-- Langkah 10 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-white text-red-600 shadow-md border border-slate-100 font-extrabold text-xl group-hover:bg-red-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-red-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                10
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-red-600 transition-colors">Tunggu Status Reservasi</h3>
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-slate-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                    Status akan berubah dari “Sesi Batal” menjadi “Siap Tanding” setelah pembayaran diverifikasi.
                </div>
            </div>
        </div>

        <!-- Langkah 11 -->
        <div class="step-grid-item relative flex flex-col items-start sm:items-center group">
            <div class="absolute -left-8 top-4 w-4 h-0.5 bg-slate-200 sm:hidden"></div>
            <!-- Menggunakan warna aksen hijau khusus untuk menandakan langkah sukses/akhir -->
            <div class="w-16 h-16 flex items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 shadow-md border border-emerald-100 font-extrabold text-xl group-hover:bg-emerald-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-emerald-200 group-hover:-translate-y-1 transition-all duration-300 z-10">
                11
            </div>
            <div class="relative mt-4 w-full sm:text-center">
                <h3 class="font-bold text-slate-900 text-lg cursor-pointer group-hover:text-emerald-600 transition-colors">Lapangan Siap Digunakan</h3>
                <div class="opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 absolute left-0 sm:left-1/2 sm:-translate-x-1/2 top-full mt-2 w-64 bg-emerald-900 text-white text-xs rounded-xl p-3 shadow-xl z-30 group-hover:z-50">
                    <div class="absolute -top-1 sm:left-1/2 left-4 sm:-translate-x-1/2 w-2 h-2 bg-emerald-900 rotate-45"></div>
                    Jika status sudah “Siap Tanding”, lapangan dapat digunakan sesuai jadwal yang dipilih.
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-slate-50 min-h-screen py-16 px-4 sm:px-6 lg:px-8 flex items-center">
    <div class="max-w-7xl w-full grid grid-cols-1 lg:grid-cols-5 bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <!-- kolom kiri -->
        <div class="lg:col-span-3 p-6 sm:p-10 lg:p-12 flex flex-col justify-between">
            <!-- title -->
            <div class="mb-8">
                <span class="text-xs font-bold uppercase tracking-widest text-red-600 px-3 py-1.5 rounded-full"><i class="fa-solid fa-circle-dot"></i> Aturan Sport Center</span>
                <h3 class="text-sm sm:text-base font-medium text-slate-500 mt-3 justify-self-center">
                    Hal yang perlu diperhatikan
                </h3>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-1 justify-self-center">
                    Saat Bertanding
                </h2>
            </div>

            <!-- daftar aturan -->
            <div class="space-y-4">
                <li class="flex items-start gap-4 p-3.5 border-b-2 border-red-300">
                    <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-600 text-white font-bold flex items-center justify-center text-sm">1</span>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed pt-0.5">Datang tepat waktu, minimal 10 menit sebelum sesi dimulai.</p>
                </li>
                <li class="flex items-start gap-4 p-3.5 border-b-2 border-red-300">
                    <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-600 text-white font-bold flex items-center justify-center text-sm">2</span>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed pt-0.5">Gunakan pakaian olahraga yang sesuai, sopan, dan aman untuk mencegah cedera.</p>
                </li>
                <li class="flex items-start gap-4 p-3.5 border-b-2 border-red-300">
                    <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-600 text-white font-bold flex items-center justify-center text-sm">3</span>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed pt-0.5">Jaga ketenangan, hindari berisik yang dapat mengganggu pengguna lain.</p>
                </li>
                <li class="flex items-start gap-4 p-3.5 border-b-2 border-red-300">
                    <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-600 text-white font-bold flex items-center justify-center text-sm">4</span>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed pt-0.5">Bersikap sportif, tidak membuat keributan, dan menjaga keselamatan bersama.</p>
                </li>
                <li class="flex items-start gap-4 p-3.5 border-b-2 border-red-300">
                    <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-600 text-white font-bold flex items-center justify-center text-sm">5</span>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed pt-0.5">Gunakan lapangan yang sesuai pada struk pemesanan.</p>
                </li>
                <li class="flex items-start gap-4 p-3.5 border-b-2 border-red-300">
                    <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-600 text-white font-bold flex items-center justify-center text-sm">6</span>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed pt-0.5">Simpan barang pribadi dengan rapi di loker yang tersedia, kunci dengan aman, dan bawa kunci bersama Anda.</p>
                </li>
            </div>
        </div>

        <!-- kolom kanan -->
        <div class="lg:col-span-2 bg-gradient-to-br from-red-600 to-red-800 p-8 sm:p-10 lg:p-12 flex flex-col justify-center h-full relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blue-2xl pointer-events-none"></div>
            <div class="absolute -left-10 -top-10 w-40 h-40 bg-black/10 rounded-full blur-2xl pointer-events-none"></div>

            <!-- title -->
            <div class="mb-8 relative z-10">
                <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center text-white text-xl mb-4 shadow-inner">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    Pengingat Penting
                </h2>
                <div class="w-16 h-1 bg-white/30 mt-3 rounded-full"></div>
            </div>

            <!-- daftar aturan -->
            <ul class="space-y-5 relative z-10">
                <li class="flex items-start gap-4 p-3 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 shadow-sm">
                    <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-white text-red-700 font-bold flex items-center justify-center text-xs shadow">1</span>
                    <p class="text-red-50 text-sm sm:text-base leadinig-relaxed">Pengguna yang datang terlambat <strong class="text-white font-semibold">tidak berhak</strong> meminta tambahan waktu.</p>
                </li>
                <li class="flex items-start gap-4 p-3 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 shadow-sm">
                    <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-white text-red-700 font-bold flex items-center justify-center text-xs shadow">2</span>
                    <p class="text-red-50 text-sm sm:text-base leadinig-relaxed">Pelanggaran aturan akan berakibat <strong class="text-white font-semibold">dikeluarkan dari lapangan</strong> dan tidak diizinkan masuk pada hari tersebut.</p>
                </li>
                <li class="flex items-start gap-4 p-3 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 shadow-sm">
                    <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-white text-red-700 font-bold flex items-center justify-center text-xs shadow">3</span>
                    <p class="text-red-50 text-sm sm:text-base leadinig-relaxed">Kehilangan barang pribadi menjadi <strong class="text-white font-semibold">tanggung jawab masing-masing pengguna</strong> bukan pihak Sport Center.</p>
                </li>
            </ul>
        </div>
    </div>
</section>

@endsection