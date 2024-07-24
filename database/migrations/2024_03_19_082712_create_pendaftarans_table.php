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
            $table->string('nama_pendaftar');
            $table->string('tempat_tanggal_lahir_pendaftar');
            $table->enum('jenis_kelamin_pendaftar', ['laki-laki', 'perempuan']); 
            $table->string('alamat_pendaftar');  
            $table->string('no_hp_pendaftar');
            $table->string('email_pendaftar')->unique();
            $table->string('ktp_pendaftar');
            $table->string('kk_pendaftar');
            $table->string('akta_pendaftar');
            $table->string('pas_foto_pendaftar');
            $table->string('nama_wali_pendaftar');
            $table->string('no_hp_wali_pendaftar');
            $table->string('email_wali_pendaftar')->unique();
            $table->string('alamat_wali_santri');
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
