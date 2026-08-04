@extends('layouts.app')

@section('content')
<section class="bg-white min-h-[70vh] px-6 py-6">
    <div class="mx-auto max-w-5xl rounded-3xl border border-gray-200 bg-gray-50 p-8 shadow-sm">

        <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Konfirmasi Reservasi</h1>
                <p class="mt-1 text-sm text-gray-600">Data profil Anda terisi otomatis. Silakan periksa kembali detail pesanan Anda.</p>
            </div>
            <!-- Karena wajib login, status selalu terverifikasi -->
            <span class="rounded-full bg-emerald-100 px-4 py-2 text-xs font-bold text-emerald-700 flex items-center gap-1.5">
                <i class="fa-solid fa-circle-check"></i> Akun Terverifikasi
            </span>
        </div>

        @if ($errors->any())
        <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('reservasi.submit') }}" class="mt-8 grid gap-6 md:grid-cols-2">
            @csrf

            <!-- Nama Lengkap (Readonly/Disabled karena diambil dari database user) -->
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" value="{{ $defaultData['nama'] }}" disabled class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-gray-500 cursor-not-allowed">
            </div>

            <!-- Email (Readonly) -->
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                <input type="email" value="{{ $defaultData['email'] }}" disabled class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-gray-500 cursor-not-allowed">
            </div>

            <!-- Nomor Telepon (Readonly) -->
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="text" value="{{ $defaultData['no_telepon'] }}" disabled class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-gray-500 cursor-not-allowed">
            </div>

            <!-- Pilihan Lapangan Dinamis -->
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Lapangan</label>
                <select name="lapangan_id" required class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2">
                    <option value="">Pilih lapangan</option>
                    @foreach($lapangans as $lap)
                    <option value="{{ $lap->id }}" {{ old('lapangan_id', $defaultData['lapangan_id']) == $lap->id ? 'selected' : '' }}>
                        {{ $lap->nama_lapangan }} (Rp {{ number_format($lap->harga_per_jam, 0, ',', '.') }} / Jam)
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Main -->
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Tanggal</label>
                <input name="tanggal" type="date" value="{{ old('tanggal', $defaultData['tanggal']) }}" required class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2">
            </div>

            <!-- Sesi Jam (Readonly agar tidak bisa dimanipulasi teksnya) -->
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Jam Sesi</label>
                <input name="jam" type="text" value="{{ old('jam', $defaultData['jam']) }}" readonly required class="w-full rounded-lg border border-gray-300 bg-gray-200 px-4 py-2 font-mono font-bold text-red-600">
            </div>

            <!-- Catatan -->
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Catatan Tambahan (Opsional)</label>
                <textarea name="catatan" rows="4" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2" placeholder="Tambahkan catatan khusus Anda (misal: sewa raket, rompi, dll.)">{{ old('catatan') }}</textarea>
            </div>

            <!-- KOTAK INSTRUKSI PEMBAYARAN TRANSFER RESMI -->
            <div class="rounded-2xl border border-red-100 bg-red-50/40 p-5 mt-6 space-y-3">
                <h3 class="font-prompt text-sm font-black text-red-600 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="material-icons text-base">payments</span> Informasi Rekening Pembayaran
                </h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Silakan lakukan transfer pembayaran lunas sesuai total biaya di atas ke salah satu rekening resmi SM Sport Center berikut:
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1 text-xs font-medium text-gray-700">
                    <!-- Rekening 1 -->
                    <div class="bg-white border border-gray-100 p-3 rounded-xl shadow-xs">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide block mb-0.5">Bank BCA</span>
                        <p class="font-mono font-bold text-gray-900 text-sm">123-456-7890</p>
                        <span class="text-[10px] text-gray-400 block mt-0.5">a.n. SM Sport Center</span>
                    </div>
                    <!-- Rekening 2 -->
                    <div class="bg-white border border-gray-100 p-3 rounded-xl shadow-xs">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide block mb-0.5">Bank Mandiri</span>
                        <p class="font-mono font-bold text-gray-900 text-sm">987-654-3210</p>
                        <span class="text-[10px] text-gray-400 block mt-0.5">a.n. SM Sport Center</span>
                    </div>
                </div>
                <p class="text-[10px] text-gray-400 font-medium italic pt-1">
                    *Catatan: Pastikan untuk menyimpan struk atau foto bukti transfer. Anda wajib mengunggah foto struk tersebut pada halaman Riwayat Pemesanan agar pesanan Anda disetujui Admin.
                </p>
            </div>

            <!-- Submit Button & Kembali -->
            <div class="flex flex-col sm:flex-row gap-4">
                <!-- Tombol Kembali Dinamis Menuju Detail Lapangan yang Dipilih -->
                <div class="w-full sm:w-auto">
                    <a href="{{ route('lapangan.detail', $defaultData['lapangan_id']) }}" class="w-full md:w-auto text-center block rounded-lg bg-gray-200 hover:bg-gray-300 px-6 py-3 font-semibold text-gray-700 transition">
                        Kembali
                    </a>
                </div>

                <div class="w-full sm:w-auto">
                    <button type="submit" class="w-full md:w-auto rounded-lg bg-red-600 px-6 py-3 font-semibold text-white hover:bg-red-700 transition">
                        Kirim Permohonan Reservasi
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection