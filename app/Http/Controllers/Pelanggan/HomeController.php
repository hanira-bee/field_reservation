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
        $lapangans = Lapangan::query()
            ->where('status_aktif', true)
            ->orderBy('nama_lapangan')
            ->take(5)
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
        // 1. Validasi input dari form HTML
        $validated = $request->validate([
            'lapangan_id' => ['required', 'exists:lapangans,id'],
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'jam' => ['required', 'string'], // Menerima data string waktu dari form
            'catatan' => ['nullable', 'string'],
        ]);

        // 2. Ekstraksi jam: Mengambil 5 karakter pertama sebelum tanda strip jika user memilih paket 2 jam
        $jamMulaiSesi = substr($validated['jam'], 0, 5);

        // 3. Deteksi Paket: Memeriksa apakah data jam mengandung karakter " - " (Paket 2 Jam)
        $isPaket2Jam = str_contains($validated['jam'], ' - ');

        // 1. Cek bentrok jam mulai langsung
        $bentrokMulai = Reservasi::where('lapangan_id', $validated['lapangan_id']) 
            ->where('tgl_reservasi', $validated['tanggal']) 
            ->where('slot_jam', $jamMulaiSesi) 
            ->where('status_reservasi', '!=', 'cancelled') 
            ->exists(); 

        // 2. Cek bentrok jam pertengahan (Maju 1 jam atau mundur 1 jam tergantung jenis paket)
        $jamCekTambahan = $isPaket2Jam 
            ? Carbon::parse($jamMulaiSesi)->addHour()->format('H:i') 
            : Carbon::parse($jamMulaiSesi)->subHour()->format('H:i');

        $bentrokSesiSampingan = Reservasi::where('lapangan_id', $validated['lapangan_id']) 
            ->where('tgl_reservasi', $validated['tanggal']) 
            ->where('slot_jam', $jamCekTambahan) 
            ->where('status_reservasi', '!=', 'cancelled') 
            ->exists(); 

        // Jika pengguna memesan sesi 1 jam, dia hanya bentrok jika jam tersebut berstatus paket 2 jam dari jam sebelumnya
        if (!$isPaket2Jam && $bentrokSesiSampingan) {
            // Pastikan database jam sebelumnya memang merupakan bagian dari transaksi paket (karena durasi sewa dihitung per jam)
        }

        if ($bentrokMulai || ($isPaket2Jam && $bentrokSesiSampingan)) { 
            return redirect()->back() 
                ->withInput() 
                ->withErrors(['jam' => 'Jadwal terdeteksi bentrok dengan slot waktu paket lain yang sudah terisi.']); 
        }

        // 4. Proteksi anti-bentrok menggunakan jam mulai sesi yang sudah bersih
        $bentrok = Reservasi::where('lapangan_id', $validated['lapangan_id'])
            ->where('tgl_reservasi', $validated['tanggal'])
            ->where('slot_jam', $jamMulaiSesi)
            ->where('status_reservasi', '!=', 'cancelled')
            ->exists();

        if ($bentrok) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jam' => 'Jadwal pada tanggal dan sesi tersebut baru saja dipesan oleh pengguna lain. Silakan pilih jadwal lain.']);
        }

        $lapangan = Lapangan::findOrFail($validated['lapangan_id']);

        // 5. Kalkulasi Biaya Otomatis: Jika memilih paket 2 jam, harga dasar lapangan dikalikan 2
        $totalBiaya = $isPaket2Jam ? ($lapangan->harga_per_jam * 2) : $lapangan->harga_per_jam;

        // 6. Simpan data reservasi secara sah ke database
        Reservasi::create([
            'user_id' => Auth::id(),
            'lapangan_id' => $validated['lapangan_id'],
            'tgl_reservasi' => $validated['tanggal'],
            'slot_jam' => $jamMulaiSesi,
            'total_biaya' => $totalBiaya,
            'status_reservasi' => 'pending',
            'catatan' => $validated['catatan'],
        ]);

        return Redirect::route('home')->with('success', 'Reservasi anda berhasil diajukan! Silakan pantau status persetujuan dari admin.');
    }

    public function kontak()
    {
        return view('pelanggan.kontak');
    }

    public function detail(Request $request, $id)
    {
        $lapangan = Lapangan::findOrFail($id); 
        $tanggalDipilih = $request->get('tanggal', Carbon::today()->toDateString()); 

        $date = Carbon::parse($tanggalDipilih);
        $statusHari = $date->isWeekend() ? 'Weekend' : 'Weekday';
        $prevWeekString = $date->copy()->subWeek()->toDateString();
        $nextWeekString = $date->copy()->addWeek()->toDateString();
        $startOfWeek = $date->copy()->startOfWeek(Carbon::SUNDAY)->toDateString();
        $endOfWeek = $date->copy()->endOfWeek(Carbon::SATURDAY)->toDateString();

        // Ambil semua data reservasi mingguan lengkap dengan kolom total_biaya
        $reservasiMingguan = Reservasi::where('lapangan_id', $id) 
            ->whereBetween('tgl_reservasi', [$startOfWeek, $endOfWeek])
            ->where('status_reservasi', '!=', 'cancelled')
            ->get();

        // Strukturkan matriks booking menjadi array asosiatif multi-dimensi
        $matriksBooking = [];
        foreach ($reservasiMingguan as $res) {
            $tgl = $res->tgl_reservasi;
            $jam = Carbon::parse($res->slot_jam)->format('H:i');
            
            // DETEKSI DURASI: Jika total_biaya lebih besar dari harga 1 jam, tandai sebagai paket 2 jam
            // Kita bandingkan dengan $lapangan->harga_per_jam
            $isDuaJam = (float)$res->total_biaya > (float)$lapangan->harga_per_jam;

            $matriksBooking[$tgl][$jam] = [
                'booked' => true,
                'durasi_paket_2_jam' => $isDuaJam
            ];
        }

        // Definisi master sesi 1 jam
        $sesi1Jam = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];

        // Definisi master sesi 2 jam
        $sesi2Jam = ['08:00 - 10:00', '10:00 - 12:00', '12:00 - 14:00', '14:00 - 16:00', '16:00 - 18:00', '18:00 - 20:00'];

        // Kirim data matriksBooking ke Blade (menggantikan jamTerbookingRaw yang lama)
        return view('pelanggan.detail', compact(
        'lapangan', 'tanggalDipilih', 'matriksBooking', 
        'sesi1Jam', 'sesi2Jam', 'statusHari', 'startOfWeek', 'prevWeekString', 'nextWeekString'
        )); 
    }


    public function pelajari()
    {
        return view('pelanggan.pelajari');
    }
}
