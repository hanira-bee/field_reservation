<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

    public function lapangan()
    {
        $lapangans = Lapangan::query()
            ->where('status_aktif', true)
            ->orderBy('nama_lapangan')
            ->get();

        return view('pelanggan.lapangan', compact('lapangans'));
    }

    public function reservasi()
    {
        $defaultData = [
            'nama' => Auth::check() ? Auth::user()->name : null,
            'email' => Auth::check() ? Auth::user()->email : null,
            'no_telepon' => Auth::check() ? Auth::user()->no_telepon : null,
        ];

        return view('pelanggan.reservasi', compact('defaultData'));
    }

    public function submitReservasi(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'lapangan' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
            'jam' => ['required', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);

        $request->session()->flash('success', 'Reservasi Anda telah diterima. Tim kami akan segera menghubungi Anda.');

        return Redirect::route('reservasi')->withInput($data);
    }

    public function kontak()
    {
        return view('pelanggan.kontak');
    }
}
