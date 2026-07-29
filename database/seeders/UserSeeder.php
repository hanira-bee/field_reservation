<?php

namespace Database\Seeders;

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
        User::updateOrCreate(
            ['email' => 'superadmin1@gmail.com'], 
            [
                'name' => 'Super Admin',
                'password' => Hash::make('superadmin123'),
                'no_telepon' => '081234567890',
                'tgl_daftar' => Carbon::parse('2026-06-04'),
                'role' => 'super_admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin1@gmail.com'], 
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'no_telepon' => '081234567890',
                'tgl_daftar' => Carbon::parse('2026-06-04'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'dimas@gmail.com'], 
            [
                'name' => 'Dimas',
                'no_telepon' => '081234567890',
                'password' => Hash::make('dimas123'),
                'tgl_daftar' => Carbon::parse('2026-06-04'),
                'role' => 'pelanggan',
            ]
        );
    }
}
