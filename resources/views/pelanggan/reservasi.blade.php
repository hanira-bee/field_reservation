@extends('layouts.app')

@section('content')
<section class="bg-white min-h-[70vh] px-6 py-16">
    <div class="mx-auto max-w-5xl rounded-3xl border border-gray-200 bg-gray-50 p-8 shadow-sm">
        <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Reservasi Lapangan</h1>
                <p class="mt-3 text-gray-600">Tamu dapat mengisi data manual, sementara pelanggan yang sudah login akan melihat data profil terisi otomatis.</p>
            </div>
            @auth
                <span class="rounded-full bg-red-100 px-4 py-2 text-sm font-semibold text-red-700">Mode akun terautentikasi</span>
            @else
                <span class="rounded-full bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700">Mode tamu</span>
            @endauth
        </div>

        @if (session('success'))
            <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('reservasi.submit') }}" class="mt-8 grid gap-6 md:grid-cols-2">
            @csrf

            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input name="nama" type="text" value="{{ old('nama', $defaultData['nama'] ?? '') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                <input name="email" type="email" value="{{ old('email', $defaultData['email'] ?? '') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input name="no_telepon" type="text" value="{{ old('no_telepon', $defaultData['no_telepon'] ?? '') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Lapangan</label>
                <select name="lapangan" required class="w-full rounded-lg border border-gray-300 px-4 py-2">
                    <option value="">Pilih lapangan</option>
                    <option value="Futsal Indoor" {{ old('lapangan') === 'Futsal Indoor' ? 'selected' : '' }}>Futsal Indoor</option>
                    <option value="Badminton Indoor" {{ old('lapangan') === 'Badminton Indoor' ? 'selected' : '' }}>Badminton Indoor</option>
                    <option value="Futsal Outdoor" {{ old('lapangan') === 'Futsal Outdoor' ? 'selected' : '' }}>Futsal Outdoor</option>
                </select>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Tanggal</label>
                <input name="tanggal" type="date" value="{{ old('tanggal') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Jam</label>
                <input name="jam" type="text" value="{{ old('jam') }}" placeholder="Contoh: 19:00 - 20:00" required class="w-full rounded-lg border border-gray-300 px-4 py-2">
            </div>

            <div class="md:col-span-2">
                <label class="mb-1 block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" rows="4" class="w-full rounded-lg border border-gray-300 px-4 py-2" placeholder="Tambahkan catatan atau kebutuhan khusus Anda.">{{ old('catatan') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <button type="submit" class="rounded-lg bg-red-600 px-6 py-3 font-semibold text-white hover:bg-red-700">Kirim Reservasi</button>
            </div>
        </form>
    </div>
</section>
@endsection
