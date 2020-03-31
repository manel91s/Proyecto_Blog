<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {

            //Create table
            $table->increments('id');
            $table->timestamps();
            $table->string('name',20);
            $table->string('surname',45);
            $table->string('email');
            $table->string('password',255);
            $table->string('avatar_url',255);
            $table->integer('id_role')->unsigned();
            $table->engine='InnoDB';
            
            //Constraints
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
        
    }
}
