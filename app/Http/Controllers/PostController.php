<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    public function addUserPost(Request $request){
          $id = session('id');
          $user = \App\User::find($id);
          $post = new \App\Post;
          $post->text = $request->input('testo');
          //$post->attachments = 0; COLONNA ELIMINATA NELLA NUOVA VERSIONE
          $post->save();
          $post->users()->attach($id,['visibility' => 0]);

          return view('/userprofile');
    }

    public function modifyPublicationVisibility(Request $request){
      $user_id = session('id');
      $post_id = $request('post_id');
      $user = \App\User::find($user_id);
      $post = $user->posts()->where('posts_id',$post_id)->get();
      $post->pivot->visibility = $request('visibility');
    }
}
