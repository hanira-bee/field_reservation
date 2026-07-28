@extends('layouts.app')

@section('content')
<section class="min-h-[80vh] bg-gray-50 px-4 sm:px-6 py-6 flex items-center justify-center">
    <div class="w-full max-w-md rounded-3xl border border-gray-100 bg-white p-6 sm:p-10 shadow-md">

        <!-- HEADER FORM -->
        <div class="text-center sm:text-left mb-8">
            <h1 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">Masuk</h1>
            <p class="mt-2 text-sm text-gray-500">Silakan masuk untuk melanjutkan reservasi dan mengakses akun Anda.</p>
        </div>

        <!-- FORMULIR LOGIN -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Input Alamat Email -->
            <div>
                <label for="email" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Alamat Email</label>
                <div class="relative">
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="w-full rounded-xl border @error('email') border-red-500 @else border-gray-300 @enderror px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
                </div>
                @error('email')
                <p class="mt-1.5 text-xs font-semibold text-red-600 flex items-center gap-1">
                    <span class="material-icons text-sm">error</span> {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Input Kata Sandi / Password -->
            <div>
                <label for="password" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
            </div>

            <!-- Opsi Tambahan Form (Remember me & Link Daftar) -->
            <div class="flex items-center justify-between text-xs sm:text-sm pt-1">
                <label class="flex items-center gap-2 text-gray-600 font-medium cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
                    Ingat saya
                </label>
                <a href="{{ route('register') }}" class="text-red-600 font-bold hover:text-red-700 hover:underline transition">Belum punya akun?</a>
            </div>

            <!-- Tombol Submit Masuk -->
            <div class="pt-2">
                <button type="submit" class="w-full rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold py-3 shadow-xs transform hover:scale-[1.01] transition-all duration-150 uppercase tracking-wider text-xs sm:text-sm">
                    Masuk ke Akun
                </button>
            </div>
        </form>

    </div>
</section>
@endsection