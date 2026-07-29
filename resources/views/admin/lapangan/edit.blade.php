@extends('layouts.admin')

@section('page_title', 'Sunting Data Lapangan')

@section('content')
<section class="bg-white max-w-3xl">
    <!-- HEADER FORMULIR -->
    <div class="mb-6">
        <a href="{{ route('admin.lapangan.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-gray-400 hover:text-red-600 transition mb-3">
            <span class="material-icons text-sm">arrow_back</span> Kembali ke Daftar Lapangan
        </a>
        <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Sunting Lapangan</h1>
        <p class="text-sm text-gray-400 font-medium">Perbarui spesifikasi detail, harga sewa, atau foto arena olahraga yang tersimpan di dalam sistem.</p>
    </div>

    <!-- FORMULIR INPUT EDIT (Mengarah ke rute update berdasarkan ID) -->
    <form action="{{ route('admin.lapangan.update', $lapangan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5 border border-gray-100 rounded-3xl p-6 sm:p-8 bg-gray-50/30 shadow-xs">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Input 1: Nama Lapangan -->
            <div>
                <label for="nama_lapangan" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Lapangan</label>
                <input type="text" id="nama_lapangan" name="nama_lapangan" value="{{ old('nama_lapangan', $lapangan->nama_lapangan) }}" required
                       class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
                @error('nama_lapangan') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Input 2: Kategori / Jenis Olahraga -->
            <div>
                <label for="jenis_lapangan" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Kategori Olahraga</label>
                <select id="jenis_lapangan" name="jenis_lapangan" required
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all cursor-pointer">
                    <option value="Futsal" {{ old('jenis_lapangan', $lapangan->jenis_lapangan) == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                    <option value="Badminton" {{ old('jenis_lapangan', $lapangan->jenis_lapangan) == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                </select>
                @error('jenis_lapangan') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Input 3: Tarif Sewa per Jam -->
            <div>
                <label for="harga_per_jam" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Tarif Sewa (Rp / Jam)</label>
                <input type="number" id="harga_per_jam" name="harga_per_jam" value="{{ old('harga_per_jam', intval($lapangan->harga_per_jam)) }}" required
                       class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
                @error('harga_per_jam') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Input 4: Ukuran Spesifikasi Lapangan -->
            <div>
                <label for="ukuran" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Dimensi / Ukuran Lapangan</label>
                <input type="text" id="ukuran" name="ukuran" value="{{ old('ukuran', $lapangan->ukuran) }}"
                       class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
                @error('ukuran') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Input 5: Lokasi Alamat Lapangan -->
        <div>
            <label for="lokasi" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Lokasi / Alamat Lengkap Arena</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $lapangan->lokasi) }}" required
                   class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">
            @error('lokasi') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Input 6: Deskripsi Informasi -->
        <div>
            <label for="deskripsi" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Deskripsi Mengenai Lapangan</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">{{ old('deskripsi', $lapangan->deskripsi) }}</textarea>
            @error('deskripsi') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Input 7: Fasilitas Tersedia -->
        <div>
            <label for="fasilitas" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Fasilitas Penunjang Tersedia</label>
            <textarea id="fasilitas" name="fasilitas" rows="2" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-100 focus:outline-none transition-all">{{ old('fasilitas', $lapangan->fasilitas) }}</textarea>
            @error('fasilitas') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Input 8: Perbarui Berkas Foto Gambar Lapangan -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 items-center pt-2">
            <div class="sm:col-span-2">
                <label for="gambar" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Ganti Foto Arena (Opsional)</label>
                <input type="file" id="gambar" name="gambar" accept="image/*" onchange="bacaPreviewGambar(this)"
                       class="w-full text-xs font-bold text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:bg-red-50 file:text-red-700 hover:file:bg-red-100 file:cursor-pointer cursor-pointer">
                <p class="text-[10px] text-gray-400 mt-1.5">*Biarkan kosong jika tidak ingin mengubah foto. Format didukung: JPG, JPEG, PNG, WEBP maks 2MB.</p>
                @error('gambar') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <!-- Kotak Cuplikan Preview Gambar Instan (Otomatis memuat gambar lama terlebih dahulu) -->
            <div class="w-full aspect-video rounded-2xl border border-gray-200 bg-white overflow-hidden shadow-xs relative flex items-center justify-center text-center p-2">
                @if($lapangan->gambar && file_exists(public_path('images/' . $lapangan->gambar)))
                    <img id="preview-foto" src="{{ asset('images/' . $lapangan->gambar) }}" alt="Pratinjau Foto" class="w-full h-full object-cover">
                    <div id="teks-kosong" class="text-gray-400 flex flex-col items-center justify-center gap-1 hidden">
                        <span class="material-icons text-xl">insert_photo</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider">No Image</span>
                    </div>
                @else
                    <img id="preview-foto" src="" alt="Pratinjau Foto" class="w-full h-full object-cover hidden">
                    <div id="teks-kosong" class="text-gray-400 flex flex-col items-center justify-center gap-1">
                        <span class="material-icons text-xl">insert_photo</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider">No Image Selected</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- TOMBOL SIMPAN TRANSAKSI PEMBARUAN DATA -->
        <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
            <a href="{{ route('admin.lapangan.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-xs sm:text-sm font-bold text-gray-500 hover:bg-gray-100 transition shadow-xs text-center uppercase tracking-wider">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs sm:text-sm shadow-xs transition duration-150 uppercase tracking-wider flex items-center gap-1 cursor-pointer">
                <span class="material-icons text-sm sm:text-base">update</span> Perbarui Lapangan
            </button>
        </div>
    </form>
</section>

<!-- JAVASCRIPT LIVE PREVIEW IMAGE CONTROLLER -->
<script>
function bacaPreviewGambar(input) {
    const file = input.files[0];
    const preview = document.getElementById('preview-foto');
    const teksKosong = document.getElementById('teks-kosong');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            teksKosong.classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
