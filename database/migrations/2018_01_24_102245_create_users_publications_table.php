<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*
        0 = Public Visibility
        1 = Private Visibility
        2 = Just me Visibility
      */
        Schema::create('users_publications', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->nullable();

            $table->integer('publication_id')->unsigned();
            $table->foreign('publication_id')->references('id')->on('publications')->nullable();

            $table->integer('visibility')->unsigned();

            $table->string('author_name')->nullable();
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
        Schema::dropIfExists('users_publications');
    }
}
