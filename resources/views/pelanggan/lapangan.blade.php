@extends('layouts.app')

@section('content')
<section class="bg-gray-50 min-h-[70vh] px-6 py-6">
    <div class="mx-auto max-w-6xl">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Daftar Lapangan</h1>
            <p class="mt-3 text-gray-600">Pilih lapangan favorit Anda untuk reservasi.</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($lapangans as $lapangan)
            <div class="group overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm hover:shadow-xl transform hover:-translate-y-1 hover:scale-[1.01] transition-all duration-300 ease-in-out flex flex-col">

                <!-- SEKTOR GAMBAR OTOMATIS DATABASE (Menggunakan aspect-video agar ukuran sama rata) -->
                <div class="relative overflow-hidden aspect-video">
                    <!-- MEMPERBAIKI EROR: Mengganti $image menjadi $lapangan->gambar -->
                    @if(!empty($lapangan->gambar))
                    <!-- membaca file gambar dinamis yang diupload admin ke folder public/images -->
                    <img src="{{ asset('images/' . $lapangan->gambar) }}" alt="{{ $lapangan->nama_lapangan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                    @else
                    <!-- gambar cadangan jika admin mengosongkan foto saat input lapangan baru -->
                    <img src="{{ asset('images/banner-home1.jpg') }}" alt="Default Banner" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                    @endif
                </div>

                <!-- DETAIL INFORMASI LAPANGAN -->
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors">
                        {{ $lapangan->nama_lapangan }}
                    </h2>

                    <p class="text-sm text-gray-600 leading-relaxed mb-6 flex-grow text-justify">
                        {{ $lapangan->deskripsi }}
                    </p>

                    <!-- Info Harga & Jenis Olahraga -->
                    <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-50">
                        <p class="text-sm font-semibold text-emerald-600">
                            Rp {{ number_format($lapangan->harga_saat_ini ?? $lapangan->harga_per_jam, 0, ',', '.') }} / jam
                        </p>
                        <span class="head2 bg-red-50 text-red-600 text-[10px] font-bold uppercase px-2.5 py-1 rounded-full tracking-wider">
                            {{ $lapangan->jenis_lapangan }}
                        </span>
                    </div>

                    <!-- TOMBOL LIHAT DETAIL DENGAN ANIMASI PANAH AKURAT -->
                    <a href="{{ route('lapangan.detail', $lapangan->id) }}" class="mt-4 px-4 py-2.5 w-full rounded-2xl text-white flex items-center justify-center bg-red-600 hover:bg-red-800 transition-colors duration-150 ease-in-out group/btn cursor-pointer">
                        <button class="font-rubik flex items-center gap-2 font-semibold text-sm tracking-wide pointer-events-none">
                            <span>Lihat Detail</span>
                            <!-- Efek Panah Muncul dan Bergeser Halus saat Tombol Di-hover -->
                            <span class="opacity-0 -translate-x-2 group-hover/btn:opacity-100 group-hover/btn:translate-x-1 transition-all duration-200 ease-in-out">
                                &rarr;
                            </span>
                        </button>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection