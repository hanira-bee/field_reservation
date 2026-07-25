<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;

class HomeController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::query()
            ->where('status_aktif', true)
            ->orderBy('nama_lapangan')
            ->get();

        return view('pelanggan.home', compact('lapangans'));
    }
}
