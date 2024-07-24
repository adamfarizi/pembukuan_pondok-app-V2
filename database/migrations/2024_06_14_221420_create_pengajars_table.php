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
        Schema::create('pengajars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengajar');
            $table->string('nomor_hp_pengajar')->unique();
            $table->enum('mata_pelajaran', [
                'al_quran_tajwid',
                'bahasa_arab',
                'fiqh',
                'hadist',
                'aqidah',
                'sirah_nabawiyyah',
                'tazkiyatun_nafs',
                'tarikh'
            ]);
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
        Schema::dropIfExists('pengajars');
    }
};
