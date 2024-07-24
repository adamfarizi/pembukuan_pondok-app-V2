<?php

namespace Database\Seeders;

use App\Models\Santri;
use App\Models\Pemasukan;
use App\Models\Pembayaran;
use App\Models\WaliSantri;
use App\Models\Pengeluaran;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\PembayaranSeeder;
use Database\Seeders\WaliSantriSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            WaliSantriSeeder::class,
            PendaftaranSeeder::class,
        ]);

        Santri::factory(2)->create();
        WaliSantri::factory(2)->create();
        Pemasukan::factory(10)->create();
        Pengeluaran::factory(10)->create();
        
        $this->call([
            // PembayaranSeeder::class,
            NilaiSantriSeeder::class,
            HafalanSeeder::class,
            PengajarSeeder::class,
        ]);
    }
}
