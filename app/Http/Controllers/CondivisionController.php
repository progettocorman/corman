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

      $group_id = $pieces[0];

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

        $group = \DB::table('groups')->select('*')->where('id', $group_id)->first();

        //var_dump($group);



        return view('group')->with('group_id',$group->id)->with('name',$group->group_name)
              ->with('description',$group->group_description)->with('group_image',$group->group_image)
              ->with('visibility',$group->group_public);
          /*TODO: ritornare view Group con parametri
            group_id
            name
            description
            group_image
            visibility
          */

    }
}