@extends('layouts.app')

@section('content')
<section class="min-h-[85vh] bg-red-600 px-4 sm:px-8 py-24">
    <div class="max-w-2xl mx-auto space-y-6">
        
        <!-- HEADER HALAMAN -->
        <div class="border-b border-gray-200 pb-4 bg-white px-6 py-8 rounded-xl">
            <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Pengaturan Profil</h1>
            <p class="text-sm text-gray-600 font-normal mt-1">Perbarui data diri, nomor kontak WhatsApp, atau ubah kata sandi akun Anda secara berkala.</p>
        </div>

        <!-- NOTIFIKASI FLASH SUKSES -->
        @if(session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700 flex items-center gap-2">
                <span class="material-icons text-base">check_circle</span> {{ session('success') }}
            </div>
        @endif

        <!-- FORMULIR EDIT PROFIL -->
        <form action="{{ route('pelanggan.profil.update') }}" method="POST" class="bg-white border border-gray-100 rounded-3xl p-6 sm:p-8 shadow-xs space-y-5">
            @csrf
            @method('PUT')

            <!-- Input 1: Nama Lengkap -->
            <div>
                <label for="name" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-100 transition-all">
                @error('name') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Input 2: Alamat Email -->
            <div>
                <label for="email" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-100 transition-all">
                @error('email') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Input 3: Nomor Telepon / WhatsApp -->
            <div>
                <label for="no_telepon" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor WhatsApp</label>
                <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}" required
                       class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-100 transition-all">
                @error('no_telepon') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- SEKTOR PENGGANTIAN PASSWORD (OPSIONAL) -->
            <div class="pt-4 border-t border-gray-100 space-y-4">
                <p class="text-xs font-bold text-gray-600 uppercase tracking-widest">Ubah Kata Sandi (Opsional)</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Password Baru -->
                    <div>
                        <label for="password" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Password Baru</label>
                        <input type="password" id="password" name="password" placeholder="Minimal 8 karakter"
                               class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-100 transition-all">
                        @error('password') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <!-- Konfirmasi Password Baru -->
                    <div>
                        <label for="password_confirmation" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru"
                               class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-100 transition-all">
                    </div>
                </div>
                <p class="text-[10px] text-gray-400 font-medium italic">*Kosongkan kedua kolom di atas jika Anda tidak ingin mengganti kata sandi akun saat ini.</p>
            </div>

            <!-- TOMBOL AKSI SUBMIT -->
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-xs font-bold text-gray-500 hover:bg-gray-100 transition shadow-xs uppercase tracking-wider text-center">Batal</a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-xs transition duration-150 uppercase tracking-wider flex items-center gap-1 cursor-pointer">
                    <span class="material-icons text-sm">save</span> Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</section>
@endsection
