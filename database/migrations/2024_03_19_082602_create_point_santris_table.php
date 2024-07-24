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
        Schema::create('point_santris', function (Blueprint $table) {
            $table->id('id_point_santri');
            $table->unsignedBigInteger('id_santri')->nullable();
            $table->dateTime('tanggal_point_santri');
            $table->enum('semester_ajaran', ['ganjil', 'genap']);
            $table->year('tahun_ajaran');
            $table->enum('jenis_point_santri',[
                'A',
                'B',
                'C',
                'D',
                'E'
            ]);
            $table->integer('jumlah_point_santri');
            $table->string('deskripsi_point_santri');
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
        Schema::dropIfExists('point_santris');
    }
};
