@extends('layouts.app')

@section('content')
<section class="bg-gray-50 min-h-[70vh] px-6 py-24">
    <div class="mx-auto max-w-6xl">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Daftar Lapangan</h1>
            <p class="mt-3 text-gray-600">Pilih lapangan favorit Anda untuk reservasi.</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($lapangans as $lapangan)
            @php
            $imageMap = [
            'Lapangan Futsal Outdoor' => 'futsal_outdoor.jpg',
            'Lapangan Futsal Indoor' => 'futsal_indoor.jpg',
            'Lapangan Badminton Outdoor' => 'badminton_outdoor1.jpg',
            'Lapangan Badminton Indoor 1' => 'badminton_indoor.jpg',
            'Lapangan Badminton Indoor 2' => 'badminton_indoor1.jpg',
            ];
            $image = $imageMap[$lapangan->nama_lapangan] ?? 'futsal_outdoor.jpg';
            @endphp
            <div class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm hover:shadow-xl transform hover:-translate-y-1 hover:scale-[1.01] transition-all duration-300 ease-in-out flex flex-col">
                <div class="h-40 bg-red-100">
                    <img src="{{ asset('images/' . $image) }}" alt="{{ $lapangan->nama_lapangan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                </div>
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors">{{ $lapangan->nama_lapangan }}</h2>
                    <p class="mt-2 text-sm text-gray-600 text-justify">{{ $lapangan->deskripsi }}</p>
                    <div class="flex justify-between mt-4">
                        <p class="mt-4 text-sm font-semibold text-red-600">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / jam</p>
                        <span class="head2 mt-4 text-red-600 text-xs font-bold uppercase flex items-center tracking-wider">
                            {{ $lapangan->jenis_lapangan }}
                        </span>
                    </div>

                    <a href="{{ route('lapangan.detail', $lapangan->id) }}" class="mt-4 px-4 py-2 w-full rounded-2xl text-white flex items-end justify-center bg-red-600 transform hover:bg-red-800 transition-colors duration-150 ease-in-out group cursor-pointer">
                        <button class="gap-2 font-semibold text-xs sm:text-sm hover:text-sm pointer-evemts-none translate-x-1 group-hover:opacity-100 group-hover:-translate-x-4 transition-all duration-200 ease-in-out">Lihat Detail
                        </button>
                        <span class="opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-200 ease-in-out">&rarr;</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection