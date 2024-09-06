<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterGuestRekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_guests_rekening')->insert([
            'id_guest' => 1,
            'rekening' => 'Bank BCD: 1234567890 a/n Pusat Pendidikan ABC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);   
    }
}
