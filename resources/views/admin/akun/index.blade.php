@extends('layouts.admin')

@section('page_title', 'Kelola Akun Staf & Pengguna')

@section('content')
<section class="bg-white space-y-12">
    
    <!-- HEADER PANEL UTAMA -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-100 pb-4">
        <div>
            <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Kelola Akun</h1>
            <p class="text-sm text-gray-800 font-normal">Manajemen hak akses terpisah antara Direksi Super Admin, Staf Operasional, dan Pelanggan.</p>
        </div>
        <!-- Tombol Tambah internal hanya muncul jika yang sedang login ber-role Super Admin -->
        @if($saatIni->role === 'super_admin')
            <div>
                <a href="{{ route('admin.akun.create') }}" class="font-rubik inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs sm:text-sm tracking-wide shadow-xs transition uppercase">
                    <span class="material-icons text-sm sm:text-base">person_add</span> Tambah Pengurus
                </a>
            </div>
        @endif
    </div>

    <!-- NOTIFIKASI ALERTS BANNER -->
    @if(session('success'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700 flex items-center gap-2">
            <span class="material-icons text-base">check_circle</span> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700 flex items-center gap-2">
            <span class="material-icons text-base">dangerous</span> {{ session('error') }}
        </div>
    @endif

    <!-- TABEL 1: DAFTAR SUPER ADMIN -->
    <div class="space-y-3">
        <h3 class="text-base font-black text-red-600 uppercase tracking-wider flex items-center gap-1">
            <span class="material-icons text-sm">admin_panel_settings</span> Kelompok Super Admin (Direksi)
        </h3>
        <div class="w-full overflow-x-auto border border-gray-200 rounded-2xl shadow-xs">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-800 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                        <th class="py-3 px-4">Nama</th>
                        <th class="py-3 px-4">Kontak Info</th>
                        <th class="py-3 px-4 text-center">Opsi Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                    @foreach($daftarSuperAdmin as $sa)
                        <tr class="hover:bg-gray-50/40">
                            <td class="py-3.5 px-4 font-bold text-gray-900">{{ $sa->name }}</td>
                            <td class="py-3.5 px-4 text-xs font-mono text-gray-700">{{ $sa->email }} <br> {{ $sa->no_telepon }}</td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Hanya sesama Super Admin yang bisa mengelola data pengurus internal -->
                                    @if($saatIni->role === 'super_admin')
                                        <a href="{{ route('admin.akun.edit', $sa->id) }}" class="p-1.5 bg-gray-50 border border-gray-200 text-gray-500 hover:bg-blue-600 hover:text-white rounded-lg transition text-xs flex items-center shadow-xs" title="Edit Data Pengurus">
                                            <span class="material-icons text-sm">edit</span>
                                        </a>
                                        
                                        @if($sa->id != 1)
                                            <form action="{{ route('admin.akun.destroy', $sa->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun Super Admin ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-1.5 bg-gray-50 border border-gray-200 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition flex items-center cursor-pointer shadow-xs"><span class="material-icons text-sm">delete</span></button>
                                            </form>
                                        @else
                                            <span class="text-[9px] font-black uppercase tracking-widest bg-red-600 text-white px-2.5 py-1 rounded-md border border-red-700 shadow-xs">Founder</span>
                                        @endif
                                    @else
                                        <span class="text-xs text-gray-400 font-normal italic">No Access</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- ----------------------------------------------------------------------- -->
    <!--                        TABEL 2: DAFTAR STAF ADMIN                       -->
    <!-- ----------------------------------------------------------------------- -->
    <div class="space-y-3">
        <h3 class="text-base font-black text-gray-800 uppercase tracking-wider flex items-center gap-1">
            <span class="material-icons text-sm">assignment_ind</span> Kelompok Staf Admin (Operasional Lapangan)
        </h3>
        <div class="w-full overflow-x-auto border border-gray-200 rounded-2xl shadow-xs">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-800 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                        <th class="py-3 px-4">Nama Staf</th>
                        <th class="py-3 px-4">Kontak</th>
                        <th class="py-3 px-4 text-center">Opsi Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                    @foreach($daftarAdmin as $adm)
                        <tr class="hover:bg-gray-50/40">
                            <td class="py-3.5 px-4 font-bold text-gray-900">{{ $adm->name }}</td>
                            <td class="py-3.5 px-4 text-xs font-mono text-gray-700">{{ $adm->email }} <br> {{ $adm->no_telepon }}</td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Super Admin memegang wewenang penuh atas operasional staf -->
                                    @if($saatIni->role === 'super_admin')
                                        <a href="{{ route('admin.akun.edit', $adm->id) }}" class="p-1.5 bg-gray-50 border border-gray-200 text-gray-500 hover:bg-blue-600 hover:text-white rounded-lg transition text-xs flex items-center shadow-xs" title="Edit Staf">
                                            <span class="material-icons text-sm">edit</span>
                                        </a>
                                        <form action="{{ route('admin.akun.destroy', $adm->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus staf admin ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 bg-gray-50 border border-gray-200 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition flex items-center cursor-pointer shadow-xs"><span class="material-icons text-sm">delete</span></button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-400 font-normal italic">No Access</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- ----------------------------------------------------------------------- -->
    <!--                          TABEL 3: DAFTAR PELANGGAN                      -->
    <!-- ----------------------------------------------------------------------- -->
    <div class="space-y-3">
        <h3 class="text-base font-black text-gray-800 uppercase tracking-wider flex items-center gap-1">
            <span class="material-icons text-sm">people</span> Kelompok Akun Pelanggan (Masyarakat Umum)
        </h3>
        <div class="w-full overflow-x-auto border border-gray-200 rounded-2xl shadow-xs">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-800 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                        <th class="py-3 px-4">Nama Pelanggan</th>
                        <th class="py-3 px-4">Email / No WA</th>
                        <th class="py-3 px-4 text-center">Opsi Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                    @forelse($daftarPelanggan as $plg)
                        <tr class="hover:bg-gray-50/40">
                            <td class="py-3.5 px-4 font-bold text-gray-900">{{ $plg->name }}</td>
                            <td class="py-3.5 px-4 text-xs font-mono text-gray-700">{{ $plg->email }} <br> {{ $plg->no_telepon }}</td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Sesuai aturan, data pelanggan sensitif (tidak bisa diedit) -->
                                    <!-- Namun, siapa pun (Admin/Super Admin) boleh menghapus jika melanggar ketentuan -->
                                    <form action="{{ route('admin.akun.destroy', $plg->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini secara permanen?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 bg-gray-50 border border-gray-200 text-gray-400 hover:bg-red-600 hover:text-white hover:border-red-600 rounded-lg transition text-xs flex items-center justify-center cursor-pointer shadow-xs"><span class="material-icons text-sm">delete</span></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-8 text-center text-gray-400 bg-gray-50/20 font-medium">Belum ada pelanggan umum terdaftar saat ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
