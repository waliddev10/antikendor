<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPkbHitamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pkb_hitam', function (Blueprint $table) {
            $table->id();
            $table->string('no_pol');
            $table->string('nama');
            $table->string('alamat');
            $table->string('jenis_kendaraan');
            $table->string('merk_kendaraan');
            $table->string('mesin_kendaraan');
            $table->string('status_kendaraan');
            $table->string('no_hp')->nullable();
            $table->string('nilai_pokok_pkb')->nullable();
            $table->string('nilai_denda_pkb')->nullable();
            $table->date('tgl_akhir_pkb')->nullable();
            $table->date('tgl_akhir_stnk')->nullable();
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
        Schema::dropIfExists('data_pkb_hitam');
    }
};
