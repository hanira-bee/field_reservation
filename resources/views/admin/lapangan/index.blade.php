@extends('layouts.admin')

@section('page_title', 'Kelola Lapangan')

@section('content')
<section class="bg-white">
    <!-- HEADER HALAMAN & TOMBOL TAMBAH -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Kelola Lapangan</h1>
            <p class="text-sm text-gray-800 font-normal">Manajemen inventaris, spesifikasi ukuran, harga sewa, dan status operasional arena.</p>
        </div>
        <!-- Tombol Tambah Lapangan Baru -->
        <div>
            <a href="{{ route('admin.lapangan.create') }}" class="font-rubik inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs sm:text-sm tracking-wide shadow-xs transition duration-150 transform hover:scale-102 uppercase">
                <span class="material-icons text-sm sm:text-base">add_box</span> Tambah Lapangan
            </a>
        </div>
    </div>

    <!-- NOTIFIKASI FLASH PESAN SUKSES -->
    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700 flex items-center gap-2">
            <span class="material-icons text-base">check_circle</span> {{ session('success') }}
        </div>
    @endif

    <!-- TABEL MANAJEMEN INVENTARIS LAPANGAN -->
    <div class="w-full overflow-x-auto border border-gray-100 rounded-2xl shadow-xs">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-800 text-xs font-bold uppercase tracking-wider border-b border-gray-200">
                    <th class="py-3 px-4 w-24">Foto</th>
                    <th class="py-3 px-4">Nama Lapangan</th>
                    <th class="py-3 px-4">Spesifikasi & Fasilitas</th>
                    <th class="py-3 px-4">Tarif Dasar</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                @forelse($lapangans as $lap)
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Mini Foto Lapangan -->
                        <td class="py-3 px-4">
                            <div class="w-20 aspect-video rounded-xl overflow-hidden bg-gray-100 border border-gray-100 shadow-xs">
                                @if($lap->gambar && file_exists(public_path('images/' . $lap->gambar)))
                                    <img src="{{ asset('images/' . $lap->gambar) }}" alt="Preview" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('images/futsal_outdoor.jpg') }}" alt="Default" class="w-full h-full object-cover">
                                @endif
                            </div>
                        </td>

                        <!-- Nama & Lokasi Arena -->
                        <td class="py-3 px-4">
                            <p class="font-bold text-gray-900 leading-none mb-1.5">{{ $lap->nama_lapangan }}</p>
                            <span class="text-xs font-bold bg-red-50 text-red-600 px-2 py-0.5 rounded-md uppercase border border-red-100">{{ $lap->jenis_lapangan }}</span>
                        </td>

                        <!-- Ukuran & Fasilitas -->
                        <td class="py-3 px-4 max-w-xs">
                            <p class="text-xs text-gray-900 font-bold flex items-center gap-1 mb-1">
                                <span class="material-icons text-xs text-gray-400">straighten</span> {{ $lap->ukuran ?? 'Belum disetel' }}
                            </p>
                            <p class="text-[11px] text-gray-400 leading-tight font-normal truncate" title="{{ $lap->fasilitas }}">
                                {{ $lap->fasilitas ?? 'Standar Arena' }}
                            </p>
                        </td>

                        <!-- Harga Sewa per Jam -->
                        <td class="py-3 px-4 font-black text-gray-900">
                            Rp {{ number_format($lap->harga_per_jam, 0, ',', '.') }}<span class="text-[10px] font-normal text-gray-400">/Jam</span>
                        </td>

                        <!-- Sakelar Status Aktif/Nonaktif Sementara -->
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('admin.lapangan.toggle-status', $lap->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider shadow-xs transition border cursor-pointer {{ $lap->status_aktif ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : 'bg-gray-100 text-gray-400 border-gray-200 hover:bg-gray-200' }}">
                                    {{ $lap->status_aktif ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>

                        <!-- Tombol Operasi Sunting & Hapus -->
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <!-- Tombol Sunting (Edit) -->
                                <a href="{{ route('admin.lapangan.edit', $lap->id) }}" class="p-2 bg-gray-50 border border-gray-200/60 hover:bg-blue-600 hover:border-blue-600 hover:text-white text-gray-500 rounded-xl transition flex items-center shadow-xs" title="Sunting Data">
                                    <span class="material-icons text-sm">edit</span>
                                </a>

                                <!-- Tombol Hapus Permanen (Destroy) dengan Konfirmasi JS -->
                                <form action="{{ route('admin.lapangan.destroy', $lap->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini secara permanen? Seluruh riwayat transaksi sewa terkait juga akan ikut terpengaruh.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-gray-50 border border-gray-200/60 hover:bg-red-600 hover:border-red-600 hover:text-white text-gray-400 rounded-xl transition flex items-center shadow-xs cursor-pointer" title="Hapus Lapangan">
                                        <span class="material-icons text-sm">delete_forever</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-gray-400 font-medium bg-gray-50/20">
                            <span class="material-icons text-4xl text-gray-200 block mb-2">layers_clear</span>
                            Belum ada inventaris lapangan yang terdaftar di database.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
