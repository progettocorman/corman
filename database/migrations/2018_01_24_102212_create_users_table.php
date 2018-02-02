<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->text('name');
          $table->text('second_name')->nullable();
          $table->text('last_name');
          $table->date('birth_date');
          $table->string('affiliation');
          $table->string('email')->unique();
          $table->string('password');
          $table->string('research');
          $table->string('user_image')->nullable();
          $table->char('sex')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
