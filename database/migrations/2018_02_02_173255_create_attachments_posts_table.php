<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments_posts', function (Blueprint $table) {
          $table->integer('posts_id')->unsigned();
          $table->foreign('posts_id')->references('id')->on('posts')->nullable();

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
        Schema::dropIfExists('attachments_posts');
    }
}
