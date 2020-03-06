<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("kecamatan_id");
            $table->unsignedBigInteger('jenjang_pendidikan_id');
            $table->year('tahun');
            $table->string('jenis_sekolah');
            $table->string('jumlah');
            $table->timestamps();

            $table->foreign("kecamatan_id")
                ->references("id")->on("kecamatan");

            $table->foreign("jenjang_pendidikan_id")
                ->references("id")->on("jenjang_pendidikan");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sekolah');
    }
}
