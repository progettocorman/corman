<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications_tag', function (Blueprint $table) {
            $table->increments('id');//id tag della pubblicazione      
            $table->integer('publications_id')->unsigned();//id della pubblicazione
            $table->foreign('publications_id')->references('id')->on('publications'); //
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
        Schema::dropIfExists('publications_tag');
    }
}
