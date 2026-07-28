@extends('layouts.app')

@section('content')
<section class="min-h-[80vh] bg-gray-50 px-4 sm:px-6 py-6 flex items-center justify-center">
    <div class="w-full max-w-md rounded-3xl border border-gray-100 bg-white p-6 sm:p-10 shadow-md">

        <!-- HEADER FORM -->
        <div class="text-center sm:text-left mb-8">
            <h1 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">Daftar Akun</h1>
            <p class="mt-2 text-sm text-gray-500">Buat akun baru Anda untuk menikmati kemudahan sistem reservasi kami.</p>
        </div>

        <!-- FORMULIR REGISTRASI -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Input Nama Lengkap -->
            <div>
                <label for="name" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="w-full rounded-xl border @error('name') border-red-500 @else border-gray-300 @enderror px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
                @error('name')
                <p class="mt-1.5 text-xs font-semibold text-red-600 flex items-center gap-1">
                    <span class="material-icons text-sm">error</span> {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Input Alamat Email -->
            <div>
                <label for="email" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Alamat Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full rounded-xl border @error('email') border-red-500 @else border-gray-300 @enderror px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
                @error('email')
                <p class="mt-1.5 text-xs font-semibold text-red-600 flex items-center gap-1">
                    <span class="material-icons text-sm">error</span> {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Input Nomor Telepon -->
            <div>
                <label for="no_telepon" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor Telepon</label>
                <input id="no_telepon" name="no_telepon" type="text" value="{{ old('no_telepon') }}" required
                    class="w-full rounded-xl border @error('no_telepon') border-red-500 @else border-gray-300 @enderror px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all" placeholder="Contoh: 08123456789">
                @error('no_telepon')
                <p class="mt-1.5 text-xs font-semibold text-red-600 flex items-center gap-1">
                    <span class="material-icons text-sm">error</span> {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Input Kata Sandi / Password -->
            <div>
                <label for="password" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded-xl border @error('password') border-red-500 @else border-gray-300 @enderror px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
                @error('password')
                <p class="mt-1.5 text-xs font-semibold text-red-600 flex items-center gap-1">
                    <span class="material-icons text-sm">error</span> {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Input Konfirmasi Kata Sandi -->
            <div>
                <label for="password_confirmation" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
            </div>

            <!-- Opsi Navigasi Balik Ke Login -->
            <div class="text-right text-xs sm:text-sm pt-1">
                <span class="text-gray-500 font-medium">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="text-red-600 font-bold hover:text-red-700 hover:underline transition">Masuk di sini</a>
            </div>

            <!-- Tombol Kirim Pendaftaran -->
            <div class="pt-2">
                <button type="submit" class="w-full rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold py-3 shadow-xs transform hover:scale-[1.01] transition-all duration-150 uppercase tracking-wider text-xs sm:text-sm">
                    Buat Akun Baru
                </button>
            </div>
        </form>

    </div>
</section>
@endsection