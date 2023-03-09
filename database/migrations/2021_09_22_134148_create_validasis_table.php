<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validasis', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('input_id');
            $table->foreign('input_id')->references('id')->on('inputs');
            
            $table->string('nama')->nullable();
            $table->string('kategori')->nullable();
            $table->json('keterkaitans')->nullable();
            $table->text('pelaksana')->nullable();
            $table->string('kualifikasi')->nullable();
            $table->integer('waktu')->nullable();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('file')->nullable();
            $table->boolean('validasi');
            $table->string('keterangan')->nullable()->comment('jika tidak valid');
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
        Schema::dropIfExists('validasis');
    }
}
