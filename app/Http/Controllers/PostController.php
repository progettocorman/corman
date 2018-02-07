<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TagsPostsController;
use DB;

class PostController extends Controller
{

    public function getPostView(Request $request){

      $id = session('id');
      $query = DB::table('users')->select('*')->where('id', $id)->first();
      return view('/post')->with("name",$query->name)->with("last_name",$query->last_name)
      ->with("user_image", $query->user_image)->with("affiliation",$query->affiliation);
    }

    
    public function addUserPost(Request $request){
          
          $id = session('id');
          $user = \App\User::find($id);
          $post = new \App\Post;
          $post->text = $request->input('testo');
          //$post->attachments = 0; COLONNA ELIMINATA NELLA NUOVA VERSIONE
          $post->save();
          $post->users()->attach($id,['visibility' => 0]);

          //sezione per  salvare i tags
          $queryforid = DB::table('posts')->select('id')->orderBy('created_at', 'desc')->first();
          TagsPostsController::saveTags($request->input('tags_value'), $queryforid->id);
         //sezione per salvare i tags//

          $query = DB::table('users')->select('*')->where('id', $id)->first();
          return view('/userprofile')->with("name",$query->name)->with("last_name",$query->last_name)
          ->with("user_image", $user->user_image)->with("affiliation",$user->affiliation);
        }

    public function modifyPostVisibility(Request $request){
      $user_id = session('id');
      $post_id = $request('post_id');
      $user = \App\User::find($user_id);
      $post = $user->posts()->where('posts_id',$post_id)->get();
      $post->pivot->visibility = $request('visibility');
    }

<<<<<<< HEAD
    public function modifyPost(Request $request){
      $id = 10;
      $post = \App\Post::find($id);
      $post->update([
          'text' => $request->input('testo')
      ]);
=======
>>>>>>> 02e4c749baafb73cff74fda4da5df0123d047502

    




}
