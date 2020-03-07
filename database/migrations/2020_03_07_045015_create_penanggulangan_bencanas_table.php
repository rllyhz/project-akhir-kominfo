<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenanggulanganBencanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penanggulangan_bencanas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tahun',0);
            $table->string('penyebab','100');
            $table->string('tempat_kebakaran','100');
            $table->integer('jumlah');
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
        Schema::dropIfExists('penanggulangan_bencanas');
    }
}
