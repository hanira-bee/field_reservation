@extends('layouts.admin')

@section('page_title', 'Sunting Akun Pengurus')

@section('content')
<section class="bg-white max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.akun.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-gray-400 hover:text-red-600 transition mb-3">
            <span class="material-icons text-sm">arrow_back</span> Kembali ke Daftar Akun
        </a>
        <h1 class="text-3xl font-black text-red-600 uppercase tracking-tight">Sunting Otoritas</h1>
        <p class="text-sm text-gray-400 font-medium">Perbarui profil kepengurusan internal atau modifikasi tingkatan level hak akses staf.</p>
    </div>

    <form action="{{ route('admin.akun.update', $user->id) }}" method="POST" class="space-y-5 border border-gray-100 rounded-3xl p-6 sm:p-8 bg-gray-50/30 shadow-xs">
        @csrf

        <div>
            <label for="name" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Pengurus</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none">
        </div>

        <div>
            <label for="email" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Alamat Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none">
        </div>

        <div>
            <label for="no_telepon" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor Telepon</label>
            <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}" required class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none">
        </div>

        <div>
            <label for="role" class="mb-1.5 block text-xs font-bold text-gray-700 uppercase tracking-wider">Tingkatan Otoritas (Role)</label>
            <select id="role" name="role" required class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none cursor-pointer">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Staf Admin Biasa (Operasional)</option>
                <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin (Direksi Manajemen)</option>
            </select>
        </div>

        <div class="pt-2 border-t border-gray-100/60">
            <label for="password" class="mb-1.5 block text-xs font-bold text-gray-400 uppercase tracking-wider">Ganti Password Baru (Opsional)</label>
            <input type="password" id="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengganti password staf" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none mb-4">
            
            <label for="password_confirmation" class="mb-1.5 block text-xs font-bold text-gray-400 uppercase tracking-wider">Konfirmasi Password Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-red-500 focus:outline-none">
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
            <a href="{{ route('admin.akun.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-xs font-bold text-gray-500 hover:bg-gray-100 transition uppercase">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-xs transition uppercase flex items-center gap-1"><span class="material-icons text-sm">save</span> Update Data</button>
        </div>
    </form>
</section>
@endsection
