<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriOutlet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_outlet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nm_kategori_outlet', 50);
            $table->tinyInteger('sts_tampil', 2);
            $table->string('gbr_kategori_outlet', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_outlet');
    }
}
