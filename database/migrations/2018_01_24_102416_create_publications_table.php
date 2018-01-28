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
          $table->string("title");//titolo della pubblicazione
          $table->string("venue")->nullable();//rivista di pubblicazione
          $table->string("volume")->nullable();//volume della rivista
          $table->string("number")->nullable();//numero della rivista
          $table->string("pages")->nullable();//pagine della rivista
          $table->string("year");//anno di pubblicazione
          $table->string("type");//tipo di pubblicazione
          $table->string("key")->nullable();//The key can also be found as the "key" attribute of the record in the record's XML export.(dal faq di dblp)
          $table->string("doi")->nullable();// id identificativo della pubblicazione (http://dblp.uni-trier.de/doi/)
          $table->string("ee")->nullable();// Link alla risorsa (pdf o sito su cui comprare il pdf)
          $table->string("url")->nullable();// Link alla pagina di dblp
          $table->string("dbKey")->unique();//Chiave di riconoscimento pubblicazione nel db <-> md5(title)
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
