<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'], 
            [
                'name' => 'Test User',
                'no_telepon' => '081234567890',
                'role' => 'pelanggan', 
                'tgl_daftar' => now()->toDateString(),
                'password' => Hash::make('password'), 
            ]);

        $this->call([
            LapanganSeeder::class
            ]);
    }
}
