@extends('layouts.app')

@section('content')
<section class="min-h-[85vh] bg-gray-50 px-4 sm:px-8 py-24">
    <div class="max-w-6xl mx-auto space-y-8">

        <!-- HEADER DASHBOARD UTAMA PELANGGAN -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Riwayat Pemesanan</h1>
            <p class="text-sm text-gray-400 font-medium mt-1">Pantau status persetujuan, kode tiket digital, dan kelola unggahan bukti transfer Anda di sini.</p>
        </div>

        <!-- NOTIFIKASI FLASH SUKSES -->
        @if(session('success'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700 flex items-center gap-2">
            <span class="material-icons text-base">check_circle</span> {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- SISI KIRI (KOLOM 1 & 2): DAFTAR TABEL TIKET RESERVASI -->
            <div class="lg:col-span-2 space-y-4">
                @forelse($reservasis as $res)
                @php
                // Menghitung otomatis jam selesai bermain
                $isPaket2Jam = (float)$res->total_biaya > (float)$res->lapangan->harga_per_jam;
                $jamMulai = \Carbon\Carbon::parse($res->slot_jam)->format('H:i');
                $jamSelesai = \Carbon\Carbon::parse($res->slot_jam)->addHours($isPaket2Jam ? 2 : 1)->format('H:i');
                @endphp

                <!-- CARD INDIVIDU TIKET -->
                <div class="bg-white border border-gray-100 rounded-3xl p-5 sm:p-6 shadow-xs flex flex-col sm:flex-row justify-between gap-4 items-start sm:items-center transition hover:shadow-md">

                    <!-- Info Detail Kiri -->
                    <div class="space-y-2 flex-grow w-full sm:w-auto">
                        <div class="flex flex-wrap items-center gap-2">
                            <!-- Kode Tiket Digital -->
                            <span class="font-mono text-xs font-black text-gray-400 uppercase tracking-wider block bg-gray-50 px-2.5 py-1 rounded-lg border border-gray-200 shadow-2xs">
                                #{{ $res->kode_booking ?? 'PENDING_CODE' }}
                            </span>

                            <!-- Badge Status Transaksi Dinamis -->
                            @if($res->status_reservasi === 'pending')
                            <span class="text-[9px] font-black uppercase tracking-wider bg-amber-50 text-amber-600 border border-amber-200 px-2 py-1 rounded-md">Menunggu Bukti</span>
                            @elseif($res->status_reservasi === 'confirmed')
                            <span class="text-[9px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-1 rounded-md">Lunas / Disetujui</span>
                            @else
                            <span class="text-[9px] font-black uppercase tracking-wider bg-gray-100 text-gray-400 border border-gray-200 px-2 py-1 rounded-md">Dibatalkan</span>
                            @endif
                        </div>

                        <!-- Detail Arena Lapangan -->
                        <h3 class="text-lg font-black text-gray-900 leading-tight">
                            {{ $res->lapangan->nama_lapangan }}
                        </h3>

                        <!-- Waktu dan Tanggal Main -->
                        <div class="text-xs text-gray-500 space-y-1 font-medium">
                            <p class="flex items-center gap-1"><span class="material-icons text-sm text-gray-400">calendar_today</span> {{ \Carbon\Carbon::parse($res->tgl_reservasi)->format('d M Y') }}</p>
                            <p class="flex items-center gap-1"><span class="material-icons text-sm text-gray-400">schedule</span> {{ $jamMulai }} - {{ $jamSelesai }} WIB ({{ $isPaket2Jam ? 'Paket 2 Jam' : 'Sesi 1 Jam' }})</p>
                        </div>
                    </div>

                    <!-- INFO FINANSIAL & FITUR AKSES TOMBOL KANAN -->
                    <div class="text-left sm:text-right w-full sm:w-auto border-t sm:border-t-0 pt-3 sm:pt-0 flex sm:flex-col justify-between sm:justify-center items-center sm:items-end gap-3 shrink-0">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Total Biaya</p>
                            <p class="text-base font-black text-emerald-600">Rp {{ number_format($res->total_biaya, 0, ',', '.') }}</p>
                        </div>

                        <!-- BLOK OPERASI TOMBOL (DIPERBAIKI AGAR STRUKTUR LOGIKA SEIMBANG) -->
                        @if($res->status_reservasi === 'pending')
                        <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                            <!-- 1. Tombol Unggah Gambar Struk Transfer -->
                            <form action="{{ route('pelanggan.upload-bukti', $res->id) }}" method="POST" enctype="multipart/form-data" class="w-full sm:w-auto">
                                @csrf
                                <label class="w-full text-center sm:w-auto px-4 py-2 text-xs font-black uppercase tracking-wider border border-red-200 hover:border-red-600 text-red-600 hover:text-white bg-red-50/40 hover:bg-red-600 rounded-xl transition cursor-pointer flex items-center justify-center gap-1 shadow-2xs">
                                    <span class="material-icons text-sm">cloud_upload</span>
                                    <span>{{ $res->bukti_pembayaran ? 'Ganti Struk' : 'Upload Struk' }}</span>
                                    <input type="file" name="bukti_pembayaran" accept="image/*" class="hidden" onchange="this.form.submit()">
                                </label>
                            </form>

                            <!-- 2. Tombol Batalkan Pengajuan Reservasi Secara Mandiri -->
                            <form action="{{ route('pelanggan.batal-mandiri', $res->id) }}" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan permohonan reservasi lapangan ini? Slot jam yang Anda sewa akan otomatis terbuka hijau kembali untuk pelanggan lain.')">
                                @csrf
                                <button type="submit" class="w-full text-center sm:w-auto px-4 py-2 text-xs font-black uppercase tracking-wider border border-gray-200 hover:border-red-600 text-gray-400 hover:text-white bg-gray-50 hover:bg-red-600 rounded-xl transition flex items-center justify-center gap-1 cursor-pointer shadow-2xs shadow-gray-100">
                                    <span class="material-icons text-sm">cancel</span>
                                    <span>Batalkan</span>
                                </button>
                            </form>
                        </div>
                        @elseif($res->status_reservasi === 'confirmed')
                        <!-- Jika Sudah Lunas: Muncul Lencana Nota Valid -->
                        <div class="px-4 py-2 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-xl text-xs font-black uppercase tracking-wider flex items-center gap-1 cursor-default select-none shadow-2xs">
                            <span class="material-icons text-sm">verified_user</span> Siap Tanding
                        </div>
                        @else
                        <!-- Jika Status Dibatalkan (Cancelled): Muncul Lencana Abu-abu Netral -->
                        <div class="px-4 py-2 bg-gray-100 text-gray-400 border border-gray-200 rounded-xl text-xs font-black uppercase tracking-wider flex items-center gap-1 cursor-default select-none shadow-2xs">
                            <span class="material-icons text-sm">block</span> Sesi Batal
                        </div>
                        @endif
                        <!-- TAG DI ATAS ADALAH UTAS PENUTUP LOGIKA YANG SEBELUMNYA TERLEWAT -->

                    </div>

                </div> <!-- PENUTUP CARD INDIVIDU TIKET -->
                @empty
                <div class="rounded-3xl border border-dashed border-gray-200 bg-white p-12 text-center text-gray-400 font-medium shadow-2xs">
                    <span class="material-icons text-5xl text-gray-200 block mb-2">airplane_ticket</span>
                    Anda belum memiliki riwayat reservasi lapangan olahraga saat ini.
                </div>
                @endforelse


                @if($reservasis->isEmpty())
                <div class="rounded-3xl border border-dashed border-gray-200 bg-white p-12 text-center text-gray-400 font-medium shadow-2xs">
                    <span class="material-icons text-5xl text-gray-200 block mb-2">airplane_ticket</span>
                    Anda belum memiliki riwayat reservasi lapangan olahraga saat ini.
                </div>
                @endif
            </div>

            <!-- SISI KANAN (KOLOM 3): CARD INSTRUKSI PEMBAYARAN REKENING -->
            <div class="space-y-4">
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-xs space-y-4">
                    <h3 class="font-prompt text-sm font-black text-red-600 uppercase tracking-wider flex items-center gap-1.5 border-b border-gray-100 pb-2">
                        <span class="material-icons text-base">info</span> Panduan Konfirmasi Lunas
                    </h3>
                    <ol class="text-xs text-gray-500 space-y-2 list-decimal list-inside leading-relaxed font-medium">
                        <li>Lakukan transfer sesuai nominal tagihan tiket.</li>
                        <li>Gunakan rekening resmi sport center di bawah ini.</li>
                        <li>Foto atau screenshot struk bukti transfer m-banking.</li>
                        <li>Klik tombol <strong class="text-red-600">Upload Struk</strong> pada tiket Anda.</li>
                        <li>Tunggu status berubah hijau menjadi <strong class="text-emerald-600">Siap Tanding</strong>.</li>
                    </ol>

                    <!-- Daftar Nomor Rekening -->
                    <div class="space-y-2 pt-2 border-t border-gray-100">
                        <div class="bg-gray-50 border border-gray-100 p-3 rounded-xl">
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-wide block mb-0.5">Bank BCA</span>
                            <p class="font-mono font-bold text-gray-900 text-sm tracking-wide">123-456-7890</p>
                            <span class="text-[9px] text-gray-400 block mt-0.5 font-semibold">a.n. SM Sport Center</span>
                        </div>
                        <div class="bg-gray-50 border border-gray-100 p-3 rounded-xl">
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-wide block mb-0.5">Bank Mandiri</span>
                            <p class="font-mono font-bold text-gray-900 text-sm tracking-wide">987-654-3210</p>
                            <span class="text-[9px] text-gray-400 block mt-0.5 font-semibold">a.n. SM Sport Center</span>
                        </div>
                    </div>
                </div>
            </div> <!-- PENUTUP SISI KANAN -->

        </div>
    </div>
</section>
@endsection