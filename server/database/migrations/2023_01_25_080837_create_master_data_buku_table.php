<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterDataBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_data_buku', function (Blueprint $table) {
            $table->id();
            $table->string('nama_buku');
            $table->string('jlh_halaman');
            $table->text('cover_buku');
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('isbn');
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
        Schema::dropIfExists('master_data_buku');
    }
}
