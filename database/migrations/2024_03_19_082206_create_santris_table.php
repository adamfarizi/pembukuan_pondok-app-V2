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
            $table->string('tahun_masuk');
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

            //Berkas-berkas
            $table->string('ktp_santri');
            $table->string('kk_santri');
            $table->string('akta_santri');
            $table->string('pas_foto_santri');
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
