<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->text('topic_name');
            $table->timestamps();
        });

        $types = array("Internet of Things ","Linked Opend Data","Mashup","Advance Paradigms of Interaction");

        foreach ($types as $type) {
          $typeModel = new \App\Topic;
          $typeModel->topic_name = $type;
          $typeModel->save();
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
