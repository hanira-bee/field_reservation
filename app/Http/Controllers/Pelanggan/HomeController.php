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
        // Validasi input form
        $validated = $request->validate([
            'lapangan_id' => ['required', 'exists:lapangans,id'],
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'jam' => ['required', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);

        $jamMulaiSesi = substr($validated['jam'], 0, 5);
        $isPaket2Jam = str_contains($validated['jam'], ' - ');

        // Proteksi anti-bentrok jam mulai langsung
        $bentrokMulai = Reservasi::where('lapangan_id', $validated['lapangan_id'])
            ->where('tgl_reservasi', $validated['tanggal'])
            ->where('slot_jam', $jamMulaiSesi)
            ->where('status_reservasi', '!=', 'cancelled')
            ->exists();

        // Proteksi anti-bentrok jam pertengahan paket
        $jamCekTambahan = $isPaket2Jam
            ? Carbon::parse($jamMulaiSesi)->addHour()->format('H:i')
            : Carbon::parse($jamMulaiSesi)->subHour()->format('H:i');

        $bentrokSesiSampingan = Reservasi::where('lapangan_id', $validated['lapangan_id'])
            ->where('tgl_reservasi', $validated['tanggal'])
            ->where('slot_jam', $jamCekTambahan)
            ->where('status_reservasi', '!=', 'cancelled')
            ->exists();

        if ($bentrokMulai || ($isPaket2Jam && $bentrokSesiSampingan)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jam' => 'Jadwal terdeteksi bentrok dengan slot waktu paket lain yang sudah terisi.']);
        }

        $lapangan = Lapangan::findOrFail($validated['lapangan_id']);
        $totalBiaya = $isPaket2Jam ? ($lapangan->harga_per_jam * 2) : $lapangan->harga_per_jam;

        // GENERATOR KODE BOOKING UNIK OTOMATIS
        // Format hasil: SM + TAHUNBULANTANGGAL + 4 ANGKA ACAK (Contoh: SM2607294821)
        $stringTanggal = Carbon::parse($validated['tanggal'])->format('ymd');
        do {
            $kodeBookingBaru = 'SM' . $stringTanggal . rand(1000, 9999);
            // Validasi keunikan kode agar tidak ada yang kembar di database
            $kodeSudahAda = Reservasi::where('kode_booking', $kodeBookingBaru)->exists();
        } while ($kodeSudahAda);

        // Simpan record data reservasi ke database lengkap dengan kode_booking
        Reservasi::create([
            'user_id' => Auth::id(),
            'lapangan_id' => $validated['lapangan_id'],
            'kode_booking' => $kodeBookingBaru, // Menyimpan kode tiket digital unik
            'tgl_reservasi' => $validated['tanggal'],
            'slot_jam' => $jamMulaiSesi,
            'total_biaya' => $totalBiaya,
            'status_reservasi' => 'pending', // Default awal pending menunggu upload struk
            'catatan' => $validated['catatan'],
        ]);

        // Melempar ke rute riwayat dengan membawa pesan sukses berantai
        return redirect()->route('pelanggan.riwayat')->with('success', 'Permohonan reservasi berhasil diajukan! Silakan lakukan transfer pembayaran dan unggah struk bukti transfer Anda.');
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
            'lapangan',
            'tanggalDipilih',
            'matriksBooking',
            'sesi1Jam',
            'sesi2Jam',
            'statusHari',
            'startOfWeek',
            'prevWeekString',
            'nextWeekString'
        ));
    }

    public function tentang()
    {
        return view('pelanggan.tentang');
    }

    public function pelajari()
    {
        return view('pelanggan.pelajari');
    }

    /* -------------------------------------------------------------------------- */
    /*                     MODUL RIWAYAT RESERVASI PELANGGAN                      */
    /* -------------------------------------------------------------------------- */

    // Menampilkan Daftar Riwayat Reservasi Akun yang Sedang Login
    public function riwayatIndex()
    {
        // Mengambil data reservasi khusus milik user yang sedang aktif login (Auth::id())
        $reservasis = Reservasi::with('lapangan')
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->orderBy('tgl_reservasi', 'desc')
            ->orderBy('slot_jam', 'asc')
            ->get();

        return view('pelanggan.riwayat', compact('reservasis'));
    }



    // Memproses Unggahan Berkas Foto Struk Bukti Transfer Pelanggan
    public function uploadBuktiPembayaran(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048']
        ]);

        // Ambil data reservasi milik user aktif
        $reservasi = Reservasi::where('id', $id)
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->firstOrFail();

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');

            // Memastikan folder penampung public terwujud nyata di komputer Anda
            $pathTujuan = public_path('images/bukti_transfer');
            if (!file_exists($pathTujuan)) {
                mkdir($pathTujuan, 0777, true);
            }

            // Formula pembuatan nama berkas unik
            $namaFileStruk = 'struk_' . ($reservasi->kode_booking ?? time()) . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Eksekusi pemindahan file fisik ke folder komputer
            $file->move($pathTujuan, $namaFileStruk);

            // Hapus berkas lama jika ada
            if ($reservasi->bukti_pembayaran && file_exists(public_path('images/bukti_transfer/' . $reservasi->bukti_pembayaran))) {
                @unlink(public_path('images/bukti_transfer/' . $reservasi->bukti_pembayaran));
            }

            $reservasi->bukti_pembayaran = $namaFileStruk;
            $reservasi->save(); // Mengunci rekaman data baru ke database

            return redirect()->back()->with('success', 'Struk bukti transfer berhasil diunggah! Status di database resmi terisi.');
        }

        // Jika file gagal terdeteksi oleh Laravel backend
        return redirect()->back()->with('error', 'Gagal memproses unggahan: File tidak terdeteksi oleh sistem backend.');
    }

    /* -------------------------------------------------------------------------- */
    /*                         MODUL EDIT PROFIL PELANGGAN                        */
    /* -------------------------------------------------------------------------- */

    // Menampilkan Halaman Formulir Ubah Profil Pelanggan
    public function profilEdit()
    {
        // Mengambil data user yang sedang aktif login
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('pelanggan.profil_edit', compact('user'));
    }

    // Memproses Pembaruan Data Profil & Password Pelanggan ke Database
    public function profilUpdate(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        // Aturan validasi data input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Validasi email unik, kecuali untuk ID user itu sendiri agar tidak bentrok saat simpan
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'no_telepon' => ['required', 'string', 'max:20'],
            // Password baru bersifat opsional, diisi hanya jika ingin mengganti sandi lama
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Struktur data dasar yang akan diperbarui
        $dataUpdate = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_telepon' => $validated['no_telepon'],
        ];

        // Jika pelanggan mengisi kolom password baru, enkripsi dan masukkan ke antrean update
        if (!empty($validated['password'])) {
            $dataUpdate['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        // Eksekusi pembaruan data ke database MySQL
        $user->update($dataUpdate);

        return redirect()->back()->with('success', 'Profil akun Anda berhasil diperbarui!');
    }

    // Fitur Pembatalan Mandiri oleh Pelanggan Sebelum Diverifikasi Admin
    public function batalMandiriPelanggan($id)
    {
        // Mencari data reservasi yang sesuai dengan ID dan harus milik user yang sedang login
        $reservasi = Reservasi::where('id', $id)
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->firstOrFail();

        // Keamanan Sistem: Pelanggan HANYA boleh membatalkan jika statusnya masih 'pending'
        // Jika sudah 'confirmed' (lunas disetujui admin), pelanggan tidak bisa asal klik batal lewat web
        if ($reservasi->status_reservasi !== 'pending') {
            return redirect()->back()->with('error', '⚠️ GAGAL: Jadwal tanding yang sudah disetujui Lunas oleh Admin tidak dapat dibatalkan secara mandiri!');
        }

        if ($reservasi->bukti_pembayaran && file_exists(public_path('images/bukti_transfer/' . $reservasi->bukti_pembayaran))) {
            @unlink(public_path('images/bukti_transfer/' . $reservasi->bukti_pembayaran));
        }

        $reservasi->update([
            'status_reservasi' => 'cancelled',
            'bukti_pembayaran' => null
        ]);

        return redirect()->route('pelanggan.riwayat')->with('success', 'Reservasi Anda telah berhasil dibatalkan. Slot jam lapangan kini telah dibuka kembali.');
    }
}
