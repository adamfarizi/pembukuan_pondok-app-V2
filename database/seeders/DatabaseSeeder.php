<?php

namespace Database\Seeders;

use App\Models\MasterGuest;
use App\Models\Santri;
use App\Models\Pemasukan;
use App\Models\Pembayaran;
use App\Models\WaliSantri;
use App\Models\Pengeluaran;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\PembayaranSeeder;
use Database\Seeders\WaliSantriSeeder;
use Database\Seeders\MasterAdminSeeder;
use Database\Seeders\MasterGuestSeeder;
use Database\Seeders\MasterGuestFotoSeeder;
use Database\Seeders\MasterGuestMisiSeeder;
use Database\Seeders\MasterGuestRekeningSeeder;
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
            // WaliSantriSeeder::class,
            // PendaftaranSeeder::class,
        ]);

        // Santri::factory(2)->create();
        // WaliSantri::factory(2)->create();
        // Pemasukan::factory(10)->create();
        // Pengeluaran::factory(10)->create();
        
        $this->call([
            // NilaiSantriSeeder::class,
            HafalanSeeder::class,
            // PengajarSeeder::class,
            MasterAdminSeeder::class,
            MasterGuestSeeder::class,
            MasterGuestFotoSeeder::class,
            MasterGuestMisiSeeder::class,
            MasterGuestRekeningSeeder::class,
            // PembayaranSeeder::class,
        ]);
    }
}
