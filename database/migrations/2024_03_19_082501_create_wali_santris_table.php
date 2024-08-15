<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wali_santris', function (Blueprint $table) {
            $table->id('id_wali_santri');
            $table->unsignedBigInteger('id_santri')->nullable();
            $table->string('nama_wali');
            $table->string('no_identitas_wali');
            $table->string('tempat_tanggal_lahir_wali');
            $table->string('rt_wali');  
            $table->string('rw_wali');  
            $table->string('dusun_wali');  
            $table->string('desa_wali');  
            $table->string('kecamatan_wali');  
            $table->string('kab_kota_wali');  
            $table->string('provinsi_wali');  
            $table->string('kode_pos_wali');
            $table->string('status_wali');
            $table->string('no_hp_wali');
            $table->string('email_wali')->unique();
            $table->string('pendidikan_wali');
            $table->string('pekerjaan_wali');
            $table->string('pendapatan_wali_perbulan');
            $table->timestamps();

            $table->foreign('id_santri')->references('id_santri')->on('santris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wali_santris');
    }
};
