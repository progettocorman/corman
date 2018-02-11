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
      var_dump($pieces);
      echo "FARE INDIRIZZAMENTO SU QUEL GRUPPO CON ID --> $pieces[2]";

      $group_id = $pieces[0];

      if($pieces[2]==1){
        $condivision= new CondivisionPublication;
        $condivision->user_id = $pieces[3];
        $condivision->group_boolean=1;
        $condivision->publication_id = $pieces[1];
        $condivision->group_id = $pieces[0];
        $condivision->save();
      }
      else {
        $condivision= new CondivisionPost;
        $condivision->user_id = $pieces[3];
        $condivision->group_boolean=1;
        $condivision->post_id = $pieces[1];
        $condivision->group_id = $pieces[0];
        $condivision->save();
      }

        $group = \DB::table('groups')->select('*')->where('id', $group_id)->first();
        $number =\DB::table('partecipations')->select('*')->where('group_id',$group_id)->count();
        $is_amministrator = \DB::table('partecipations')->select('*')->where('group_id',$group_id)->where('user_id',session('id'))->first();
        //var_dump($group);


        return redirect('group?group_id='.$group->id)->with('name',$group->group_name)
              ->with('description',$group->group_description)->with('group_image',$group->group_image)
              ->with('visibility',$group->group_public)
              ->with('partecipants',$number)
              ->with('is_amministrator',$is_amministrator->is_amministrator);


    }
}
