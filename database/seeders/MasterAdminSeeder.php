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
            [
                'jenis_pembayaran' => 'pendaftaran',
                'keterangan_pembayaran' => 'Pendaftaran Baru',
                'jumlah_pembayaran' => 250000,
            ],
            [
                'jenis_pembayaran' => 'pendaftaran',
                'keterangan_pembayaran' => 'Pendaftaran Ulang',
                'jumlah_pembayaran' => 100000,
            ],
            [
                'jenis_pembayaran' => 'semester',
                'keterangan_pembayaran' => 'Semester',
                'jumlah_pembayaran' => 100000,
            ],
            [
                'jenis_pembayaran' => 'iuran',
                'keterangan_pembayaran' => 'Makan & Transport',
                'jumlah_pembayaran' => 300000,
            ],
            [
                'jenis_pembayaran' => 'iuran',
                'keterangan_pembayaran' => 'Ziarah',
                'jumlah_pembayaran' => 50000,
            ],
        ];

        foreach ($masteradminsData as $data) {
            MasterAdmin::create($data);
        }
    }
}
