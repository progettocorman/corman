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

  //salva i commenti relativi un post nella tavella posts_commints, riceve in inpuit il commento e l'id del post
  public  function savecommints(Request $request, $idpost)
  {
 
    $id = session('id');
    $commintsposts = new \App\Posts_commints;
    $commintsposts->value = $request->input('commint');
    $commintsposts->user_id = $id;
    $commintsposts->posts_id = $idpost;
    $commintsposts->save();
   
  }


  //ha in input l'id del post e restituicse un array con tutti i commenti in ordine crescente
  public  function showCommints($idpost)
  {
    
    $query = DB::table('posts_commints')->select('*')->where('posts_id',$idpost)->orderby('created_at','cresc')->get();
    $commints = array();
    $i = 0;

    foreach($query as $singlevalue){
        $queryname = DB::table('users')->select('name','last_name')->where('id',$singlevalue->user_id)->first();
        $commints[$i] = "$queryname->name  $queryname->last_name: $singlevalue->value";
        $i++;
        }

    return  $commints;
  
   }


}