@extends('layouts.admin')

@section('page_title', 'Laporan Keuangan & Omzet')

@section('content')
<section class="bg-white space-y-6">
    
    <!-- HEADER HALAMAN & TOMBOL CETAK PDF -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-100 pb-4">
        <div>
            <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Laporan Keuangan</h1>
            <p class="text-sm text-gray-800 font-normal">Pencatatan riwayat omzet, akumulasi kas masuk, dan filter pembukuan bulanan.</p>
        </div>
        
        <!-- Tombol Download Cetak PDF Resmi -->
        <div>
            <a href="{{ route('admin.laporan.pdf') }}?bulan={{ $bulanDipilih }}&tahun={{ $tahunDipilih }}" 
               class="font-rubik inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs sm:text-sm tracking-wide shadow-xs transition duration-150 transform hover:scale-102 uppercase">
                <span class="material-icons text-sm sm:text-base">picture_as_pdf</span> Unduh Rekap PDF
            </a>
        </div>
    </div>

    <!-- PANEL FILTER CARI BULAN & TAHUN -->
    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-4 sm:p-5">
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="flex flex-col sm:flex-row items-end gap-4 text-xs font-bold uppercase tracking-wider text-gray-700">
            <!-- Filter 1: Pilih Bulan -->
            <div class="w-full sm:w-48">
                <label for="bulan" class="mb-1.5 block text-gray-500">Pilih Periode Bulan</label>
                <select id="bulan" name="bulan" class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm font-semibold focus:border-red-500 focus:outline-none cursor-pointer">
                    @php
                        $namaBulan = [
                            '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
                            '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'
                        ];
                    @endphp
                    @foreach($namaBulan as $val => $nama)
                        <option value="{{ $val }}" {{ $bulanDipilih == $val ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter 2: Pilih Tahun -->
            <div class="w-full sm:w-36">
                <label for="tahun" class="mb-1.5 block text-gray-500">Pilih Tahun</label>
                <select id="tahun" name="tahun" class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm font-semibold focus:border-red-500 focus:outline-none cursor-pointer">
                    @for($t = date('Y'); $t >= date('Y') - 3; $t--)
                        <option value="{{ $t }}" {{ $tahunDipilih == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endfor
                </select>
            </div>

            <!-- Tombol submit filter cari -->
            <div class="w-full sm:w-auto">
                <button type="submit" class="w-full sm:w-auto bg-gray-900 hover:bg-red-600 text-white font-bold px-6 py-2.5 rounded-xl text-sm transition duration-150 uppercase tracking-wide cursor-pointer flex items-center justify-center gap-1">
                    <span class="material-icons text-sm">filter_alt</span> Filter
                </button>
            </div>

            <!-- RINGKASAN OMZET TOTAL (SEKTOR KANAN PANEL FILTER) -->
            <div class="w-full sm:w-auto ml-auto text-right pb-1">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Akumulasi Pendapatan</p>
                <p class="text-xl font-black text-emerald-600">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
            </div>
        </form>
    </div>

    <!-- TABEL OMZET RIWAYAT TRANSAKSI KAS MASUK -->
    <div class="w-full overflow-x-auto border border-gray-100 rounded-2xl shadow-xs">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-800 text-xs font-bold uppercase tracking-wider border-b border-gray-200">
                    <th class="py-3 px-4">Tanggal Sewa</th>
                    <th class="py-3 px-4">Nama Pelanggan</th>
                    <th class="py-3 px-4">Arena Lapangan</th>
                    <th class="py-3 px-4 text-center">Durasi Sesi</th>
                    <th class="py-3 px-4 text-right">Nominal Pendapatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                @forelse($transaksis as $t)
                    @php
                        // Deteksi durasi dari nominal harga dasar
                        $isPaket2Jam = (float)$t->total_biaya > (float)$t->lapangan->harga_per_jam;
                        $jamMulai = \Carbon\Carbon::parse($t->slot_jam)->format('H:i');
                        $jamSelesai = \Carbon\Carbon::parse($t->slot_jam)->addHours($isPaket2Jam ? 2 : 1)->format('H:i');
                    @endphp
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Tanggal -->
                        <td class="py-3.5 px-4 text-xs font-bold text-gray-900">
                            {{ \Carbon\Carbon::parse($t->tgl_reservasi)->format('d M Y') }}
                        </td>
                        <!-- Pelanggan -->
                        <td class="py-3.5 px-4 text-gray-600">
                            {{ $t->user->name }}
                        </td>
                        <!-- Lapangan -->
                        <td class="py-3.5 px-4">
                            <span class="text-xs font-bold text-gray-800">{{ $t->lapangan->nama_lapangan }}</span>
                        </td>
                        <!-- Sesi Jam -->
                        <td class="py-3.5 px-4 text-center">
                            <span class="text-[10px] font-mono font-bold bg-gray-50 border border-gray-200 text-gray-500 px-2 py-0.5 rounded-md inline-block">
                                {{ $jamMulai }} - {{ $jamSelesai }} ({{ $isPaket2Jam ? '2 Jam' : '1 Jam' }})
                            </span>
                        </td>
                        <!-- Nominal Biaya / Omzet -->
                        <td class="py-3.5 px-4 text-right font-black text-emerald-600">
                            Rp {{ number_format($t->total_biaya, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400 font-medium bg-gray-50/20">
                            <span class="material-icons text-4xl text-gray-200 block mb-2">trending_flat</span>
                            Tidak ada catatan transaksi finansial pada periode bulan berjalan ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
