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
              3 = User follow request Notifications
              //todo
            */
            $table->integer('id')->unsigned()->primary();
            $table->string('description');
            $table->timestamps();
        });

        $types = array("CoAuthor Notifications","Group Partecipation Notifications","Group Partecipation Invitations Notifications","User follow request Notifications");
        $i = 0;
        foreach ($types as $type) {
          $typeModel = new \App\NType;
          $typeModel->id = $i;
          $typeModel->description = $type;
          $typeModel->save();
          $i++;
        }

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
