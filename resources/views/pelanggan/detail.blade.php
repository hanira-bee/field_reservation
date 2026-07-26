@extends('layouts.app')
@section('title', 'Detail Lapangan')
@section('breadcrumb_link', route('detail'))


@section('content')
<section class="bg-gray-50 min-h-screen px-4 sm:px-6 py-12">
    <div class="mx-auto max-w-7xl">
        
        <!-- 1. BREADCRUMB (Paling Atas) -->
        <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 mb-4">
            <a href="{{ route('home') }}" class="hover:text-red-600 transition">Beranda</a>
            <i class="fa-solid fa-angle-right text-red-600 text-[10px]"></i>
            <span class="text-gray-800 font-bold">@yield('title', 'Detail Lapangan')</span>
        </div>

        <!-- 2. NAMA LAPANGAN -->
        <div class="mb-6">
            <!-- Otomatis membaca font-prompt dari app.css Anda -->
            <h1 class="text-2xl sm:text-3xl font-black text-gray-900 uppercase tracking-tight">
                {{ $lapangan->nama_lapangan }}
            </h1>
        </div>

        <!-- 3. FOTO UTAMA (Bentuk Persegi Panjang / Landscape Ramah Ruang) -->
        <div class="w-full aspect-[21/9] sm:aspect-[3/1] rounded-2xl overflow-hidden shadow-sm mb-8">
            <img src="/images/{{ $lapangan->gambar ?? 'futsal_outdoor.jpg' }}" 
                 alt="Foto Utama Lapangan" 
                 class="w-full h-full object-cover">
        </div>

        <!-- LAYOUT UTAMA: KIRI (INFO) & KANAN (JADWAL STICKY) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- --- SISI KIRI: DETAIL LAPANGAN (Memakan 2 Kolom) --- -->
            <div class="lg:col-span-2 space-y-8 bg-white p-6 sm:p-8 rounded-2xl border border-gray-100 shadow-xs">
                
                <!-- Deskripsi -->
                <div>
                    <h3 class="font-prompt text-lg font-bold text-gray-900 border-b border-gray-100 pb-2 mb-3">
                        Deskripsi Lapangan
                    </h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed whitespace-pre-line">
                        {{ $lapangan->deskripsi ?? 'Rasakan sensasi pertandingan terbuka di atas lapisan rumput sintetis premium yang empuk, meminimalisir risiko cedera, dan dirancang khusus untuk akurasi pantulan bola yang optimal.' }}
                    </p>
                </div>

                <!-- Spesifikasi & Fasilitas (Grid Grid) -->
                <div>
                    <h3 class="font-prompt text-lg font-bold text-gray-900 border-b border-gray-100 pb-2 mb-4">
                        Spesifikasi & Fasilitas
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-y-6 gap-x-4">
                        <!-- Jenis Olahraga -->
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Jenis Olahraga</span>
                            <p class="text-sm sm:text-base font-bold text-gray-800">{{ $lapangan->jenis_olahraga ?? 'Futsal' }}</p>
                        </div>
                        
                        <!-- Tipe Arena -->
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Tipe Arena</span>
                            <p class="text-sm sm:text-base font-bold text-gray-800">{{ $lapangan->jenis_lapangan ?? 'Outdoor' }}</p>
                        </div>

                        <!-- Ukuran -->
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Ukuran Lapangan</span>
                            <p class="text-sm sm:text-base font-bold text-gray-800">11 Meters x 40 Meters</p>
                        </div>

                        <!-- Fasilitas -->
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Fasilitas Penunjang</span>
                            <p class="text-sm sm:text-base font-bold text-gray-800">Toilet, Ruang Ganti, Kursi Tribun, Parkir Luas</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- --- SISI KANAN: DAFTAR JADWAL STICKY (Memakan 1 Kolom) --- -->
            <!-- lg:sticky & lg:top-6 membuat panel ini mengunci saat di-scroll ke bawah -->
            <div class="lg:sticky lg:top-6 bg-white border border-gray-100 rounded-2xl shadow-md p-6">
                
                <h3 class="font-prompt text-lg font-bold text-gray-900 mb-1">Pesan Sekarang!</h3>
                <p class="text-xs text-gray-400 mb-4">Pilih sesi waktu bermain Anda di bawah ini:</p>

                <!-- Jadwal Sesi (Sesi 1 - Sesi 6 Berdurasi 1 Jam Mulai Jam 08:00) -->
                <div class="space-y-4">
                    
                    <!-- Kategori 1: Weekday -->
                    <div>
                        <div class="flex justify-between items-center bg-emerald-50 text-emerald-800 px-3 py-2 rounded-lg mb-2">
                            <span class="text-xs font-bold uppercase tracking-wider">Tarif Weekday</span>
                            <span class="text-sm font-black">Rp 130.000 <span class="text-[10px] font-normal">/Jam</span></span>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-center text-xs font-semibold text-gray-600">
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">08:00 - 09:00</div>
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">09:00 - 10:00</div>
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">10:00 - 11:00</div>
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">11:00 - 12:00</div>
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">12:00 - 13:00</div>
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">13:00 - 14:00</div>
                        </div>
                    </div>

                    <!-- Kategori 2: Weekend -->
                    <div>
                        <div class="flex justify-between items-center bg-blue-50 text-blue-800 px-3 py-2 rounded-lg mb-2">
                            <span class="text-xs font-bold uppercase tracking-wider">Tarif Weekend</span>
                            <span class="text-sm font-black">Rp 150.000 <span class="text-[10px] font-normal">/Jam</span></span>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-center text-xs font-semibold text-gray-600">
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">08:00 - 09:00</div>
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">09:00 - 10:00</div>
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">10:00 - 11:00</div>
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">11:00 - 12:00</div>
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">12:00 - 13:00</div>
                            <div class="p-2 border border-gray-100 rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-600 cursor-pointer transition">13:00 - 14:00</div>
                        </div>
                    </div>

                </div>

                <!-- 4. BUTTON RESERVASI (Paling Bawah Kotak Sticky) -->
                <!-- Menggunakan group hover transisi panah & scale-102 -->
                <div class="mt-6">
                    <a href="#link-formulir-booking" class="font-rubik group flex items-center justify-center gap-2 w-full py-3 bg-red-600 hover:bg-red-800 text-white font-bold rounded-xl text-center shadow transform hover:scale-102 transition-all duration-150 ease-in-out cursor-pointer">
                        <span>BOOK NOW</span>
                        <span class="opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-200">
                            &rarr;
                        </span>
                    </a>
                </div>

            </div>

        </div>

    </div>
</section>

@endsection