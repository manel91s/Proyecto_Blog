<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->foreign('id_role')->references('id')->on('role');
        });

        Schema::table('comment', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('user');
            $table->foreign('id_post')->references('id')->on('post');
            
        });

        Schema::table('post', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_category')->references('id')->on('category')->onDelete('cascade');
            
        });

        Schema::table('like', function (Blueprint $table) {
            $table->foreign('id_post')->references('id')->on('post');
            $table->foreign('id_user')->references('id')->on('user');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('constraints', function (Blueprint $table) {
            //
        });
    }
}
