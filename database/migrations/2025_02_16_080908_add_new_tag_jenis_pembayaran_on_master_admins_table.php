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
        Schema::table('master_admin', function (Blueprint $table) {
            $table->enum('jenis_pembayaran', ['pendaftaran', 'semester', 'iuran', 'pendaftaran_ulang', 'pendaftaran_baru'])->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_admin', function (Blueprint $table) {
            $table->enum('jenis_pembayaran', ['pendaftaran', 'semester', 'iuran'])->change();
        });
    }
};
