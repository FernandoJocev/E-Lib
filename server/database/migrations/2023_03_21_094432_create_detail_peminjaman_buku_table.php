<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPeminjamanBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_peminjaman_buku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjaman');
            $table->foreign('id_peminjaman')->references('id')->on('master_data_peminjaman_buku')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_buku');
            $table->foreign('id_buku')->references('id')->on('master_data_buku')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jlh');
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
        Schema::dropIfExists('detail_peminjaman_buku');
    }
}
