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
            'visi' => 'Membangun generasi yang beriman, bertakwa, berilmu, dan berakhlakul karimah melalui pendidikan yang komprehensif dan terpadu, serta menjadikan Pondok Pesantren Al Huda sebagai pusat unggulan dalam pengembangan ilmu agama dan ilmu pengetahuan.',
            'lokasi' => 'Jalan Pondok Pesantren No. 1',
            'linkgmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.357019913914!2d111.47367157477133!3d-8.267217041766779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e793f8702ac8951%3A0x58518eb6ffb8d3d7!2sPONDOK%20PESANTREN%20AL%20HUDA%20BANJAR%20PANGGUL!5e0!3m2!1sen!2sid!4v1709801452881!5m2!1sen!2sid',
            'no_tlp' => '08123456789',
            'email' => 'infopondok@gmail.com',
            'instagram' => '@pondok_instagram',
            'youtube' => 'https://www.youtube.com/',
            'facebook' => 'https://www.facebook.com/',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
