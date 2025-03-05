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
        Schema::create('master_admin_rincian', function (Blueprint $table) {
            $table->id('id_master_admin_rincian');
            $table->enum('jenis_mukim',['mukim', 'tdk_mukim']);
            $table->enum('jenis_pembayaran',['pendaftaran_baru', 'pendaftaran_ulang', 'semester', 'iuran']);
            $table->enum('jenis_santri',['l', 'p', 'c']);
            $table->string('keterangan_pembayaran');
            $table->decimal('jumlah_pembayaran', 50, 0);
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
        Schema::dropIfExists('master_admin_rincian');
    }
};
