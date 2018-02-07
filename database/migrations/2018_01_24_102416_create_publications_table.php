<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->text("title");//titolo della pubblicazione
          $table->text("venue")->nullable();//rivista di pubblicazione
          $table->text("volume")->nullable();//volume della rivista
          $table->text("number")->nullable();//numero della rivista
          $table->text("pages")->nullable();//pagine della rivista
          $table->text("year");//anno di pubblicazione
          $table->text("type");//tipo di pubblicazione
          $table->text("key")->nullable();//The key can also be found as the "key" attribute of the record in the record's XML export.(dal faq di dblp)
          $table->text("doi")->nullable();// id identificativo della pubblicazione (http://dblp.uni-trier.de/doi/)
          $table->text("ee")->nullable();// Link alla risorsa (pdf o sito su cui comprare il pdf)
          $table->text("url")->nullable();// Link alla pagina di dblp
          $table->string("dbKey")->unique();//Chiave di riconoscimento pubblicazione nel db <-> md5(title)
          $table->integer('topics_id')->unsigned();// Link 
          $table->foreign('topics_id')->references('id')->on('topics');//Chiave di riconoscimento pubblicazione nel db topics

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
}
