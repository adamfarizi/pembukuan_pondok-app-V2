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
            $table->string('nama_santri');
            $table->string('tempat_tanggal_lahir_santri');
            $table->string('no_hp_santri');
            $table->string('email_santri')->unique();
            $table->enum('jenis_kelamin_santri', ['laki-laki', 'perempuan']); 
            $table->string('status_santri');
            $table->string('alamat_santri');  
            $table->string('ktp_santri');
            $table->string('kk_santri');
            $table->string('akta_santri');
            $table->string('pas_foto_santri');
            $table->string('tahun_masuk');
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
