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
        Schema::create('peminjaman_buku', function (Blueprint $table){

                $table->id();
                $table->unsignedBigInteger('peminjaman_id');
                $table->unsignedBigInteger('buku_id');
                $table->integer('jumlah');

                $table->foreign('buku_id')->references('id')->on('books');
                $table->foreign('peminjaman_id')->references('id')->on('peminjaman');

            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
