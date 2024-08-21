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
            //?Identitas Santri
            $table->string('nama_santri');
            $table->string('no_induk')->nullable();
            $table->enum('status_santri', ['mukim','tidak_mukim'])->default('mukim');
            $table->string('no_identitas');
            $table->string('tempat_lahir_santri');
            $table->date('tanggal_lahir_santri');
            $table->enum('jenis_kelamin_santri', ['laki-laki', 'perempuan']); 
            // Alamat
            $table->string('rt');  
            $table->string('rw');  
            $table->string('dusun')->nullable();  
            $table->string('desa')->nullable();  
            $table->string('kecamatan');  
            $table->string('kab_kota');  
            $table->string('provinsi');  
            $table->string('kode_pos');
            // Email
            $table->string('no_hp_santri')->nullable();
            $table->string('email_santri')->unique();
            // Lain-lain
            $table->string('tahun_masuk');
            $table->enum('tingkatan', ['1', '2', '3', '4', '5', '6', '1_TSA', '2_TSA', '3_TSA', 'Pengurus'])->default('1');
            $table->string('jumlah_saudara_kandung')->nullable();
            $table->string('anak_ke')->nullable();

            //?Identitas orang tua santri
            //Ayah
            $table->string('nama_ayah');
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pendapatan_ayah_perbulan')->nullable();
            //Ibu
            $table->string('nama_ibu');
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pendapatan_ibu_perbulan')->nullable();

            //?Berkas-berkas
            $table->string('ktp_santri')->nullable();
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
