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
          $post->attachments = 0;
          $post->save();
          $post->users()->attach($id,['visibility' => 0]);

          return view('/userprofile');
    }
}
