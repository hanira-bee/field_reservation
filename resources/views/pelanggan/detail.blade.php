@extends('layouts.app')
@section('title', 'Detail Lapangan')
@section('breadcrumb_link', route('lapangan.detail', $lapangan->id))


@section('content')
<section class="bg-gray-50 min-h-screen px-4 sm:px-6 py-12">
    <div class="mx-auto max-w-7xl">

        <!-- BREADCRUMB -->
        <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 mb-4">
            <a href="{{ route('home') }}" class="hover:text-red-600 transition">Beranda</a>
            <i class="fa-solid fa-angle-right text-red-600 text-[10px]"></i>
            <a href="{{ route('lapangan') }}" class="hover:text-red-600 transition">Lapangan</a>
            <i class="fa-solid fa-angle-right text-red-600 text-[10px]"></i>
            <span class="text-gray-800 font-bold">{{ $lapangan->nama_lapangan }}</span>
        </div>

        <!-- NAMA LAPANGAN -->
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-black text-gray-900 uppercase tracking-tight">
                {{ $lapangan->nama_lapangan }}
            </h1>
            <p class="text-xs text-gray-400 flex items-center gap-1 mt-1">
                <span class="material-icons text-sm">place</span> {{ $lapangan->lokasi }}
            </p>
        </div>

        <!-- FOTO UTAMA -->
        <div class="w-full aspect-[21/9] sm:aspect-[3/1] rounded-2xl overflow-hidden shadow-sm mb-8">
            <!-- Gambar otomatis menyesuaikan jenis olahraga -->
            @if($lapangan->jenis_lapangan == 'Futsal')
            <img src="/images/futsal_indoor.jpg" alt="Futsal Arena" class="w-full h-full object-cover">
            @else
            <img src="/images/badminton_indoor.jpg" alt="Badminton Arena" class="w-full h-full object-cover">
            @endif
        </div>

        <!-- LAYOUT GRID UTAMA -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- SISI KIRI: DATA DINAMIS DATABASE (Memakan 2 Kolom pada Layar Besar) -->
            <div class="lg:col-span-2 space-y-8 bg-white p-6 sm:p-8 rounded-2xl border border-gray-100 shadow-sm">

                <!-- Blok Deskripsi Lapangan -->
                <div>
                    <h3 class="font-prompt text-lg font-bold text-gray-900 border-b border-gray-100 pb-2 mb-3">
                        Deskripsi Lapangan
                    </h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed whitespace-pre-line">
                        {{ $lapangan->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                <!-- Blok Spesifikasi & Fasilitas -->
                <div>
                    <h3 class="font-prompt text-lg font-bold text-gray-900 border-b border-gray-100 pb-2 mb-4">
                        Spesifikasi & Fasilitas
                    </h3>
                    <div class="grid grid-cols-2 gap-y-6 gap-x-4">
                        <!-- Kategori Kategori Lapangan -->
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase block mb-1">Kategori</span>
                            <p class="text-sm sm:text-base font-bold text-gray-800">{{ $lapangan->jenis_lapangan }}</p>
                        </div>

                        <!-- Harga Sewa Lapangan -->
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase block mb-1">Harga Sewa</span>
                            <p class="text-sm sm:text-base font-bold text-emerald-600">
                                Rp {{ number_format($hargaSewaHariIni ?? $lapangan->harga_per_jam, 0, ',', '.') }} / Jam
                            </p>
                        </div>

                        <!-- Daftar Fasilitas yang tersedia -->
                        <div class="col-span-2">
                            <span class="text-xs font-semibold text-gray-400 uppercase block mb-1">Fasilitas Tersedia</span>
                            <p class="text-sm sm:text-base font-bold text-gray-800">{{ $lapangan->fasilitas ?? 'Standar Arena' }}</p>
                        </div>
                    </div>
                </div>

            </div> <!-- Penutup Sisi Kiri -->
            <!-- SISI KANAN: PANEL JADWAL DAN KALENDER MINGGUAN -->
            <div class="lg:col-span-3 bg-white border border-gray-100 rounded-2xl shadow-md p-6 w-full">

                <!-- Header Kalender Mingguan & Tombol Navigasi Minggu -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-1.5">
                            <span class="material-icons text-red-600">calendar_month</span> Daftar Jadwal Mingguan
                        </h3>
                        <p class="text-xs text-gray-400 mt-0.5">Klik pada jam hijau yang tersedia untuk langsung melakukan reservasi</p>
                    </div>

                    <!-- Navigasi Tanggal Rentang Minggu -->
                    <div class="flex items-center gap-3 self-start sm:self-auto">
                        <span class="text-xs sm:text-sm font-bold text-gray-700 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-200">
                            {{ \Carbon\Carbon::parse($startOfWeek)->format('m/d/Y') }} – {{ \Carbon\Carbon::parse($startOfWeek)->copy()->addDays(6)->format('m/d/Y') }}
                        </span>
                        <div class="inline-flex rounded-lg border border-gray-200 shadow-xs bg-white">
                            <a href="{{ url()->current() }}?tanggal={{ $prevWeekString ?? '' }}" class="px-3 py-1.5 hover:bg-gray-50 text-gray-600 border-r border-gray-200 transition">&lsaquo;</a>
                            <a href="{{ url()->current() }}?tanggal={{ $nextWeekString ?? '' }}" class="px-3 py-1.5 hover:bg-gray-50 text-gray-600 transition">&rsaquo;</a>
                        </div>
                    </div>
                </div>

                <!-- TAMPILAN GRID KALENDER MINGGUAN (7 KOLOM RESPONSIVE) -->
                <div class="w-full overflow-x-auto pb-2">
                    <div class="grid grid-cols-7 gap-4 min-w-[840px] lg:min-w-0">

                        @for ($i = 0; $i < 7; $i++)
                            @php
                            $hariH=\Carbon\Carbon::parse($startOfWeek)->copy()->addDays($i);
                            $tanggalString = $hariH->toDateString();
                            $isHariIni = $tanggalString === $tanggalAcuan;
                            $isMasaLalu = $hariH->isPast() && !$hariH->isToday();
                            @endphp

                            <!-- Kotak Kolom Per Hari -->
                            <div class="rounded-xl p-2 transition border flex flex-col {{ $isHariIni ? 'bg-amber-50/40 border-amber-300 ring-2 ring-amber-100' : 'bg-gray-50/50 border-gray-100' }}">

                                <!-- Label Nama Hari & Tanggal -->
                                <div class="text-center pb-2 mb-3 border-b border-gray-200/60">
                                    <p class="text-xs font-bold {{ $isHariIni ? 'text-amber-700' : 'text-blue-600' }}">
                                        {{ $hariH->isoFormat('ddd') }} {{ $hariH->format('n/j') }}
                                    </p>
                                </div>

                                <!-- PERBAIKAN: Daftar Slot Jam Berada di Dalam Kotak Hari Terkait -->
                                <div class="space-y-1.5 flex-grow">
                                    @foreach($daftarSesi as $sesi)
                                    @php
                                    $formatSesiSelesai = \Carbon\Carbon::parse($sesi)->addHours(2)->format('H:i');
                                    $sudahDihuni = isset($matriksBooking[$tanggalString]) && in_array($sesi, $matriksBooking[$tanggalString]);
                                    @endphp

                                    @if($isMasaLalu)
                                    <!-- Kondisi 1: Sesi Kadaluwarsa / Masa Lalu -->
                                    <div class="py-1.5 px-2 bg-gray-100 text-gray-400 rounded text-[10px] font-medium text-center cursor-not-allowed">
                                        Closed
                                    </div>
                                    @elseif($sudahDihuni)
                                    <!-- Kondisi 2: Sesi Terpesan (Indikator Merah) -->
                                    <div class="py-1.5 px-1.5 bg-red-50 text-red-600 border border-red-100 rounded text-[10px] font-bold flex items-center justify-center gap-1 cursor-not-allowed" title="Jadwal Terpesan">
                                        <span class="w-1.5 h-1.5 bg-red-600 rounded-full inline-block animate-pulse"></span> {{ $sesi }}
                                    </div>
                                    @else
                                    <!-- Kondisi 3: Sesi Tersedia (Indikator Hijau) -->
                                    <a href="{{ route('reservasi', ['lapangan_id' => $lapangan->id, 'tanggal' => $tanggalString, 'jam' => $sesi]) }}" class="py-1.5 px-1.5 bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white border border-emerald-100 rounded text-[10px] font-bold flex items-center justify-center gap-1 transition duration-150 block text-center" title="Klik untuk Booking">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full inline-block"></span> {{ $sesi }}
                                    </a>
                                    @endif
                                    @endforeach
                                </div>

                            </div> <!-- Penutup Kotak Kolom Per Hari -->
                            @endfor

                    </div>
                </div>

                <!-- PANEL LEGENDA KETERANGAN STATUS WARNA -->
                <div class="mt-6 flex flex-wrap gap-4 text-xs font-bold text-gray-500 border-t border-gray-100 pt-4">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-emerald-50 border border-emerald-100 rounded-full inline-block"></span> Jadwal Tersedia
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-red-50 border border-red-100 rounded-full inline-block"></span> Jadwal Terpesan
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-gray-100 rounded-full inline-block"></span> Sudah Lewat
                    </div>
                    <div class="ml-auto text-xs font-medium text-gray-400">
                        *Catatan: Sesi berdurasi per 2 jam sesuai regulasi arena permainan.
                    </div>
                </div>

            </div> <!-- Penutup Sisi Kanan -->

        </div> <!-- Penutup Layout Grid Utama -->
    </div>
</section>
@endsection