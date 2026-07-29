@extends('layouts.admin')

@section('page_title', 'Tambah Staf Admin Baru')

@section('content')
<section class="bg-white max-w-2xl">
    <!-- HEADER FORMULIR -->
    <div class="mb-6">
        <a href="{{ route('admin.akun.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-gray-400 hover:text-red-600 transition mb-3">
            <span class="material-icons text-sm">arrow_back</span> Kembali ke Daftar Akun
        </a>
        <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Tambah Staf Admin</h1>
        <p class="text-sm text-gray-400 font-medium">Daftarkan akun staf pengurus baru. Akun yang dibuat di sini otomatis memiliki hak akses sebagai administrator internal.</p>
    </div>

    <!-- FORMULIR INPUT PEMBUATAN AKUN STAF -->
    <form action="{{ route('admin.akun.store') }}" method="POST" class="space-y-5 border border-gray-100 rounded-3xl p-6 sm:p-8 bg-gray-50/30 shadow-xs">
        @csrf

        <!-- Input 1: Nama Lengkap Staf -->
        <div>
            <label for="name" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Lengkap Staf</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Ahmad Subagja"
                   class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
            @error('name') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Input 2: Alamat Email Resmi -->
        <div>
            <label for="email" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Alamat Email Resmi</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Contoh: ahmad.staf@smsport.com"
                   class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
            @error('email') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Input 3: Nomor Telepon / WhatsApp Staf -->
        <div>
            <label for="no_telepon" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor Telepon / WhatsApp Staf</label>
            <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required placeholder="Contoh: 08123456789"
                   class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
            @error('no_telepon') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Input 4: Password Akun -->
            <div>
                <label for="password" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Password Kontrol</label>
                <input type="password" id="password" name="password" required placeholder="Minimal 8 Karakter"
                       class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
                @error('password') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Input 5: Konfirmasi Ulang Password -->
            <div>
                <label for="password_confirmation" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi Password"
                       class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
            </div>
        </div>

        <!-- TOMBOL AKSI PEMBUATAN AKUN -->
        <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
            <a href="{{ route('admin.akun.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-xs sm:text-sm font-bold text-gray-500 hover:bg-gray-100 transition shadow-xs text-center uppercase tracking-wider">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs sm:text-sm shadow-xs transition duration-150 uppercase tracking-wider flex items-center gap-1 cursor-pointer">
                <span class="material-icons text-sm sm:text-base">add_moderator</span> Daftarkan Staf
            </button>
        </div>
    </form>
</section>
@endsection
