<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        // 1. Pastikan pengguna sudah login terlebih dahulu
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        // 2. PERBAIKAN LOGIKA: Jika rute meminta akses 'admin', 
        // maka akun ber-role 'admin' MAUPUN 'super_admin' wajib diloloskan bersamaan
        if ($role === 'admin' && ($userRole === 'admin' || $userRole === 'super_admin')) {
            return $next($request);
        }

        // 3. Pengecekan standar untuk role spesifik lainnya (seperti pelanggan)
        if ($userRole !== $role) {
            abort(403, 'Akses Ditolak: Otoritas Tidak Terpenuhi.');
        }

        return $next($request);
    }
}
