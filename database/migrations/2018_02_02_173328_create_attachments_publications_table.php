<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments_publications', function (Blueprint $table) {
          $table->integer('publication_id')->unsigned();
          $table->foreign('publication_id')->references('id')->on('publications');

          $table->longtext('namefile');
          $table->text('typefile');
          /*
          1 pdf
          2 images
          3 video
          4 rar
          */
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
        Schema::dropIfExists('attachments_publications');
    }
}
