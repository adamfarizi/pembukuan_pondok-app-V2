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
        Schema::create('santris', function (Blueprint $table) {
            $table->id('id_santri');
            //Identitas calon santri
            $table->string('nama_santri');
            $table->string('no_identitas');
            $table->string('tempat_tanggal_lahir_santri');
            $table->enum('jenis_kelamin_santri', ['laki-laki', 'perempuan']); 
            $table->string('rt');  
            $table->string('rw');  
            $table->string('dusun');  
            $table->string('desa');  
            $table->string('kecamatan');  
            $table->string('kab_kota');  
            $table->string('provinsi');  
            $table->string('kode_pos');
            $table->string('no_hp_santri');
            $table->string('email_santri')->unique();
            $table->string('mulai_masuk_tanggal');
            $table->string('jumlah_saudara_kandung');
            $table->string('anak_ke');

            //Identitas orang tua calon santri
            //Ayah
            $table->string('nama_ayah');
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('pendapatan_ayah_perbulan');

            //Ibu
            $table->string('nama_ibu');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('pendapatan_ibu_perbulan');

            //Identitas wali calon santri
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

            //Berkas-berkas
            $table->string('ktp_santri');
            $table->string('kk_santri');
            $table->string('akta_santri');
            $table->string('pas_foto_santri');
            $table->enum('status_santri',['sudah_verifikasi', 'belum_verifikasi'])->default('belum_verifikasi');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('santris');
    }
};
