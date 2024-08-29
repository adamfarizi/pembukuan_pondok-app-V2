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
        Schema::create('master_guests_foto', function (Blueprint $table) {
            $table->id('id_foto');
            $table->unsignedBigInteger('id_guest')->nullable();
            $table->string('foto');
            $table->timestamps();

            $table->foreign('id_guest')->references('id_guest')->on('master_guests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_guests_foto');
    }
};
