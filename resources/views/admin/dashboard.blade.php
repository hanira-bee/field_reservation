@extends('layouts.admin')

@section('page_title', 'Dashboard Overview')

@section('content')
<section class="bg-white space-y-10">

    <!-- BARIS JUDUL UTAMA -->
    <div>
        <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Dashboard Overview</h1>
        <p class="mt-1 text-sm text-gray-800 font-normal">Pusat kendali operasional, verifikasi transaksi pembayaran, dan pengawasan jadwal harian SM Sport Center.</p>
    </div>

    <!-- KUMPULAN 4 KARTU STATISTIK MINIMALIS PREMIUM -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Kartu 1: Finansial Bulanan -->
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold text-gray-700 uppercase tracking-wider leading-none">Omzet Bulan Ini</p>
                <p class="text-xl font-black text-gray-900">Rp {{ number_format($totalPendapatanBulanIni, 0, ',', '.') }}</p>
            </div>
            <div class="w-10 h-11 rounded-xl bg-red-50 flex items-center justify-center text-red-600 shadow-3xs"><span class="material-icons text-xl">payments</span></div>
        </div>

        <!-- Kartu 2: Urgensi Notifikasi Pending -->
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold text-gray-700 uppercase tracking-wider leading-none">Permohonan Baru</p>
                <p class="text-xl font-black {{ $jumlahReservasiBaru > 0 ? 'text-red-600 animate-pulse' : 'text-gray-900' }}">{{ $jumlahReservasiBaru }} Sesi</p>
            </div>
            <div class="w-10 h-11 rounded-xl bg-red-50 flex items-center justify-center text-red-600 shadow-3xs"><span class="material-icons text-xl">notification_important</span></div>
        </div>

        <!-- Kartu 3: Skala Pelanggan -->
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold text-gray-700 uppercase tracking-wider leading-none">Total Pelanggan</p>
                <p class="text-xl font-black text-gray-900">{{ $totalPelanggan }} Akun</p>
            </div>
            <div class="w-10 h-11 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 shadow-3xs"><span class="material-icons text-xl">people</span></div>
        </div>

        <!-- Kartu 4: Skala Lapangan -->
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold text-gray-700 uppercase tracking-wider leading-none">Lapangan Aktif</p>
                <p class="text-xl font-black text-gray-900">{{ $totalLapanganAktif }} Arena</p>
            </div>
            <div class="w-10 h-11 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 shadow-3xs"><span class="material-icons text-xl">sports_soccer</span></div>
        </div>

    </div>

    <!-- TATA LETAK LAYOUT DUA KOLOM BAWAH -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pt-4">

        <!-- KOLOM KIRI (MEMAKAN 2 KOLOM): AGENDA JADWAL TANDING HARI INI -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-2">
                <h3 class="font-prompt text-base font-black text-gray-900 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="material-icons text-red-600 text-sm">schedule</span> Jadwal Tanding Hari Ini
                </h3>
                <span class="text-[10px] font-bold bg-red-50 text-red-600 px-2 py-0.5 rounded-md border border-red-100 uppercase tracking-wider">
                    {{ \Carbon\Carbon::today()->isoFormat('D MMMM Y') }}
                </span>
            </div>

            <!-- TABEL AGENDA HARIAN -->
            <div class="w-full overflow-x-auto border border-gray-200 rounded-2xl shadow-3xs bg-white">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-800 text-[10px] font-bold uppercase tracking-wider border-b border-gray-100">
                            <th class="py-2.5 px-4">Jam Sesi</th>
                            <th class="py-2.5 px-4">Nama Penyewa</th>
                            <th class="py-2.5 px-4">Arena Lapangan</th>
                            <th class="py-2.5 px-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                        @forelse($jadwalHariIni as $hariIni)
                        @php
                        $isPaket2Jam = (float)$hariIni->total_biaya > (float)$hariIni->lapangan->harga_per_jam;
                        $jamMulai = \Carbon\Carbon::parse($hariIni->slot_jam)->format('H:i');
                        $jamSelesai = \Carbon\Carbon::parse($hariIni->slot_jam)->addHours($isPaket2Jam ? 2 : 1)->format('H:i');
                        @endphp
                        <tr class="hover:bg-gray-50/30">
                            <td class="py-3 px-4">
                                <span class="text-xs font-mono font-bold text-red-600 bg-red-50 border border-red-100/60 px-2 py-0.5 rounded-md">
                                    {{ $jamMulai }} - {{ $jamSelesai }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <p class="font-bold text-gray-900 leading-none mb-0.5">{{ $hariIni->user->name }}</p>
                                <span class="text-[10px] font-mono text-gray-400 block font-normal">#{{ $hariIni->kode_booking }}</span>
                            </td>
                            <td class="py-3 px-4 text-xs font-bold text-gray-600">
                                {{ $hariIni->lapangan->nama_lapangan }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="text-[9px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-100 px-2 py-0.5 rounded-md inline-block shadow-3xs">
                                    Lunas / Ready
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-gray-400 font-medium bg-gray-50/20">
                                <span class="material-icons text-3xl text-gray-200 block mb-1">event_busy</span>
                                Belum ada agenda pertandingan yang disetujui untuk hari ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- KOLOM KANAN (MEMAKAN 1 KOLOM): ANTREAN STRUK TRANSFER MASUK (URGENT LOG) -->
        <div class="space-y-4">
            <div class="border-b border-gray-100 pb-2">
                <h3 class="font-prompt text-base font-black text-gray-900 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="material-icons text-red-600 text-sm">pending_actions</span> Antrean Bukti Transfer
                </h3>
            </div>

            <!-- DAFTAR LOG ANTREAN INDIVIDU -->
            <div class="space-y-3">
                @forelse($bookingButuhTindakan as $butuh)
                <div class="bg-red-50 border border-gray-100 rounded-2xl p-4 shadow-3xs flex flex-col space-y-3 transition hover:shadow-xs">

                    <div class="flex justify-between items-start gap-2">
                        <div>
                            <p class="text-xs font-black text-gray-900 leading-none mb-1">{{ $butuh->user->name }}</p>
                            <p class="text-[10px] font-bold text-gray-800 uppercase tracking-wide truncate max-w-[120px]">{{ $butuh->lapangan->nama_lapangan }}</p>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-gray-800 bg-gray-50 px-2 py-0.5 rounded border border-gray-200">
                            #{{ $butuh->kode_booking }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between pt-2 border-t border-gray-50">
                        <!-- Tombol Cek Gambar Struk Bukti Transfer Pelanggan -->
                        <div>
                            @if($butuh->bukti_pembayaran)
                            <a href="{{ asset('images/bukti_transfer/' . $butuh->bukti_pembayaran) }}" target="_blank" class="inline-flex items-center gap-0.5 text-[10px] font-black uppercase bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-1.5 rounded-xl hover:bg-emerald-600 hover:text-white transition shadow-3xs">
                                <span class="material-icons text-xs">visibility</span> Lihat Struk
                            </a>
                            @else
                            <span class="inline-flex items-center gap-0.5 text-[10px] font-bold bg-gray-50 text-gray-700 border border-gray-200 px-2.5 py-1.5 rounded-xl select-none">
                                <span class="material-icons text-xs">hourglass_bottom</span> Belum Upload
                            </span>
                            @endif
                        </div>

                        <!-- Tombol Cepat Akses Tindakan Konfirmasi -->
                        <a href="{{ route('admin.reservasi.index') }}?status=pending" class="text-[10px] font-black uppercase text-red-600 hover:text-red-700 flex items-center gap-0.5 tracking-wider transition">
                            Proses Sesi &rarr;
                        </a>
                    </div>

                </div>
                @empty
                <!-- Jika Bersih: Tampilan Box Kosong Nyaman -->
                <div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50/30 p-8 text-center text-gray-400 shadow-3xs">
                    <span class="material-icons text-3xl text-gray-200 block mb-1">task_alt</span>
                    Bersih! Tidak ada permohonan tertunda yang masuk saat ini.
                </div>
                @endforelse
            </div>
        </div> <!-- PENUTUP LAYOUT KOLOM KANAN -->

    </div> <!-- PENUTUP DUA KOLOM GRID BAWAH -->
</section>
@endsection