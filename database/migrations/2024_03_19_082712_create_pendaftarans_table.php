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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id('id_pendaftar');
            $table->string('kode_pendaftaran');
            
            //Identitas calon santri
            $table->string('nama_pendaftar');
            $table->string('no_identitas')->nullabel();
            $table->string('tempat_tanggal_lahir_pendaftar');
            $table->enum('jenis_kelamin_pendaftar', ['laki-laki', 'perempuan']); 
            $table->string('rt');  
            $table->string('rw');  
            $table->string('dusun')->nullable();  
            $table->string('desa');  
            $table->string('kecamatan');  
            $table->string('kab_kota');  
            $table->string('provinsi');  
            $table->string('kode_pos');
            $table->string('no_hp_pendaftar');
            $table->string('email_pendaftar')->unique();
            $table->date('mulai_masuk_tanggal');
            $table->string('jumlah_saudara_kandung');
            $table->string('anak_ke');

            //Identitas orang tua calon santri
            //Ayah
            $table->string('nama_ayah_pendaftar');
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->integer('pendapatan_ayah_perbulan');

            //Ibu
            $table->string('nama_ibu_pendaftar');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->integer('pendapatan_ibu_perbulan');

            //Identitas wali calon santri
            $table->string('nama_wali_pendaftar');
            $table->string('no_identitas_wali');
            $table->string('tempat_tanggal_lahir_wali');
            $table->string('rt_wali');  
            $table->string('rw_wali');  
            $table->string('dusun_wali')->nullable();  
            $table->string('desa_wali')->nullable();  
            $table->string('kecamatan_wali');  
            $table->string('kab_kota_wali');  
            $table->string('provinsi_wali');  
            $table->string('kode_pos_wali');
            $table->string('status_wali');
            $table->string('no_hp_wali_pendaftar');
            $table->string('email_wali_pendaftar')->unique();
            $table->string('pendidikan_wali');
            $table->string('pekerjaan_wali');
            $table->integer('pendapatan_wali_perbulan');

            //Berkas-berkas
            $table->string('ktp_pendaftar')->nullable();
            $table->string('kk_pendaftar');
            $table->string('akta_pendaftar');
            $table->string('pas_foto_pendaftar');
            $table->enum('status',['sudah_verifikasi', 'belum_verifikasi'])->default('belum_verifikasi');
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
        Schema::dropIfExists('pendaftarans');
    }
};
