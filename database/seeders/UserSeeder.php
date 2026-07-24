<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User: Admin
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin123'),
            'no_telepon' => '081234567890',
            'tanggal_daftar' => Carbon::parse('2026-06-04'),
            'role' => 'admin',
        ]);

        // User: Pelanggan
        User::create([
            'nama' => 'Dimas',
            'email' => 'dimas@gmail.com',
            'no_telepon' => '081234567890',
            'password' => Hash::make('dimas123'),
            'tanggal_daftar' => Carbon::parse('2026-06-04'),
            'role' => 'pelanggan',
        ]);
    }
}
