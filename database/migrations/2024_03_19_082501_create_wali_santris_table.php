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
            //? Identitas Wali
            $table->string('nama_wali');
            $table->string('no_identitas_wali');
            $table->string('tempat_lahir_wali');
            $table->date('tanggal_lahir_wali');
            // Alamat
            $table->string('rt_wali');  
            $table->string('rw_wali');  
            $table->string('dusun_wali')->nullable();  
            $table->string('desa_wali')->nullable();  
            $table->string('kecamatan_wali');  
            $table->string('kab_kota_wali');  
            $table->string('provinsi_wali');  
            $table->string('kode_pos_wali');
            // Email
            $table->string('no_hp');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('wali_santri');
            // Lain-lain
            $table->string('status_wali');
            $table->string('pendidikan_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('pendapatan_wali_perbulan')->nullable();
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
