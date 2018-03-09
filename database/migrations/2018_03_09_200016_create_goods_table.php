<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('desc');
            $table->string('tag');
            $table->string('url');
            $table->decimal('price');
            $table->unsignedSmallInteger('level');
            $table->mediumText('x_content');
            $table->mediumText('cover');
            $table->string('author');
            $table->dateTime('ttm');
            $table->unsignedSmallInteger('released');
            $table->unsignedSmallInteger('recommend');
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
        Schema::dropIfExists('goods');
    }
}
