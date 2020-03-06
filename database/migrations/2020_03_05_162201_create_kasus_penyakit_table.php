<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKasusPenyakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasus_penyakit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->year('tahun');
            $table->unsignedBigInteger('jenis_penyakit_id');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('jenis_penyakit_id')
                ->references('id')->on('jenis_penyakit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kasus_penyakit');
    }
}
