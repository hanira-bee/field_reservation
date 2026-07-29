@extends('layouts.admin')

@section('page_title', 'Kelola Reservasi')

@section('content')
<section class="bg-white">
    <!-- HEADER HALAMAN -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Kelola Reservasi</h1>
            <p class="text-sm text-gray-400 font-medium">Setujui permohonan tanding atau batalkan jadwal sewa lapangan di bawah ini.</p>
        </div>
    </div>

    <!-- PESAN SUKSES -->
    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700 flex items-center gap-2">
            <span class="material-icons text-base">check_circle</span> {{ session('success') }}
        </div>
    @endif

    <!-- TAB PENYARING STATUS (FILTER TABS) -->
    <div class="flex gap-2 border-b border-gray-100 pb-3 mb-6 text-xs font-bold uppercase tracking-wider">
        <a href="{{ route('admin.reservasi.index') }}?status=pending" 
           class="px-4 py-2 rounded-xl transition {{ $statusFilter === 'pending' ? 'bg-red-50 text-red-600 border border-red-100' : 'text-gray-400 hover:bg-gray-50' }}">
            Baru Masuk (Pending)
        </a>
        <a href="{{ route('admin.reservasi.index') }}?status=confirmed" 
           class="px-4 py-2 rounded-xl transition {{ $statusFilter === 'confirmed' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'text-gray-400 hover:bg-gray-50' }}">
            Disetujui (Confirmed)
        </a>
    </div>

    <!-- TABEL DATA RESPONSIVE -->
    <div class="w-full overflow-x-auto border border-gray-100 rounded-2xl shadow-xs">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-400 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <th class="py-3 px-4">Pemesan</th>
                    <th class="py-3 px-4">Lapangan</th>
                    <th class="py-3 px-4">Waktu Bermain</th>
                    <th class="py-3 px-4">Total Biaya</th>
                    <th class="py-3 px-4 text-center">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                @forelse($reservasis as $res)
                    @php
                        // Menghitung jam selesai otomatis untuk kebutuhan template teks WA
                        $jamMulai = \Carbon\Carbon::parse($res->slot_jam)->format('H:i');
                        $isPaket2Jam = (float)$res->total_biaya > (float)$res->lapangan->harga_per_jam;
                        $jamSelesai = \Carbon\Carbon::parse($res->slot_jam)->addHours($isPaket2Jam ? 2 : 1)->format('H:i');
                        
                        // Pembuatan Link WhatsApp Template Kalimat Otomatis
                        $noWaBersih = preg_replace('/[^0-9]/', '', $res->user->no_telepon);
                        // Jika nomor dimulai angka 0, ubah ke kode negara indonesia 62
                        if(str_starts_with($noWaBersih, '0')) { $noWaBersih = '62' . substr($noWaBersih, 1); }

                        $teksPesan = "Halo *" . $res->user->name . "*, permohonan reservasi Anda di *SM Sport Center* untuk *" . $res->lapangan->nama_lapangan . "* pada tanggal *" . \Carbon\Carbon::parse($res->tgl_reservasi)->format('d M Y') . "* jam *" . $jamMulai . " - " . $jamSelesai . "* telah ";
                        
                        $linkWaSetuju = "https://wa.me" . $noWaBersih . "?text=" . urlencode($teksPesan . "*DISETUJUI*. Silakan datang tepat waktu membawa kelengkapan olahraga Anda. Terima kasih!");
                        $linkWaBatal = "https://wa.me" . $noWaBersih . "?text=" . urlencode($teksPesan . "*TERPAKSA DIBATALKAN* karena alasan pemeliharaan teknis arena. Kami memohon maaf atas ketidaknyamanan ini.");
                    @endphp

                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Kolom Pemesan -->
                        <td class="py-4 px-4">
                            <p class="font-bold text-gray-900 leading-none mb-1">{{ $res->user->name }}</p>
                            <span class="text-xs text-gray-400 font-normal block">{{ $res->user->email }}</span>
                        </td>
                        <!-- Kolom Lapangan -->
                        <td class="py-4 px-4 text-gray-600">
                            {{ $res->lapangan->nama_lapangan }}
                        </td>
                        <!-- Kolom Waktu -->
                        <td class="py-4 px-4">
                            <p class="text-gray-900 text-xs font-bold flex items-center gap-1"><span class="material-icons text-xs text-gray-400">calendar_today</span> {{ \Carbon\Carbon::parse($res->tgl_reservasi)->format('d/m/Y') }}</p>
                            <span class="text-[11px] font-mono font-bold text-red-600 bg-red-50 border border-red-100 px-2 py-0.5 rounded-md inline-block mt-1">{{ $jamMulai }} - {{ $jamSelesai }}</span>
                        </td>
                        <!-- Kolom Biaya -->
                        <td class="py-4 px-4 font-black text-emerald-600">
                            Rp {{ number_format($res->total_biaya, 0, ',', '.') }}
                        </td>
                        <!-- Kolom Aksi Form -->
                        <td class="py-4 px-4">
                            <div class="flex items-center justify-center gap-2">
                                @if($res->status_reservasi === 'pending')
                                    <!-- Form Setuju -->
                                    <form action="{{ route('admin.reservasi.update', $res->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status_reservasi" value="confirmed">
                                        <button type="submit" class="p-2 bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white rounded-xl transition flex items-center shadow-xs" title="Setujui Booking">
                                            <span class="material-icons text-sm">check</span>
                                        </button>
                                    </form>

                                    <!-- Form Batal -->
                                    <form action="{{ route('admin.reservasi.update', $res->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status_reservasi" value="cancelled">
                                        <button type="submit" class="p-2 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white rounded-xl transition flex items-center shadow-xs" title="Batalkan Booking">
                                            <span class="material-icons text-sm">close</span>
                                        </button>
                                    </form>
                                @endif

                                <!-- Tombol Kirim WhatsApp Dinamis -->
                                <a href="{{ $res->status_reservasi === 'confirmed' ? $linkWaSetuju : $linkWaBatal }}" 
                                   target="_blank" 
                                   class="p-2 bg-gray-50 hover:bg-emerald-500 text-gray-400 hover:text-white rounded-xl transition flex items-center border border-gray-200/60 shadow-xs" 
                                   title="Kirim Pesan WhatsApp">
                                    <i class="fab fa-whatsapp text-sm"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400 font-medium bg-gray-50/20">
                            <span class="material-icons text-4xl text-gray-200 block mb-2">inbox</span>
                            Tidak ada data reservasi berstatus '{{ $statusFilter }}' saat ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
