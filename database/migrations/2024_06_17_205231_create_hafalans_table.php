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
        Schema::create('hafalans', function (Blueprint $table) {
            $table->id('id_hafalan');
            $table->unsignedBigInteger('id_santri');
            $table->integer('surah');
            $table->integer('total_ayat');
            $table->integer('progress_ayat');
            $table->enum('status', ['hafal', 'proses'])->default('proses');
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
        Schema::dropIfExists('hafalans');
    }
};
