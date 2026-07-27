<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class HomeController extends Controller
{

    private function hitungHargaDinamis($hargaBase, $tanggal)
    {
        $date = Carbon::parse($tanggal);
        // jika hari sabtu (6) atau minggu (0). tarif naik Rp 25.000
        if ($date->isWeekend()) {
            return $hargaBase + 25000;
        }
        return $hargaBase;
    }
    public function index()
    {
        $lapangans = Lapangan::where('status_aktif', true)
            ->orderBy('nama_lapangan')
            ->get();
        
            foreach ($lapangans as $lapangan) {
                $lapangan->harga_saat_ini = $this->hitungHargaDinamis($lapangan->harga_per_jam, Carbon::today());
            }

        return view('pelanggan.home', compact('lapangans'));
    }

    public function lapangan()
    {
        $lapangans = Lapangan::where('status_aktif', true)
            ->orderBy('nama_lapangan')
            ->get();

        foreach ($lapangans as $lapangan) {
            $lapangan->harga_saat_ini = $this->hitungHargaDinamis($lapangan->harga_per_jam, Carbon::today());
        }
        return view('pelanggan.lapangan', compact('lapangans'));
    }

    public function reservasi(Request $request)
    {
        $user = Auth::user();
        $lapanganId = $request->get('lapangan_id');
        $tanggal = $request->get('tanggal');

        $lapangan = Lapangan::findOrFail($lapanganId);
        $hargaFinal = $this->hitungHargaDinamis($lapangan->harga_per_jam, $tanggal);

        $defaultData = [
            'nama' => $user->name,
            'email' => $user->email,
            'no_telepon' => $user->no_telepon ?? '',
            'lapangan_id' => $request->get('lapangan_id'),
            'tanggal' => $request->get('tanggal'),
            'jam' => $request->get('jam'),
            'total_biaya' => $hargaFinal
        ];

        // mengambil daftar lapangan aktif untuk dropdown di blade
        $lapangans = Lapangan::where('status_aktif', true)->get();

        return view('pelanggan.reservasi', compact('defaultData', 'lapangans'));
    }

    public function submitReservasi(Request $request)
    {
        // validasi input form html
        $validated = $request->validate([
            'lapangan_id' => ['required', 'exists:lapangans,id'],
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'jam' => ['required', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);

        // Proteksi ganda anti-bentrok jadwal
        $bentrok = Reservasi::where('lapangan_id', $validated['lapangan_id'])
            ->where('tgl_reservasi', $validated['tanggal'])
            ->where('slot_jam', $validated['jam'])
            ->where('status reservasi', '!=', 'cancelled')
            ->exists();

        if ($bentrok) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jam' => 'Jadwal pada tanggal dan jam tersebut baru saja dipesan oleh pengguna lain.']);
        }

        // ambil data lapangan untuk mendapatkan harga sewa
        $lapangan = Lapangan::findOrFail($validated['lapangan_id']);
        $hargaFinal = $this->hitungHargaDinamis($lapangan->harga_per_jam, $validated['tanggal']);

        // simpan ke database sesuai struktur kolom migration
        Reservasi::create([
            'user_id' => Auth::id(), // id pengguna yang sedang login
            'lapangan_id' => $validated['lapangan_id'],
            'tgl_reservasi' => $validated['tanggal'],
            'slot_jam' => $validated['jam'],
            'total_biaya' => $hargaFinal,
            'status_reservasi' => 'pending',
            'catatan' => $validated['catatan'],
        ]);

        return Redirect::route('home')->with('success', 'Reservasi anda berhasil diajukan! Menunggu konfirmasi admin.');
    }

    public function kontak()
    {
        return view('pelanggan.kontak');
    }

    public function detail(Request $request, $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        // ambil tanggal acuan, default hari ini
        $tanggalAcuan = $request->get('tanggal', Carbon::today()->toDateString());
        $carbonAcuan = Carbon::parse($tanggalAcuan);

        // hitung rentang awal minggu dan akhir minggu
        $startOfWeek = $carbonAcuan->copy()->startOfWeek(Carbon::SUNDAY);
        $endOfWeek = $carbonAcuan->copy()->endOfWeek(Carbon::SATURDAY);

        // ambil seluruh data booking aktif untuk lapangan ini khusus di minggu tersebut
        $reservasiMingguan = Reservasi::where('lapangan_id', $id)
            ->whereBetween('tgl_reservasi', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->where('status_reservasi', '!=', 'cancelled')
            ->get();

        $matriksBooking = [];
        foreach ($reservasiMingguan as $res) {
            $tgl = $res->tgl_reservasi;
            $jam = Carbon::parse($res->slot_jam)->format('H:i');
            $matriksBooking[$tgl][] = $jam;
        }

        // menentukan slot jam reservasi
        $daftarSesi = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];

        // menghitung harga dinamis untuk tanggal yang sedang diklik user
        $hargaSewaHariIni = $this->hitungHargaDinamis($lapangan->harga_per_jam, $tanggalAcuan);
        $statusHari = $carbonAcuan->isWeekend() ? 'Weekend' : 'Weekday';

        // navigasi minggu sebelumnya & minggu setelahnya
        $preWeekString = $carbonAcuan->copy()->subWeek()->toDateString();
        $nextWeekString = $carbonAcuan->copy()->addWeek()->toDateString();

        // mengecek tanggal yang dipilih termasuk hari biasa atau akhir pekan
        // $date = CArbon::parse($tanggalDipilih);
        // $statusHari = $date->isWeekend() ? 'Weekend' : 'Weekday';

        // 4. Kirim data lapangan tunggal, tanggal, daftar jam terbooking, status hari, dan slot jam ke view
        return view('pelanggan.detail', compact('lapangan', 'tanggalAcuan', 'startOfWeek', 'matriksBooking', 'daftarSesi', 'hargaSewaHariIni', 'statusHari', 'preWeekString', 'nextWeekString'));
    }
}
