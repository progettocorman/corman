<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\CondivisionPost;
use \App\CondivisionPublication;

class CondivisionController
{
    public static function addcondivision(Request $request) {
      $nomegruppo = $_GET["nomegruppo"];
      $pieces = explode("-", $nomegruppo);
      echo "$pieces[0] $pieces[1] $pieces[2] $pieces[3] </br>";
      echo "FARE INDIRIZZAMENTO SU QUEL GRUPPO CON ID --> $pieces[2]";

      if($pieces[2]==1){
        $condivision= new CondivisionPublication;
        $condivision->user_id = $pieces[3];
        $condivision->group_boolean=1;
        $condivision->publication_id = $pieces[1];
        $condivision->group_id = $pieces[2];
        $condivision->save();
      }
      else {
        $condivision= new CondivisionPost;
        $condivision->user_id = $pieces[3];
        $condivision->group_boolean=1;
        $condivision->post_id = $pieces[1];
        $condivision->group_id = $pieces[2];
        $condivision->save();
      }

      \App\Group::getViewGroup($pieces[2]);
    }

}
