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
            'akses_santri' => 'semua',
            'no_hp_admin' => '08123456789'
        ]);

        User::create([
            'nama_admin' => 'Admin Pembayaran Putra',
            'email' => 'pembayaranpa@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_pembayaran',
            'akses_santri' => 'putra',
            'no_hp_admin' => '08123456780'
        ]);

        User::create([
            'nama_admin' => 'Admin Pembayaran Putra',
            'email' => 'pembayaranpi@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_pembayaran',
            'akses_santri' => 'putri',
            'no_hp_admin' => '08123456780'
        ]);

        User::create([
            'nama_admin' => 'Admin Penilaian Putra',
            'email' => 'penilaianpa@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_penilaian',
            'akses_santri' => 'putra',
            'no_hp_admin' => '08123456781'
        ]);

        User::create([
            'nama_admin' => 'Admin Penilaian Putri',
            'email' => 'penilaianpi@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_penilaian',
            'akses_santri' => 'putri',
            'no_hp_admin' => '08123456781'
        ]);
    }
}
