<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_pengembalian', function (Blueprint $table){

            $table->id();
            $table->unsignedBigInteger('pengembalian_id');
            $table->unsignedBigInteger('buku_id');
            $table->integer('jumlah');
            $table->text('catatan');
            $table->integer('denda');

            $table->foreign('pengembalian_id')->references('id')->on('pengembalian');
            $table->foreign('buku_id')->references('id')->on('books');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
