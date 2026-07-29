<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total pendapatan bulan berjalan ini dari seluruh reservasi yang tidak dibatalkan
        $awalBulanIni = \Carbon\Carbon::now()->startOfMonth()->toDateString();
        $akhirBulanIni = \Carbon\Carbon::now()->endOfMonth()->toDateString();

        $totalPendapatanBulanIni = Reservasi::whereBetween('tgl_reservasi', [$awalBulanIni, $akhirBulanIni])
            ->where('status_reservasi', 'confirmed') // Hanya omzet lunas/disetujui
            ->sum('total_biaya');


        // Hitung jumlah permohonan reservasi baru yang masuk dan masih butuh persetujuan (status: pending)
        $jumlahReservasiBaru = Reservasi::where('status_reservasi', 'pending')->count();

        // Hitung jumlah total pelanggan (User dengan role 'pelanggan') yang terdaftar di sistem 
        $totalPelanggan = User::where('role', 'pelanggan')->count();

        // Hitung berapa banyak jumlah arena lapangan yang saat ini berstatus aktif
        $totalLapanganAktif = Lapangan::where('status_aktif', true)->count();

        // Mengambil 5 reservasi terbaru yang butuh tindakan verifikasi cepat oleh admin (Log Antrean Bukti)
        $bookingButuhTindakan = Reservasi::with(['user', 'lapangan'])
            ->where('status_reservasi', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Mengambil seluruh agenda pertandingan tim yang dijadwalkan tanding hari ini (Real-Time Hari Ini)
        $jadwalHariIni = Reservasi::with(['user', 'lapangan'])
            ->where('tgl_reservasi', Carbon::today()->toDateString())
            ->where('status_reservasi', 'confirmed') // Hanya memunculkan yang sudah lunas disetujui
            ->orderBy('slot_jam', 'asc')
            ->get();

        // Kirim semua variabel data di atas menuju halaman dashboard admin blade
        return view('admin.dashboard', compact(
            'totalPendapatanBulanIni',
            'jumlahReservasiBaru',
            'totalPelanggan',
            'totalLapanganAktif',
            'bookingButuhTindakan',
            'jadwalHariIni'
        ));
    }

    /* -------------------------------------------------------------------------- */
    /*                                  RESERVASI                                 */
    /* -------------------------------------------------------------------------- */

    public function reservasiIndex(Request $request)
    {
        $statusFilter = $request->get('status', 'pending');

        if (!in_array($statusFilter, ['pending', 'confirmed', 'cancelled'])) {
            $statusFilter = 'pending';
        }

        $reservasis = Reservasi::with(['user', 'lapangan'])
            ->where('status_reservasi', $statusFilter)
            ->orderBy('tgl_reservasi', 'desc')
            ->orderBy('slot_jam', 'asc')
            ->get();

        return view('admin.reservasi', compact('reservasis', 'statusFilter'));
    }

    public function updateStatusReservasi(Request $request, $id)
    {
        $request->validate([
            'status_reservasi' => ['required', 'in:confirmed,cancelled']
        ]);

        $reservasi = Reservasi::findOrFail($id);

        // Update status di database
        $reservasi->update([
            'status_reservasi' => $request->status_reservasi
        ]);

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }

    /* -------------------------------------------------------------------------- */
    /*                                  LAPANGAN                                  */
    /* -------------------------------------------------------------------------- */

    // Menampilkan Semua Daftar Lapangan di Dashboard Admin
    public function lapanganIndex()
    {
        $lapangans = Lapangan::orderBy('nama_lapangan', 'asc')->get();
        return view('admin.lapangan.index', compact('lapangans'));
    }

    // Menampilkan Halaman Formulir Tambah Lapangan Baru
    public function lapanganCreate()
    {
        return view('admin.lapangan.create');
    }

    // Memproses Penyimpanan Data Lapangan Baru ke Database + Upload Foto
    public function lapanganStore(Request $request)
    {
        $validated = $request->validate([
            'nama_lapangan' => ['required', 'string', 'max:255'],
            'jenis_lapangan' => ['required', 'string', 'in:Futsal,Badminton'],
            'lokasi' => ['required', 'string', 'max:255'],
            'harga_per_jam' => ['required', 'numeric', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
            'fasilitas' => ['nullable', 'string'],
            'ukuran' => ['nullable', 'string', 'max:100'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], // Maksimal ukuran berkas 2MB
        ]);

        $namaFileGambar = null;

        // Logika memproses unggahan file foto fisik
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Menghasilkan nama unik, contoh: 172100234_futsal.jpg
            $namaFileGambar = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            // Memindahkan file fisik asli ke folder public/images/
            $file->move(public_path('images'), $namaFileGambar);
        }

        Lapangan::create([
            'nama_lapangan' => $validated['nama_lapangan'],
            'jenis_lapangan' => $validated['jenis_lapangan'],
            'lokasi' => $validated['lokasi'],
            'harga_per_jam' => $validated['harga_per_jam'],
            'deskripsi' => $validated['deskripsi'],
            'fasilitas' => $validated['fasilitas'],
            'ukuran' => $validated['ukuran'],
            'gambar' => $namaFileGambar,
            'status_aktif' => true, // Default langsung aktif saat dibuat
        ]);

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan baru berhasil ditambahkan!');
    }

    // Menampilkan Halaman Formulir Edit Lapangan Berdasarkan ID
    public function lapanganEdit($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('admin.lapangan.edit', compact('lapangan'));
    }

    // Memproses Pembaruan Perubahan Data Lapangan ke Database
    public function lapanganUpdate(Request $request, $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $validated = $request->validate([
            'nama_lapangan' => ['required', 'string', 'max:255'],
            'jenis_lapangan' => ['required', 'string', 'in:Futsal,Badminton'],
            'lokasi' => ['required', 'string', 'max:255'],
            'harga_per_jam' => ['required', 'numeric', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
            'fasilitas' => ['nullable', 'string'],
            'ukuran' => ['nullable', 'string', 'max:100'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $namaFileGambar = $lapangan->gambar;

        // Jika admin mengunggah file foto baru
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFileGambar = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $namaFileGambar);

            // Hapus file foto lama di folder public/images jika ada, agar penyimpanan laptop/server tidak penuh
            if ($lapangan->gambar && file_exists(public_path('images/' . $lapangan->gambar))) {
                @unlink(public_path('images/' . $lapangan->gambar));
            }
        }

        $lapangan->update([
            'nama_lapangan' => $validated['nama_lapangan'],
            'jenis_lapangan' => $validated['jenis_lapangan'],
            'lokasi' => $validated['lokasi'],
            'harga_per_jam' => $validated['harga_per_jam'],
            'deskripsi' => $validated['deskripsi'],
            'fasilitas' => $validated['fasilitas'],
            'ukuran' => $validated['ukuran'],
            'gambar' => $namaFileGambar,
        ]);

        return redirect()->route('admin.lapangan.index')->with('success', 'Data informasi lapangan berhasil diperbarui!');
    }

    // Fitur Sakelar Status Aktif / Nonaktif Lapangan Sementara
    public function lapanganToggleStatus($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        // Membalikkan status boolean: jika true jadi false, jika false jadi true
        $lapangan->update([
            'status_aktif' => !$lapangan->status_aktif
        ]);

        return redirect()->back()->with('success', 'Status operasional lapangan berhasil diubah!');
    }

    // Menghapus Lapangan Secara Permanen
    public function lapanganDestroy($id)
    {
        $lapangan = Lapangan::findOrFail($id);

        // Hapus file fisiknya dari folder publik komputer terlebih dahulu sebelum menghapus baris database
        if ($lapangan->gambar && file_exists(public_path('images/' . $lapangan->gambar))) {
            @unlink(public_path('images/' . $lapangan->gambar));
        }

        $lapangan->delete();

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan telah sukses dihapus secara permanen!');
    }

    /* -------------------------------------------------------------------------- */
    /* ---------------------------------- AKUN ---------------------------------- */
    /* -------------------------------------------------------------------------- */

    // Menampilkan Semua Daftar Akun yang Dipisah Berdasarkan Role Tabel
    public function akunIndex()
    {
        $saatIni = Auth::user();

        $daftarSuperAdmin = User::where('role', 'super_admin')->orderBy('name', 'asc')->get();
        $daftarAdmin = User::where('role', 'admin')->orderBy('name', 'asc')->get();
        $daftarPelanggan = User::where('role', 'pelanggan')->orderBy('name', 'asc')->get();

        return view('admin.akun.index', compact('saatIni', 'daftarSuperAdmin', 'daftarAdmin', 'daftarPelanggan'));
    }

    // Menampilkan Halaman Formulir Pembuatan Pengurus Internal Baru
    public function akunCreate()
    {
        $adminLogin = Auth::user();

        // PROTEKSI: Hanya Super Admin yang boleh membuat akun pengurus baru
        if ($adminLogin->role !== 'super_admin') {
            return redirect()->route('admin.akun.index')->with('error', '⚠️ AKSES DITOLAK: Staf Admin biasa tidak memiliki wewenang untuk mendaftarkan akun pengurus baru!');
        }

        return view('admin.akun.create', compact('adminLogin'));
    }

    // Menyimpan Akun Baru ke Database
    public function akunStore(Request $request)
    {
        $adminLogin = Auth::user();

        if ($adminLogin->role !== 'super_admin') {
            return redirect()->route('admin.akun.index')->with('error', '⚠️ PELANGGARAN HAK AKSES OLEH STAF: Tindakan ilegal digagalkan otomatis.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,super_admin'] // Hanya boleh memproduksi pengurus internal
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_telepon' => $validated['no_telepon'],
            'password' => Hash::make($validated['password']),
            'tgl_daftar' => now()->toDateString(),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Akun pengurus baru berhasil didaftarkan ke sistem!');
    }

    // Menampilkan Halaman Formulir Edit Akun Pengurus
    public function akunEdit($id)
    {
        $adminLogin = Auth::user();
        $user = User::findOrFail($id);

        // ATURAN 1: Akun pelanggan tidak boleh diedit oleh siapapun karena bersifat sensitif
        if ($user->role === 'pelanggan') {
            return redirect()->route('admin.akun.index')->with('error', '⚠️ AKSES DITOLAK: Akun pelanggan bersifat rahasia/sensitif dan tidak boleh diubah oleh internal!');
        }

        // ATURAN 2: Staf Admin biasa dilarang keras mengedit akun internal
        if ($adminLogin->role !== 'super_admin') {
            return redirect()->route('admin.akun.index')->with('error', '⚠️ AKSES DITOLAK: Hanya tingkatan Super Admin yang memiliki wewenang menyunting data pengurus!');
        }

        return view('admin.akun.edit', compact('user', 'adminLogin'));
    }

    // Memproses Pembaruan Data Perubahan Akun Pengurus
    public function akunUpdate(Request $request, $id)
    {
        $adminLogin = Auth::user();
        $user = User::findOrFail($id);

        // Proteksi berlapis level controller
        if ($user->role === 'pelanggan' || $adminLogin->role !== 'super_admin') {
            return redirect()->route('admin.akun.index')->with('error', '⚠️ PELANGGARAN PROTEKSI SISTEM: Tindakan diblokir.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'no_telepon' => ['required', 'string', 'max:20'],
            'role' => ['required', 'string', 'in:admin,super_admin'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Mencegah penurunan paksa role Super Admin Utama (ID: 1)
        if ($user->id == 1 && $validated['role'] !== 'super_admin') {
            return redirect()->back()->withInput()->withErrors(['role' => 'Akun Super Admin Utama (ID 1) harus tetap memegang role Super Admin!']);
        }

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_telepon' => $validated['no_telepon'],
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.akun.index')->with('success', 'Data akun pengurus berhasil diperbarui!');
    }

    // Menghapus Akun dengan Proteksi Hak Akses Menyesuaikan Peran
    public function akunDestroy($id)
    {
        $adminLogin = Auth::user();
        $targetUser = User::findOrFail($id);

        // ATURAN MANDATORI: Mencegah penghapusan Akun Super Admin Utama (ID 1)
        if ($targetUser->id == 1) {
            return redirect()->back()->with('error', '⚠️ CRITICAL ERROR: Akun Super Admin Utama (ID 1) dilindungi sistem dan tidak bisa dihapus!');
        }

        // ATURAN MANDATORI: Mencegah admin menghapus dirinya sendiri yang sedang login
        if ($targetUser->id === $adminLogin->id) {
            return redirect()->back()->with('error', '⚠️ GAGAL: Anda tidak bisa menghapus akun Anda sendiri yang sedang digunakan!');
        }

        // LOGIKA PENYARING HAK AKSES PERAN:
        if ($adminLogin->role === 'super_admin') {
            // Super Admin BISA menghapus sesama Super Admin (kecuali ID 1) dan Staf Admin, tapi TIDAK BISA menghapus pelanggan (Sensitif)
            if ($targetUser->role === 'pelanggan') {
                return redirect()->back()->with('error', '⚠️ AKSES DITOLAK: Super Admin dilarang menghapus akun pelanggan langsung demi menjaga integritas privasi data!');
            }
        } else {
            // Staf Admin biasa TIDAK BISA menghapus internal (super_admin/admin), tapi BISA menghapus pelanggan biasa
            if (in_array($targetUser->role, ['super_admin', 'admin'])) {
                return redirect()->back()->with('error', '⚠️ AKSES DITOLAK: Staf Admin biasa tidak memiliki hak untuk menghapus akun pengurus internal lainnya!');
            }
        }

        // Eksekusi penghapusan jika lolos penyaringan di atas
        $targetUser->delete();
        return redirect()->route('admin.akun.index')->with('success', 'Akun berhasil dihapus dari sistem secara permanen!');
    }

    /* -------------------------------------------------------------------------- */
    /*               MODUL LAPORAN KEUANGAN & PENCATATAN TRANSAKSI                */
    /* -------------------------------------------------------------------------- */

    // Menampilkan Halaman Riwayat Transaksi Finansial & Filter Omzet
    public function laporanIndex(Request $request)
    {
        $bulanDipilih = $request->get('bulan', date('m'));
        $tahunDipilih = $request->get('tahun', date('Y'));

        $awalBulanFilter = \Carbon\Carbon::createFromDate($tahunDipilih, $bulanDipilih, 1)->startOfMonth()->toDateString();
        $akhirBulanFilter = \Carbon\Carbon::createFromDate($tahunDipilih, $bulanDipilih, 1)->endOfMonth()->toDateString();

        $transaksis = Reservasi::with(['user', 'lapangan'])
            ->whereBetween('tgl_reservasi', [$awalBulanFilter, $akhirBulanFilter])
            ->where('status_reservasi', 'confirmed') // Mengunci status lunas saja
            ->orderBy('tgl_reservasi', 'desc')
            ->get();

        $totalOmzet = $transaksis->sum('total_biaya');

        return view('admin.laporan.index', compact('transaksis', 'totalOmzet', 'bulanDipilih', 'tahunDipilih'));
    }

    // Mengeksekusi Unduhan Berkas PDF Rekap Keuangan Bulanan
    public function unduhLaporanPdf(Request $request)
    {
        $bulanDipilih = $request->get('bulan', date('m'));
        $tahunDipilih = $request->get('tahun', date('Y'));

        // PERBAIKAN: Hanya mengambil transaksi yang sudah disetujui/lunas (confirmed)
        $transaksis = Reservasi::with(['user', 'lapangan'])
            ->whereMonth('tgl_reservasi', $bulanDipilih)
            ->whereYear('tgl_reservasi', $tahunDipilih)
            ->where('status_reservasi', 'confirmed') // Mengunci status lunas saja
            ->orderBy('tgl_reservasi', 'asc')
            ->get();

        $totalOmzet = $transaksis->sum('total_biaya');

        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        $periodeTeks = $namaBulan[$bulanDipilih] . ' ' . $tahunDipilih;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan.cetak_pdf', compact('transaksis', 'totalOmzet', 'periodeTeks'));
        return $pdf->download('Laporan_Keuangan_SM_SportCenter_' . $bulanDipilih . '_' . $tahunDipilih . '.pdf');
    }
}
