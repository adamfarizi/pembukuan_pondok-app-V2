<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterGuestMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_guests_misi')->insert([
            'id_guest' => 1,
            'misi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            'created_at' => now(),
            'updated_at' => now(),
        ]);   
    }
}
