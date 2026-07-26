@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden min-h-[70vh] h-screen text-white text-center">
    <div class="absolute inset-0">
        <img src="{{ asset('images/banner-home1.jpg') }}" alt="Sport Banner" class="fixed inset-0 w-full h-full object-cover -z-10">
        <div class="fixed inset-0 bg-black/40 -z-10"></div>
    </div>

    <div class="relative z-10 flex min-h-[70vh] flex-col items-center justify-center px-6 py-32 text-center">
        <h1 class="text-4xl font-extrabold text-white drop-shadow-lg sm:text-5xl">
            Pengalaman olahraga yang lebih baik
        </h1>
        <p class="mt-4 max-w-2xl text-lg text-gray-200">
            Bangun kesehatan dan gaya hidupmu dengan fasilitas modern dan pengalaman terbaik.
        </p>
        <div class="mt-6 flex flex-wrap justify-center gap-4">
            <a href="#" class="btn px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-800 transition">
                Mulai
            </a>
            <a href="#" class="btn px-6 py-3 bg-white text-red-600 font-semibold rounded-lg shadow hover:bg-gray-200 transition">
                Pelajari
            </a>
        </div>
    </div>
</section>

<section class="h-fit w-full bg-red-600 py-10">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-white">Layanan Kami</h2>
        <p class="mt-2 text-lg text-white">
            Berbagai fasilitas untuk mendukung aktivitas olahraga Anda
        </p>
    </div>
    <div class="grid grid-cols-1 gap-8 px-8 md:grid-cols-2">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <i class="fas fa-futbol text-red-600 text-3xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Lapangan Futsal</h3>
            <p class="text-gray-600">Amankan slot waktu Anda dan rasakan atmosfer pertandingan futsal yang kompetitif bersama tim.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <i class="fas fa-table-tennis-paddle-ball text-red-600 text-3xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Lapangan Badminton</h3>
            <p class="text-gray-600">Pesan lapangan bulu tangkis pilihan Anda sekarang dan jadwalkan pertandingan terbaik minggu ini.</p>
        </div>
    </div>

    <div class="flex justify-center p-10">
        <a href="#" class="btn animate-bounce hover:animate-none px-6 py-3 bg-white text-lg text-red-600 font-semibold rounded-full shadow border-2 border-red-100 transform hover:scale-110 transition-all duration-150 ease-in-out">
            Reservasi
        </a>
    </div>
</section>

<section class="bg-gray-50 h-fit w-full mx-auto py-16">
    <div class="text-center mb-12">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight mb-3">Pilihan Lapangan Terbaik Kami</h2>
        <p class="text-md text-gray-500 font-normal max-w-xl mx-auto">
            Temukan dan pesan lapangan premium standar turnamen yang siap mendukung performa olahraga terbaik Anda.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-2 lg:grid-cols-3 lg:p-10">
        @forelse ($lapangans as $lapangan)
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

            <a href="#" class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transform hover:-translate-y-1 hover:scale-[1.01] transition-all duration-300 ease-in-out flex flex-col">
                <div class="relative overflow-hidden aspect-video">
                    <img src="{{ asset('images/' . $image) }}" alt="{{ $lapangan->nama_lapangan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                    <span class="head2 absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                        {{ $lapangan->jenis_lapangan }}
                    </span>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors">
                        {{ $lapangan->nama_lapangan }}
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                        {{ $lapangan->deskripsi }}
                    </p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                        <span class="head3 text-sm font-semibold text-emerald-600">
                            Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / Jam
                        </span>
                        <span class="head3 text-md font-bold text-red-600 flex items-center gap-1">Detail <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span></span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-gray-300 bg-white p-8 text-center text-gray-500">
                Belum ada lapangan yang tersedia saat ini.
            </div>
        @endforelse
    </div>
</section>
@endsection