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
        Schema::create('transaksi_item', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('id_transaksi');
            $table -> string('id_item');
            $table -> string('nama_barang');
            $table -> integer('harga');
            $table -> integer('quantity');
            $table->timestamps();
            $table -> foreign('id_transaksi') -> references('id') -> on('transaksi') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_item');
    }
};
