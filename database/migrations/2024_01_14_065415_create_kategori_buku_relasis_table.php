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
        Schema::create('kategori_buku_relasis', function (Blueprint $table) {
            $table->id('kategoribuku_id');
            $table->unsignedBigInteger('kategori_id');
            $table->string('buku_id', 10);
            $table->timestamps();

            $table->foreign('kategori_id')->references('kategori_id')->on('kategori_bukus')->onDelete('cascade');
            $table->foreign('buku_id')->references('buku_id')->on('bukus')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_buku_relasis');
    }
};
