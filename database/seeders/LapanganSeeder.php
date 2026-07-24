<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Lapangan;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lapangan::insert(
            [
                [
                    'nama_lapangan' => 'Lapangan Futsal Indoor',
                    'jenis_lapangan' => 'Futsal',
                    'lokasi' => 'Jl. Raya Olahraga No. 123, Kota ABC',
                    'harga_per_jam' => 150000,
                    'fasilitas' => 'Lampu sorot, ruang ganti, toilet, parkir',
                    'status_aktif' => 1,
                    'created_at' => Carbon::parse('2026-06-04 14:30:00'),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama_lapangan' => 'Lapangan Futsal Outdoor',
                    'jenis_lapangan' => 'Futsal',
                    'lokasi' => 'Jl. Lapangan No. 456, Kota XYZ',
                    'harga_per_jam' => 120000,
                    'fasilitas' => 'Lampu sorot, ruang ganti, toilet, parkir',
                    'status_aktif' => 1,
                    'created_at' => Carbon::parse('2026-06-04 14:30:00'),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama_lapangan' => 'Lapangan Badminton Indoor A',
                    'jenis_lapangan' => 'Badminton',
                    'lokasi' => 'Jl. Olahraga No. 789, Kota DEF',
                    'harga_per_jam' => 80000,
                    'fasilitas' => 'Lampu sorot, ruang ganti, toilet',
                    'status_aktif' => 1,
                    'created_at' => Carbon::parse('2026-06-04 14:30:00'),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama_lapangan' => 'Lapangan Badminton Indoor B',
                    'jenis_lapangan' => 'Badminton',
                    'lokasi' => 'Jl. Olahraga No. 101, Kota GHI',
                    'harga_per_jam' => 90000,
                    'fasilitas' => 'Lampu sorot, ruang ganti, toilet',
                    'status_aktif' => 1,
                    'created_at' => Carbon::parse('2026-06-04 14:30:00'),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama_lapangan' => 'Lapangan Badminton Outdoor',
                    'jenis_lapangan' => 'Badminton',
                    'lokasi' => 'Jl. Olahraga No. 202, Kota JKL',
                    'harga_per_jam' => 100000,
                    'fasilitas' => 'Lampu sorot, ruang ganti, toilet, parkir',
                    'status_aktif' => 1,
                    'created_at' => Carbon::parse('2026-06-04 14:30:00'),
                    'updated_at' => Carbon::now(),
                ]
                
            ]
        );
    }
}
