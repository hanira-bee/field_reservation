@extends('layouts.app')
@section('title', 'Detail Lapangan')
@section('breadcrumb_link', route('lapangan.detail', $lapangan->id))


@section('content')
<section class="bg-gray-50 min-h-screen px-4 sm:px-6 py-6">
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
            <h2 class="text-2xl sm:text-3xl font-semibold text-gray-900 uppercase tracking-tight">
                {{ $lapangan->nama_lapangan }}
            </h2>
            <p class="text-xs text-gray-400 flex items-center gap-1 mt-1">
                <span class="material-icons text-sm">place</span> {{ $lapangan->lokasi }}
            </p>
        </div>

        <!-- FOTO UTAMA -->
        <div class="w-full aspect-[21/9] sm:aspect-[3/1] rounded-2xl overflow-hidden shadow-sm mb-8">
            <!-- memeriksa apakah kolam gambar di database memiliki isi -->
            @if(!empty($lapangan->gambar))
            <!-- membaca file gambar dinamis yang diupload admin ke folder public/images -->
            <img src="{{ asset('images/' . $lapangan->gambar) }}" alt="{{ $lapangan->nama_lapangan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
            @else
            <!-- gambar cadangan jika admin mengosongkan foto saat input lapangan baru -->
            <img src="{{ asset('images/banner-home1.jpg') }}" alt="Default Banner" class="w-full h-full object-cover group-hover:scale-105 transition-tranform duration-500 ease-in-out">
            @endif
        </div>

        <!-- LAYOUT GRID UTAMA -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- SISI KIRI: DATA DINAMIS DATABASE (Memakan 2 Kolom pada Layar Besar) -->
            <div class="lg:col-span-2 space-y-8 bg-white p-6 sm:p-8 rounded-2xl border border-gray-300 shadow-sm">

                <!-- Blok Deskripsi Lapangan -->
                <div>
                    <h3 class="font-prompt text-lg font-bold text-red-600 border-b border-gray-300 pb-1 mb-3">
                        Deskripsi Lapangan
                    </h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed flex text-justify">
                        {{ $lapangan->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                <!-- Blok Spesifikasi & Fasilitas -->
                <div>
                    <h3 class="font-prompt text-base font-bold text-gray-900 border-b border-gray-100 pb-2 mb-4">
                        Spesifikasi & Fasilitas
                    </h3>
                    <div class="grid grid-cols-2 gap-y-6 gap-x-4">
                        <!-- Kategori Lapangan -->
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase block mb-1">Kategori</span>
                            <p class="text-sm font-bold text-gray-600">{{ $lapangan->jenis_lapangan }}</p>
                        </div>

                        <!-- Pilihan Mode Sesi Aktif -->
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase block mb-1">Mode Durasi Sesi</span>
                            <!-- Mengubah bg-red-600 menjadi bg-gray-100 agar warna dasar netral dan estetis -->
                            <div class="inline-flex rounded-lg border border-gray-200 p-1 bg-gray-100 text-xs font-bold">

                                <button type="button" id="btn-1jam" onclick="switchPaket(1, {{ $lapangan->harga_per_jam }})"
                                    class="px-3 py-1.5 rounded-md bg-white text-gray-800 shadow-sm transition-all duration-150">
                                    Sesi 1 Jam
                                </button>

                                <button type="button" id="btn-2jam" onclick="switchPaket(2, {{ $lapangan->harga_per_jam * 2 }})"
                                    class="px-3 py-1.5 rounded-md text-gray-500 hover:text-gray-800 transition-all duration-150">
                                    Paket 2 Jam
                                </button>

                            </div>
                        </div>

                        <!-- Daftar Fasilitas -->
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase block mb-1">Fasilitas Tersedia</span>
                            <p class="text-sm sm:text-base font-bold text-gray-800">{{ $lapangan->fasilitas ?? 'Standar Arena' }}</p>
                        </div>

                        <!-- Ukuran Lapangan -->
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase block mb-1">Ukuran</span>
                            <p class="text-sm sm:text-base font-bold text-gray-800">{{ $lapangan->ukuran ?? 'Proporsional Arena' }}</p>
                        </div>
                    </div>
                </div>

            </div> <!-- Penutup Sisi Kiri -->

            <!-- SISI KANAN BARU: PANEL PRICE LIST DAN LOMPAT TANGGAL -->
            <div class="space-y-6">
                <!-- Card Price List -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <h3 class="font-prompt text-base font-bold text-gray-900 border-b border-gray-100 pb-2 mb-3 flex items-center gap-1">
                        <span class="material-icons text-emerald-600 text-sm">payments</span> Daftar Harga
                    </h3>
                    <div class="space-y-2 text-xs font-medium text-gray-600">
                        <div class="flex justify-between items-center bg-gray-50 p-2 rounded-lg">
                            <span>Weekday (Sesi 1 Jam)</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-gray-50 p-2 rounded-lg">
                            <span>Weekend (Sesi 1 Jam)</span>
                            <span class="font-bold text-emerald-600">Rp {{ number_format($lapangan->harga_per_jam + 25000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-gray-50 p-2 rounded-lg">
                            <span>Weekday (Paket 2 Jam)</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($lapangan->harga_per_jam * 2, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-gray-50 p-2 rounded-lg">
                            <span>Weekend (Paket 2 Jam)</span>
                            <span class="font-bold text-emerald-600">Rp {{ number_format(($lapangan->harga_per_jam + 25000) * 2, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Card Input Cari Tanggal Langsung -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <form action="{{ url()->current() }}" method="GET" class="space-y-2">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide flex items-center gap-1">
                            <span class="material-icons text-blue-600 text-sm">search</span> Lompat ke Tanggal Spesifik:
                        </label>
                        <div class="flex gap-2">
                            <input type="date" name="tanggal" value="{{ $tanggalDipilih }}" min="{{ date('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-red-500 bg-gray-50">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-4 rounded-xl text-sm transition">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div> <!-- Penutup Sisi Kanan Baru -->

        </div> <!-- Penutup Layout Grid Atas -->
        <!-- SISI BAWAH: PANEL KALENDER MINGGUAN LEBAR PENUH (Ditempatkan di luar grid atas agar memanjang) -->
        <div id="kalender-jadwal" class="bg-white border border-gray-100 rounded-3xl shadow-sm p-6 w-full mt-10">

            <!-- Header Kalender Mingguan & Tombol Navigasi Minggu -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-gray-100">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-1.5">
                        <span class="material-icons text-red-600">calendar_month</span> Daftar Jadwal Mingguan
                    </h3>
                    <h2 class="text-sm font-light text-red-600 py-1">Buka pukul 08:00 sampai 20:00</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Klik pada jam hijau yang tersedia untuk langsung melakukan reservasi</p>
                </div>

                <!-- Navigasi Tanggal Rentang Minggu -->
                <div class="flex items-center gap-3 self-start sm:self-auto">
                    <span class="text-xs sm:text-sm font-bold text-gray-700 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-200">
                        {{ \Carbon\Carbon::parse($startOfWeek)->format('m/d/Y') }} – {{ \Carbon\Carbon::parse($startOfWeek)->copy()->addDays(6)->format('m/d/Y') }}
                    </span>
                    <div class="inline-flex rounded-lg border border-gray-200 shadow-xs bg-white">
                        <a href="{{ url()->current() }}?tanggal={{ $prevWeekString ?? '' }}#kalender-jadwal" class="px-3 py-1.5 hover:bg-gray-50 text-gray-600 border-r border-gray-200 transition">&lsaquo;</a>
                        <a href="{{ url()->current() }}?tanggal={{ $nextWeekString ?? '' }}#kalender-jadwal" class="px-3 py-1.5 hover:bg-gray-50 text-gray-600 transition">&rsaquo;</a>
                    </div>
                </div>
            </div>

            <!-- TAMPILAN GRID KALENDER MINGGUAN (7 KOLOM RESPONSIVE) -->
            <div class="w-full overflow-x-auto pb-2">
                <div class="grid grid-cols-7 gap-4 min-w-[900px] lg:min-w-0">
                    @for ($i = 0; $i < 7; $i++)
                        @php
                        $hariH=\Carbon\Carbon::parse($startOfWeek)->copy()->addDays($i);
                        $tanggalString = $hariH->toDateString();
                        $isHariIniAsli = $tanggalString === \Carbon\Carbon::today()->toDateString();

                        // HARI PASALALU UMUM: Jika tanggalnya hari kemarin
                        $isTanggalMasaLalu = $hariH->isPast() && !$hariH->isToday();
                        @endphp

                        <!-- Kotak Kolom Per Hari -->
                        <div class="rounded-xl p-3 transition border flex flex-col {{ $isHariIniAsli ? 'bg-amber-50/40 border-amber-300 ring-2 ring-amber-100' : 'bg-gray-50/50 border-gray-100' }}">

                            <!-- Label Nama Hari & Tanggal -->
                            <div class="text-center pb-2 mb-3 border-b border-gray-200/60">
                                <p class="text-xs font-bold {{ $isHariIniAsli ? 'text-amber-700' : 'text-blue-600' }}">
                                    {{ $hariH->isoFormat('ddd') }} {{ $hariH->format('n/j') }}
                                </p>
                            </div>

                            <!-- Tempat Penampungan Sesi Jam Kontainer -->

                            <!-- Sesi 1 Jam (Aktif Pertama Kali) -->
                            <div class="wrapper-sesi-1jam space-y-1.5 flex-grow">
                                @foreach($sesi1Jam as $sesi)
                                @php
                                // PERBAIKAN AKURASI UTAMA: Gabungkan tanggal hari ini dengan jam sesi untuk pengecekan absolut
                                $waktuSesiKonkrit = \Carbon\Carbon::parse($tanggalString . ' ' . $sesi);

                                // Sesi otomatis CLOSED jika tanggalnya masa lalu ATAU jika hari ini tetapi jam sesinya sudah lewat/sedang berjalan
                                $isSesiDitutup = $waktuSesiKonkrit->isPast();

                                $bookingLangsung = isset($matriksBooking[$tanggalString][$sesi]);
                                $jamMundur1Jam = \Carbon\Carbon::parse($sesi)->subHour()->format('H:i');
                                $terpakaiPaket2Jam = isset($matriksBooking[$tanggalString][$jamMundur1Jam]) &&
                                $matriksBooking[$tanggalString][$jamMundur1Jam]['durasi_paket_2_jam'] === true;

                                $sudahDihuni = $bookingLangsung || $terpakaiPaket2Jam;
                                @endphp

                                @if($isSesiDitutup)
                                <div class="py-1.5 px-2 bg-gray-100 text-gray-400 rounded text-[10px] text-center cursor-not-allowed select-none">Closed</div>
                                @elseif($sudahDihuni)
                                <div class="py-1.5 px-1.5 bg-red-50 text-red-600 border border-red-100 rounded text-[10px] font-bold text-center cursor-not-allowed">Booked</div>
                                @else
                                <a href="{{ route('reservasi', ['lapangan_id' => $lapangan->id, 'tanggal' => $tanggalString, 'jam' => $sesi]) }}" class="py-1.5 px-1.5 bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white border border-emerald-100 rounded text-[10px] font-bold text-center block transition">{{ $sesi }}</a>
                                @endif
                                @endforeach
                            </div>


                            <!-- Sesi 2 Jam (PERBAIKAN BESAR: Menggunakan $sesi2Jam dan Memotong String Jam Mulai) -->
                            <div class="wrapper-sesi-2jam space-y-1.5 flex-grow hidden">
                                @foreach($sesi2Jam as $sesi)
                                @php
                                $jamMulaiSesi2 = substr($sesi, 0, 5); // Potong teks ambil "08:00"
                                $jamTengahSesi2 = \Carbon\Carbon::parse($jamMulaiSesi2)->addHour()->format('H:i');

                                // PERBAIKAN AKURASI UTAMA: Deteksi penutupan paket 2 jam berdasarkan jam mulainya
                                $waktuSesi2Konkrit = \Carbon\Carbon::parse($tanggalString . ' ' . $jamMulaiSesi2);
                                $isSesiDitutup = $waktuSesi2Konkrit->isPast();

                                $mulaiTerpakai = isset($matriksBooking[$tanggalString][$jamMulaiSesi2]);
                                $tengahTerpakai = isset($matriksBooking[$tanggalString][$jamTengahSesi2]);

                                $sudahDihuni = $mulaiTerpakai || $tengahTerpakai;
                                @endphp

                                @if($isSesiDitutup)
                                <div class="py-1.5 px-2 bg-gray-100 text-gray-400 rounded text-[10px] text-center cursor-not-allowed select-none">Closed</div>
                                @elseif($sudahDihuni)
                                <div class="py-1.5 px-1.5 bg-red-50 text-red-600 border border-red-100 rounded text-[10px] font-bold text-center cursor-not-allowed">Booked</div>
                                @else
                                <a href="{{ route('reservasi', ['lapangan_id' => $lapangan->id, 'tanggal' => $tanggalString, 'jam' => $sesi]) }}" class="py-1.5 px-1.5 bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white border border-emerald-100 rounded text-[10px] font-bold text-center block transition">{{ $sesi }}</a>
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
                    *Catatan: Sesi paket 2 jam otomatis mengalokasikan slot waktu yang terintegrasi.
                </div>
            </div>

        </div> <!-- Penutup Elemen #kalender-jadwal -->

    </div> <!-- Penutup Pembungkus Kontainer Utama max-w-7xl -->
</section>

<!-- KODE JAVASCRIPT SWITCHER DINAMIS UNTUK STRUKTUR KALENDER MINGGUAN -->
<script>
    function switchPaket(durasi, hargaFinal) {
        // 1. Ambil seluruh kontainer sesi jam yang tersebar di 7 hari kalender
        const wrappers1Jam = document.querySelectorAll('.wrapper-sesi-1jam');
        const wrappers2Jam = document.querySelectorAll('.wrapper-sesi-2jam');

        const btn1 = document.getElementById('btn-1jam');
        const btn2 = document.getElementById('btn-2jam');
        const labelHarga = document.getElementById('label-harga-sewa');

        // 2. Fungsi pembuat format mata uang Rupiah
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        });

        // 3. Eksekusi perpindahan kelas
        if (durasi === 1) {
            // Tampilkan sesi 1 jam, sembunyikan sesi 2 jam
            wrappers1Jam.forEach(el => el.classList.remove('hidden'));
            wrappers2Jam.forEach(el => el.classList.add('hidden'));

            if (labelHarga) labelHarga.innerText = formatter.format(hargaFinal) + " / Jam";

            // Aktifkan gaya aktif tombol 1 jam
            btn1.className = "px-3 py-1.5 rounded-md bg-white text-gray-800 shadow-sm transition-all duration-150";
            btn2.className = "px-3 py-1.5 rounded-md text-gray-500 hover:text-gray-800 transition-all duration-150";
        } else {
            // Tampilkan sesi 2 jam, sembunyikan sesi 1 jam
            wrappers1Jam.forEach(el => el.classList.add('hidden'));
            // PERBAIKAN: Menghapus total class hidden agar grid 7 kolom terbuka lebar
            wrappers2Jam.forEach(el => el.classList.remove('hidden'));

            if (labelHarga) labelHarga.innerText = formatter.format(hargaFinal) + " / Paket 2 Jam";

            // Aktifkan gaya aktif tombol 2 jam
            btn2.className = "px-3 py-1.5 rounded-md bg-white text-gray-800 shadow-sm transition-all duration-150";
            btn1.className = "px-3 py-1.5 rounded-md text-gray-500 hover:text-gray-800 transition-all duration-150";
        }
    }
</script>




@endsection