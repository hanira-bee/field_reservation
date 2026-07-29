@extends('layouts.admin')

@section('page_title', 'Kelola Reservasi')

@section('content')
<section class="bg-white">
    <!-- HEADER HALAMAN -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Kelola Reservasi</h1>
            <p class="text-sm text-gray-800 font-normal">Validasi bukti transfer pelanggan, setujui jadwal bermain, atau batalkan sesi sewa.</p>
        </div>
    </div>

    <!-- NOTIFIKASI ALERTS BANNER -->
    @if(session('success'))
    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700 flex items-center gap-2">
        <span class="material-icons text-base">check_circle</span> {{ session('success') }}
    </div>
    @endif

    <!-- TAB PENYARING STATUS (FILTER TABS) -->
    <div class="flex gap-2 border-b border-gray-100 pb-3 mb-6 text-xs font-bold uppercase tracking-wider">
        <a href="{{ route('admin.reservasi.index') }}?status=pending"
            class="px-4 py-2 rounded-xl transition-all duration-150 {{ $statusFilter === 'pending' ? 'bg-red-50 text-red-600 border border-red-100 shadow-3xs' : 'text-gray-600 hover:bg-gray-50' }}">
            Baru Masuk (Pending)
        </a>
        <a href="{{ route('admin.reservasi.index') }}?status=confirmed"
            class="px-4 py-2 rounded-xl transition-all duration-150 {{ $statusFilter === 'confirmed' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100 shadow-3xs' : 'text-gray-600 hover:bg-gray-50' }}">
            Disetujui (Confirmed)
        </a>
        <a href="{{ route('admin.reservasi.index') }}?status=cancelled"
            class="px-4 py-2 rounded-xl transition-all duration-150 {{ $statusFilter === 'cancelled' ? 'bg-gray-900 text-white border border-gray-900 shadow-3xs' : 'text-gray-600 hover:bg-gray-50' }}">
            Dibatalkan (Cancelled)
        </a>

    </div>

    <!-- TABEL DATA RESPONSIVE -->
    <div class="w-full overflow-x-auto border border-gray-100 rounded-2xl shadow-3xs bg-white">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-800 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <th class="py-3 px-4">Pelanggan</th>
                    <th class="py-3 px-4">Arena Lapangan</th>
                    <th class="py-3 px-4">Waktu Tanding</th>
                    <th class="py-3 px-4">Total Biaya</th>
                    <th class="py-3 px-4 text-center">Tindakan & Validasi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                @forelse($reservasis as $res)
                @php
                // Menghitung jam selesai bermain secara otomatis
                $isPaket2Jam = (float)$res->total_biaya > (float)$res->lapangan->harga_per_jam;
                $jamMulai = \Carbon\Carbon::parse($res->slot_jam)->format('H:i');
                $jamSelesai = \Carbon\Carbon::parse($res->slot_jam)->addHours($isPaket2Jam ? 2 : 1)->format('H:i');

                // Sistem Generator Pesan WhatsApp Otomatis
                $noWaBersih = preg_replace('/[^0-9]/', '', $res->user->no_telepon);
                if(str_starts_with($noWaBersih, '0')) { $noWaBersih = '62' . substr($noWaBersih, 1); }

                $teksPesan = "Halo *" . $res->user->name . "*, permohonan reservasi Anda di *SM Sport Center* untuk *" . $res->lapangan->nama_lapangan . "* pada tanggal *" . \Carbon\Carbon::parse($res->tgl_reservasi)->format('d M Y') . "* jam *" . $jamMulai . " - " . $jamSelesai . "* telah ";

                $linkWaSetuju = "https://wa.me" . $noWaBersih . "?text=" . urlencode($teksPesan . "*DISETUJUI*. Silakan datang tepat waktu membawa kelengkapan olahraga Anda. Terima kasih!");
                $linkWaBatal = "https://wa.me" . $noWaBersih . "?text=" . urlencode($teksPesan . "*TERPAKSA DIBATALKAN* karena alasan teknis operasional harian arena. Kami memohon maaf atas ketidaknyamanan ini.");
                @endphp

                <tr class="hover:bg-gray-50/50 transition">
                    <!-- Kolom 1: Profil Identitas Pelanggan -->
                    <td class="py-4 px-4">
                        <p class="font-bold text-gray-900 leading-none mb-1">{{ $res->user->name }}</p>
                        <span class="text-xs font-mono text-gray-400 font-normal block">#{{ $res->kode_booking }}</span>
                    </td>

                    <!-- Kolom 2: Informasi Lapangan -->
                    <td class="py-4 px-4 text-gray-600 font-semibold">
                        {{ $res->lapangan->nama_lapangan }}
                    </td>

                    <!-- Kolom 3: Waktu Tanggal & Jam Bermain -->
                    <td class="py-4 px-4">
                        <p class="text-gray-900 text-xs font-bold flex items-center gap-1"><span class="material-icons text-xs text-gray-400">calendar_today</span> {{ \Carbon\Carbon::parse($res->tgl_reservasi)->format('d/m/Y') }}</p>
                        <span class="text-[11px] font-mono font-bold text-red-600 bg-red-50 border border-red-100 px-2 py-0.5 rounded-md inline-block mt-1">{{ $jamMulai }} - {{ $jamSelesai }}</span>
                    </td>

                    <!-- Kolom 4: Nominal Biaya Sewa -->
                    <td class="py-4 px-4 font-black text-emerald-600">
                        Rp {{ number_format($res->total_biaya, 0, ',', '.') }}
                    </td>

                    <!-- Kolom 5: Tombol Validasi Struk Fisik & Aksi Pengunci (Disesuaikan untuk 3 Status) -->
                    <td class="py-4 px-4">
                        <div class="flex items-center justify-center gap-2">

                            @if($statusFilter === 'cancelled')
                            <!-- JIKA TAB CANCELLED DIAKTIFKAN: Munculkan Lencana Netral Hitam Abu-abu -->
                            <span class="px-3 py-1.5 bg-gray-100 text-gray-500 border border-gray-200 rounded-xl text-[10px] font-black uppercase tracking-wider flex items-center gap-1 select-none">
                                <span class="material-icons text-xs">block</span> Void Session
                            </span>
                            @else
                            <!-- JIKA TAB PENDING / CONFIRMED DIAKTIFKAN: Jalankan Aturan Struk Normal Seperti Kemarin -->
                            @if($res->bukti_pembayaran)
                            <a href="{{ asset('images/bukti_transfer/' . $res->bukti_pembayaran) }}"
                                target="_blank"
                                class="px-2.5 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl text-xs font-black uppercase tracking-wider flex items-center gap-1 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition shadow-3xs"
                                title="Buka berkas struk transfer">
                                <span class="material-icons text-sm">receipt_long</span> Struk Ada
                            </a>
                            @else
                            <span class="px-2.5 py-1.5 bg-gray-50 text-gray-400 border border-gray-200 rounded-xl text-xs font-black uppercase tracking-wider flex items-center gap-1 cursor-default select-none">
                                <span class="material-icons text-sm">hourglass_empty</span> Belum Bayar
                            </span>
                            @endif
                            @endif

                            <!-- PEMBATAS SEKTOR EKSEKUSI TOMBOL SETUJU / TOLAK -->
                            <div class="flex items-center gap-1 border-l border-gray-100 pl-2 ml-1">
                                @if($res->status_reservasi === 'pending')
                                <!-- Tombol Centang Hijau Setuju -->
                                <form action="{{ route('admin.reservasi.update', $res->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status_reservasi" value="confirmed">
                                    <button type="submit" class="p-2 bg-gray-50 border border-gray-200 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-xl transition flex items-center shadow-xs cursor-pointer"><span class="material-icons text-sm">check</span></button>
                                </form>

                                <!-- Tombol Silang Merah Batal -->
                                <form action="{{ route('admin.reservasi.update', $res->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status_reservasi" value="cancelled">
                                    <button type="submit" class="p-2 bg-gray-50 border border-gray-200 text-red-600 hover:bg-red-600 hover:text-white rounded-xl transition flex items-center shadow-xs cursor-pointer"><span class="material-icons text-sm">close</span></button>
                                </form>
                                @endif

                                <!-- Tombol Pesan WA Kirim Log Hubungi (Hanya muncul jika status bukan cancelled) -->
                                @if($res->status_reservasi !== 'cancelled')
                                <a href="{{ $res->status_reservasi === 'confirmed' ? $linkWaSetuju : $linkWaBatal }}" target="_blank" class="p-2 bg-gray-50 hover:bg-emerald-500 text-gray-400 hover:text-white rounded-xl transition flex items-center border border-gray-200 shadow-xs"><i class="fab fa-whatsapp text-sm"></i></a>
                                @endif
                            </div>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-gray-400 font-medium bg-gray-50/20">
                        <span class="material-icons text-4xl text-gray-200 block mb-2">inbox</span>
                        Tidak ada permohonan sewa arena olahraga berstatus '{{ $statusFilter }}' saat ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection