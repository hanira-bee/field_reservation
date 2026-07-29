<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan SM Sport Center</title>
    <style>
        /* CSS STANDAR KHUSUS PRINT DOMPDF */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333333;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #dc2626; /* Aksen Warna Merah */
            padding-bottom: 10px;
        }
        .header h1 {
            color: #dc2626;
            font-size: 24px;
            text-transform: uppercase;
            margin: 0 0 5px 0;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .header p {
            color: #666666;
            margin: 0;
            font-size: 11px;
            font-weight: 500;
        }
        .meta-info {
            margin-bottom: 20px;
            width: 100%;
        }
        .meta-info td {
            font-size: 11px;
            color: #444444;
        }
        .table-report {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table-report th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
            padding: 10px 8px;
            text-align: left;
        }
        .table-report td {
            padding: 10px 8px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 11px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .font-bold {
            font-weight: bold;
        }
        .font-mono {
            font-family: 'Courier', monospace;
        }
        .badge-durasi {
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            color: #64748b;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            display: inline-block;
        }
        .total-section {
            width: 100%;
            margin-top: 10px;
        }
        .total-box {
            float: right;
            width: 300px;
            background-color: #f0fdf4; /* Warna hijau omzet */
            border: 1px solid #bbf7d0;
            padding: 12px;
            border-radius: 8px;
            text-align: right;
        }
        .total-box p {
            margin: 0;
        }
        .total-box .label {
            font-size: 10px;
            text-transform: uppercase;
            color: #166534;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .total-box .value {
            font-size: 18px;
            font-weight: 900;
            color: #15803d;
            margin-top: 4px;
        }
        .footer-note {
            margin-top: 60px;
            font-size: 10px;
            color: #94a3b8;
            text-align: center;
            border-top: 1px dashed #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <!-- KEPALA SURAT / HEADER LAPORAN RESMI -->
    <div class="header">
        <h1>SM Sport Center</h1>
        <p>Sistem Informasi Pembukuan & Reservasi Arena Olahraga Premium</p>
        <p style="margin-top: 3px; font-style: italic;">Rekapitulasi Data Omzet Transaksi Masuk Bulanan</p>
    </div>

    <!-- INFORMASI METADATA PERIODE CETAK -->
    <table class="meta-info">
        <tr>
            <td><strong>Periode Laporan:</strong> {{ $periodeTeks }}</td>
            <td class="text-right"><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td><strong>Status Dokumen:</strong> Validated (Final Rekap)</td>
            <td class="text-right"><strong>Oleh:</strong> {{ Auth::user()->name }} ({{ Auth::user()->role }})</td>
        </tr>
    </table>

    <!-- STRUKTUR TABEL LAPORAN OMZET -->
    <table class="table-report">
        <thead>
            <tr>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 25%;">Nama Pelanggan</th>
                <th style="width: 30%;">Arena Lapangan</th>
                <th style="width: 15%; text-align: center;">Durasi</th>
                <th style="width: 15%; text-align: right;">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $t)
                @php
                    $isPaket2Jam = (float)$t->total_biaya > (float)$t->lapangan->harga_per_jam;
                    $jamMulai = \Carbon\Carbon::parse($t->slot_jam)->format('H:i');
                    $jamSelesai = \Carbon\Carbon::parse($t->slot_jam)->addHours($isPaket2Jam ? 2 : 1)->format('H:i');
                @endphp
                <tr>
                    <td class="font-bold">{{ \Carbon\Carbon::parse($t->tgl_reservasi)->format('d/m/Y') }}</td>
                    <td>{{ $t->user->name }}</td>
                    <td>{{ $t->lapangan->nama_lapangan }}</td>
                    <td class="text-center">
                        <span class="badge-durasi font-mono">{{ $jamMulai }}-{{ $jamSelesai }}</span>
                    </td>
                    <td class="text-right font-bold" style="color: #15803d;">
                        Rp {{ number_format($t->total_biaya, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 30px 0; color: #94a3b8; font-style: italic;">
                        Tidak ada riwayat pembukuan kas masuk pada periode bulan ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- KOTAK REKAP AKUMULASI HASIL AKHIR -->
    <div class="total-section">
        <div class="total-box">
            <p class="label">Total Akumulasi Pendapatan</p>
            <p class="value">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- NOTA PENUTUP SISTEM -->
    <div style="clear: both;"></div>
    <div class="footer-note">
        Dokumen ini dihasilkan secara otomatis oleh Sistem Admin SM Sport Center.<br>
        Seluruh data nominal yang tertera bersifat sah dan sesuai dengan rekap database log transaksi.
    </div>

</body>
</html>
