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
        DB::statement("ALTER TABLE pembayarans MODIFY COLUMN status_pembayaran ENUM('belum_lunas', 'lunas', 'bebas_tagihan') NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE pembayarans MODIFY COLUMN status_pembayaran ENUM('belum_lunas', 'lunas') NULL");
    }
};
