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
        Schema::create('nilai_santris', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->unsignedBigInteger('id_santri');
            $table->string('semester_ajaran');
            $table->string('tahun_ajaran');
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
            $table->integer('nilai');
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
        Schema::dropIfExists('nilai_santris');
    }
};
