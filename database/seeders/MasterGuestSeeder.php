<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterGuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_guests')->insert([
            'visi' => 'Meningkatkan Kualitas Pendidikan Agama',
            'misi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Meningkatkan Kualitas Pendidikan Agama.',
            'foto' => 'path/to/foto.jpg',
            'lokasi' => 'Jalan Pondok Pesantren No. 1',
            'no_tlp' => '08123456789',
            'email' => 'info@pondok.com',
            'instagram' => '@pondok_instagram',
            'youtube' => 'Pondok Youtube Channel',
            'facebook' => 'Pondok Facebook Page',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
