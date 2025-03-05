<?php

namespace Database\Seeders;

use App\Models\MasterAdminRincian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterAdminRincianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masteradminrincianssData = 
        [
            // Pendaftaran Baru Mukim
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Infaq Pendaftaran Pondok & Madrasah',
                'jumlah_pembayaran' => 200000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'l',
                'keterangan_pembayaran' => 'Infaq Seragam Putra (sarung)',
                'jumlah_pembayaran' => 100000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'p',
                'keterangan_pembayaran' => 'Infaq Seragam Putri (sarung, baju, kerudung)',
                'jumlah_pembayaran' => 200000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Infaq Raport Madrasah',
                'jumlah_pembayaran' => 50000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Infaq Pembangunan',
                'jumlah_pembayaran' => 200000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Infaq Al Qur\'an',
                'jumlah_pembayaran' => 65000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Kartu Santri',
                'jumlah_pembayaran' => 15000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Buku Saku Santri',
                'jumlah_pembayaran' => 20000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Infaq Almari',
                'jumlah_pembayaran' => 150000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Tamrin/ujian semester 1 dan 2',
                'jumlah_pembayaran' => 100000,
            ],

            // Pendaftaran Ulang Mukim
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_ulang',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Infaq daftar ulang pondok dan madrasah (Santri Lama)',
                'jumlah_pembayaran' => 100000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_ulang',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Haul dan Maulud',
                'jumlah_pembayaran' => 100000,
            ],

            // Semester Mukim
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Syahriyah',
                'jumlah_pembayaran' => 180000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Sarana Listrik & Air',
                'jumlah_pembayaran' => 120000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Tabungan Haflah',
                'jumlah_pembayaran' => 100000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Ujian Semester',
                'jumlah_pembayaran' => 50000,
            ],

            // Iuran Mukim
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'iuran',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Kos makan (2X sehari)',
                'jumlah_pembayaran' => 360000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'iuran',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Transportasi sekolah formal',
                'jumlah_pembayaran' => 60000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'iuran',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Tabungan Ziarah',
                'jumlah_pembayaran' => 50000,
            ],


            // Pendaftaran Baru Non Mukim 
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Infaq Pendaftaran Pondok & Madrasah',
                'jumlah_pembayaran' => 100000,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'l',
                'keterangan_pembayaran' => 'Infaq Seragam Putra (sarung)',
                'jumlah_pembayaran' => 100000,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'p',
                'keterangan_pembayaran' => 'Infaq Seragam Putri (sarung, baju, kerudung)',
                'jumlah_pembayaran' => 200000,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Infaq Raport Madrasah',
                'jumlah_pembayaran' => 50000,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Tamrin/ujian semester 1 dan 2',
                'jumlah_pembayaran' => 100000,
            ],

            // Pendaftaran Ulang Non Mukim
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_ulang',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Infaq Daftar Ulang (Santri Lama)',
                'jumlah_pembayaran' => 50000,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_ulang',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Haul dan Maulud',
                'jumlah_pembayaran' => 100000,
            ],

            // Semester Non Mukim
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Syahriyah',
                'jumlah_pembayaran' => 100000,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Tabungan Haflah',
                'jumlah_pembayaran' => 100000,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'c',
                'keterangan_pembayaran' => 'Ujian Semester',
                'jumlah_pembayaran' => 50000,
            ],
        ];

        foreach ($masteradminrincianssData as $data) {
            MasterAdminRincian::create($data);
        }
    }
}
