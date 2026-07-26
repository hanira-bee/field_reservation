@extends('layouts.app')

@section('content')
<section class="min-h-[70vh] bg-gray-50 px-6 py-16">
    <div class="mx-auto max-w-md rounded-3xl border border-gray-200 bg-white p-8 shadow-sm">
        <h1 class="text-3xl font-bold text-gray-900">Daftar</h1>
        <p class="mt-2 text-sm text-gray-600">Buat akun untuk memudahkan reservasi Anda.</p>

        <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-4">
            @csrf
            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-red-500 focus:outline-none">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-red-500 focus:outline-none">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="no_telepon" class="mb-1 block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input id="no_telepon" name="no_telepon" type="text" value="{{ old('no_telepon') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-red-500 focus:outline-none">
                @error('no_telepon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-red-500 focus:outline-none">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-red-500 focus:outline-none">
            </div>

            <button type="submit" class="w-full rounded-lg bg-red-600 px-4 py-3 font-semibold text-white hover:bg-red-700">Daftar</button>
        </form>
    </div>
</section>
@endsection
