<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('value');
        });

        $types = array("Journal Articles","Books and Theses","Conference and Workshop Papers","Editorship","Informal Publications","Reference Works");

        foreach ($types as $type) {
          $typeModel = new \App\Types;
          $typeModel->value = $type;
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
        Schema::dropIfExists('types');
    }
}
