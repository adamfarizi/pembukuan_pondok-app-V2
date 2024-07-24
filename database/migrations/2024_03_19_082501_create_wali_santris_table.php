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
        Schema::create('wali_santris', function (Blueprint $table) {
            $table->id('id_wali_santri');
            $table->unsignedBigInteger('id_santri')->nullable();
            $table->string('nama_wali_santri');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('role')->default('wali');
            $table->string('no_hp');
            $table->string('alamat_wali_santri');
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
        Schema::dropIfExists('wali_santris');
    }
};
