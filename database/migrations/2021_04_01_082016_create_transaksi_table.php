<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('kode_transaksi');

            // create mahasiswa foreign key
            $table->unsignedBigInteger('id_mhs');
            $table->foreign('id_mhs')->references('id_mhs')->on('mahasiswa');

            // create buku foreign key
            $table->unsignedBigInteger('id_buku');
            $table->foreign('id_buku')->references('id_buku')->on('buku');

            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->date('tgl_pengembalian');

            $table->integer('denda');

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
        Schema::dropIfExists('transaksi');
    }
}
