@extends('layouts.app')

@section('content')
<section class="min-h-[70vh] bg-gray-50 px-6 py-16">
    <div class="mx-auto max-w-6xl rounded-3xl border border-gray-200 bg-white p-8 shadow-sm">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="mt-2 text-gray-600">Area manajemen reservasi dan pengguna.</p>

        <div class="mt-8 grid gap-6 md:grid-cols-3">
            <div class="rounded-2xl border border-gray-200 bg-red-50 p-6">
                <p class="text-sm font-semibold text-red-600">Reservasi Hari Ini</p>
                <p class="mt-3 text-3xl font-bold text-gray-900">0</p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6">
                <p class="text-sm font-semibold text-gray-700">Total Pelanggan</p>
                <p class="mt-3 text-3xl font-bold text-gray-900">0</p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6">
                <p class="text-sm font-semibold text-gray-700">Lapangan Aktif</p>
                <p class="mt-3 text-3xl font-bold text-gray-900">0</p>
            </div>
        </div>
    </div>
</section>
@endsection
