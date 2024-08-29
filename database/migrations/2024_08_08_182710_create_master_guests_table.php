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
        Schema::create('master_guests', function (Blueprint $table) {
            $table->id('id_guest');
            $table->text('visi');
            $table->string('lokasi');
            $table->text('linkgmaps');
            $table->string('no_tlp');
            $table->string('email')->unique;
            $table->string('instagram');
            $table->string('youtube');
            $table->string('facebook');
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
        Schema::dropIfExists('master_guests');
    }
};
