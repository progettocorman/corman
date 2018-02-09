<?php

namespace App\Http\Controllers;
use  Input, Redirect;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Http\Controllers\Exception;
use App\Http\Controllers\Auth;
use Illuminate\Database\Seeder;
use DB;

class CommintsPostsController extends Controller
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public static function saveCommints(Request $request, $idpost)
  {
   
    $id = session('id');
    $commintsposts = new \App\Posts_commints;
    $commintsposts->value = $request->input('commintsvalue');
    $commintsposts->user_id = $id;
    $commintsposts->posts_id = $idpost;
    $commintsposts->save();
   
  }


  public static function showCommints($idpost)
  {
    $query = DB::table('posts_commints')->select('*')->where('posts_id',$idpost)->orderby('created_at','cresc')->get();

    $commints = array();
    $i = 0;
    
    foreach($query as $singlevalue){
        $queryname = DB::table('users')->select('name','last_name')->where('id',$singlevalue->user_id)->first();
        $commints[i] = "$queryname->name  $queryname->last_name: $singlevalue->value";
        $i=$i+1;
        }
  
    return $comints;
  
   }


}