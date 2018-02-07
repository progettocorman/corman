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

class TagsPostsController extends Controller
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public static function saveTags($request_tag, $postid)
  {
    $tagsposts = new \App\Posts_tags;
    $tagsposts->value = $request_tag;
    $tagsposts->posts_id =$postid;
    $tagsposts->save(); 
  }


  public function showTags(Request $request)
  {
    //todo
  }

}