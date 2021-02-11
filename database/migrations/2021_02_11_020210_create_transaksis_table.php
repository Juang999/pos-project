<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable()->constrained('users');
            $table->foreignId('pj')->constrained('users');
            $table->foreignId('barang_id')->constrained('barangs');
            $table->bigInteger('kode_barang');
            $table->integer('keterangan');
            $table->integer('input')->nullable();
            $table->integer('output')->nullable();
            $table->double('debit')->nullable();
            $table->double('credit')->nullable();
            $table->double('saldo')->default(0);
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
        Schema::dropIfExists('transaksis');
    }
}
