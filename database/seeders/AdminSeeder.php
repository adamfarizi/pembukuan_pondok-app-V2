<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'nama_admin' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'no_hp_admin' => '08123456789'
        ]);

        User::create([
            'nama_admin' => 'Admin Pembayaran',
            'email' => 'pembayaran@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_pembayaran',
            'no_hp_admin' => '08123456780'
        ]);

        User::create([
            'nama_admin' => 'Admin Penilaian',
            'email' => 'penilaian@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_penilaian',
            'no_hp_admin' => '08123456781'
        ]);
    }
}
