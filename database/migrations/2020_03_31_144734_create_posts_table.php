<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            //create table
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_user')->unsigned();
            $table->integer('id_category')->unsigned();
            $table->string('image',255);
            $table->string('cover',255);
            $table->string('title',20);
            $table->integer('featured');
            $table->text('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post');
    }
}
