<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('id_buku');

            // create kategori foreign key
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');

            // create penerbit foreign key
            $table->unsignedBigInteger('id_penerbit');
            $table->foreign('id_penerbit')->references('id_penerbit')->on('penerbit');

            $table->string('isbn');
            $table->string('judul');
            $table->char('tahun_terbit', 4);
            $table->integer('jumlah');
            $table->text('gambar');

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
        Schema::dropIfExists('buku');
    }
}
