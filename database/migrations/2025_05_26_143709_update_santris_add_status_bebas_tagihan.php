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
        Schema::table('santris', function (Blueprint $table) {
            $table->enum('bebas_daftar_ulang',['true', 'false'])->default('false');
            $table->enum('bebas_semester',['true', 'false'])->default('false');
            $table->enum('bebas_iuran',['true', 'false'])->default('false');
            $table->enum('status_aktif_santri',['aktif', 'tidak_aktif'])->default('aktif');
            $table->unsignedBigInteger('id_admin_author')->nullable();

            $table->index('status_aktif_santri');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->dropColumn('bebas_daftar_ulang');
            $table->dropColumn('bebas_semester');
            $table->dropColumn('bebas_iuran');
            $table->dropColumn('status_aktif_santri');
            $table->dropColumn('id_admin_author');
        });
    }
};
