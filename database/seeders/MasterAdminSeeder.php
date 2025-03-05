<?php

namespace Database\Seeders;

use App\Models\MasterAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masteradminsData = [
            // Pendaftaran Baru Mukim
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'l',
                'total_pembayaran' => 900000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'p',
                'total_pembayaran' => 1000000,
            ],

            // Pendaftaran Ulang Mukim
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_ulang',
                'jenis_santri' => 'l',
                'total_pembayaran' => 200000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'pendaftaran_ulang',
                'jenis_santri' => 'p',
                'total_pembayaran' => 200000,
            ],

            // Semester Mukim
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'l',
                'total_pembayaran' => 450000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'p',
                'total_pembayaran' => 450000,
            ],

            // Iuran Mukim
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'iuran',
                'jenis_santri' => 'l',
                'total_pembayaran' => 470000,
            ],
            [
                'jenis_mukim' => 'mukim',
                'jenis_pembayaran' => 'iuran',
                'jenis_santri' => 'p',
                'total_pembayaran' => 470000,
            ],


            // Pendaftaran Baru Non Mukim
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'l',
                'total_pembayaran' => 350000,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_baru',
                'jenis_santri' => 'p',
                'total_pembayaran' => 450000,
            ],

            // Pendaftaran Ulang Non Mukim
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_ulang',
                'jenis_santri' => 'l',
                'total_pembayaran' => 150000,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'pendaftaran_ulang',
                'jenis_santri' => 'p',
                'total_pembayaran' => 150000,
            ],

            // Semester Non Mukim
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'l',
                'total_pembayaran' => 250000,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'semester',
                'jenis_santri' => 'p',
                'total_pembayaran' => 250000,
            ],

            // Iuran Non Mukim
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'iuran',
                'jenis_santri' => 'l',
                'total_pembayaran' => 0,
            ],
            [
                'jenis_mukim' => 'tdk_mukim',
                'jenis_pembayaran' => 'iuran',
                'jenis_santri' => 'p',
                'total_pembayaran' => 0,
            ],
        ];

        foreach ($masteradminsData as $data) {
            MasterAdmin::create($data);
        }
    }
}
