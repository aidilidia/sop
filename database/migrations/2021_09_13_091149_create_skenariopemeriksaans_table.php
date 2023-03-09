<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkenariopemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skenariopemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->string('level1');
            $table->string('level2');
            $table->string('level3')->nullable();
            $table->string('level4')->nullable();
            $table->string('level5')->nullable();
            $table->string('level6')->nullable();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->timestamps();
            $table->softDeletes("deleted_at", 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skenariopemeriksaans');
    }
}
