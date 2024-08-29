<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterGuestFotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_guests_foto')->insert([
            'id_guest' => 1,
            'foto' => 'area_pondok1.JPG',            
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
