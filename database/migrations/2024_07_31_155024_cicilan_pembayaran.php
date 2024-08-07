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
        Schema::create('cicilan_pembayarans', function (Blueprint $table) {
            $table->id('id_cicilan_pembayarans');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->unsignedBigInteger('id_pembayaran')->nullable();
            $table->decimal('sub_bayar_cicilan', 15, 2);
            $table->date('tanggal_bayar')->nullable();
            $table->timestamps();
            
            $table->foreign('id_pembayaran')->references('id_pembayaran')->on('pembayarans');
            $table->foreign('id_admin')->references('id_admin')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cicilan_pembayarans');
    }
};
