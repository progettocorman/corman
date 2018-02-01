<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n_types', function (Blueprint $table) {
            /*
              0 = CoAuthor Notifications
              1 = Group Partecipation Notifications
              2 = Group Partecipation Invitations Notifications
              //todo
            */
            $table->integer('id')->unsigned()->primary();
            $table->string('description');
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
        Schema::dropIfExists('n_types');
    }
}
