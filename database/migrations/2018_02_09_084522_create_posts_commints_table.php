<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCommintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_commints', function (Blueprint $table) {
            
            $table->increments('id');//id del commento
           
            $table->integer('posts_id')->unsigned();//id del post
            $table->foreign('posts_id')->references('id')->on('posts'); //chiave esterna sul post

            $table->integer('user_id')->unsigned();//id dell'utente che fa il commento
            $table->foreign('user_id')->references('id')->on('users'); // chiave esterna sull'utente che commenta
            
            $table->text('value');
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
        Schema::dropIfExists('posts_commints');
    }
}
