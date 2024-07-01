<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Runtuk menambahkan table
     */
    public function up(): void
    {
        Schema::create('todo', function (Blueprint $table) {
            $table->id();
            $table->string('task');
            $table->boolean('is_done')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Untuk menghapus table
     */
    public function down(): void
    {
        Schema::dropIfExists('todo');
    }
};
