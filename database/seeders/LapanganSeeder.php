<?php

namespace Database\Seeders;

use App\Models\Lapangan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lapangan::query()->delete();

        Lapangan::insert([
            [
                'nama_lapangan' => 'Lapangan Futsal Outdoor',
                'jenis_lapangan' => 'Futsal',
                'lokasi' => 'Jl. Raya Olahraga No. 123, Kota SehatBugar',
                'harga_per_jam' => 130000,
                'deskripsi' => 'Lapangan futsal dengan rumput sintetis yang membantu meredam benturan, daya cengkram yang tinggi, berada di ruang terbuka dengan jaring pembatas dan lampu sorot agar mendukung pencahayaan yang baik ketika permainan dimulai.',
                'fasilitas' => 'Rumput sintetis, Lampu sorot, Ruang ganti, Toilet, Parkir motor, Parkir mobil',
                'ukuran' => '38 meter x 18 meter',
                'gambar' => 'futsal_outdoor.jpg',
                'status_aktif' => true,
                'created_at' => Carbon::parse('2026-06-04 14:30:00'),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lapangan' => 'Lapangan Futsal Indoor',
                'jenis_lapangan' => 'Futsal',
                'lokasi' => 'Jl. Raya Olahraga No. 456, Kota SehatBugar',
                'harga_per_jam' => 150000,
                'deskripsi' => 'Rumput sintetis yang empuk, dengan redaman benturan yang baik dan memiliki daya cengkram sehingga tidak licin dan meminimalisir risiko cedera. Berada di dalam ruang, cocok untuk latihan atau turnamen di cuaca tidak menentu.',
                'fasilitas' => 'Rumput sintetis, Lampu sorot, Ruang ganti, Toilet, Parkir motor, Parkir mobil',
                'ukuran' => '40 meter x 20 meter',
                'gambar' => 'futsal_indoor.jpg',
                'status_aktif' => true,
                'created_at' => Carbon::parse('2026-06-04 14:30:00'),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lapangan' => 'Lapangan Badminton Outdoor',
                'jenis_lapangan' => 'Badminton',
                'lokasi' => 'Jl. Raya Olahraga No. 789, Kota SehatBugar',
                'harga_per_jam' => 50000,
                'deskripsi' => 'Fasilitas lapangan dengan area terbuka yang nyaman, pagar jaring yang mengelilingi lapangan dengan lantai semen untuk membuat gerakan semakin lincah dan gesit.',
                'fasilitas' => 'Lantai Semen, Lampu sorot, Ruang ganti, Toilet, Parkir motor, Parkir mobil',
                'ukuran' => '12,40 meter x 6,10 meter',
                'gambar' => 'badminton_outdoor.jpg',
                'status_aktif' => true,
                'created_at' => Carbon::parse('2026-06-04 14:30:00'),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lapangan' => 'Lapangan Badminton Indoor 1',
                'jenis_lapangan' => 'Badminton',
                'lokasi' => 'Jl. Raya Olahraga No. 101, Kota SehatBugar',
                'harga_per_jam' => 60000,
                'deskripsi' => 'Lantai karpet sintetis yang empuk yang dapat meredam benturan dan daya cengkram yang baik dengan lampu sorot dengan pencahayaan yang baik sebagai tempat yang nyaman untuk bermain badminton.',
                'fasilitas' => 'Karpet sintetis, Lampu sorot, Ruang ganti, Toilet, Parkir motor, Parkir mobil',
                'ukuran' => '13,40 meter x 6,10 meter',
                'gambar' => 'badminton_indoor.jpg',
                'status_aktif' => true,
                'created_at' => Carbon::parse('2026-06-04 14:30:00'),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lapangan' => 'Lapangan Badminton Indoor 2',
                'jenis_lapangan' => 'Badminton',
                'lokasi' => 'Jl. Raya Olahraga No. 202, Kota SehatBugar',
                'harga_per_jam' => 55000,
                'deskripsi' => 'Lapangan indoor dengan permukaan lantai semen yang memberikan kebebasan bergerak dan kelincahan kaki anda.',
                'fasilitas' => 'Lantai semen, Lampu sorot, Ruang ganti, Toilet, Parkir motor, Parkir mobil',
                'ukuran' => '13,40 meter x 6,10 meter',
                'gambar' => 'badminton_indoor1.jpg',
                'status_aktif' => true,
                'created_at' => Carbon::parse('2026-06-04 14:30:00'),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
