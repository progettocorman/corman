<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TagsPostsController;
use \App\CondivisionPost;
use DB;

class PostController extends Controller
{

    public static function getPostView(Request $request){

      $id = session('id');
      $query = DB::table('users')->select('*')->where('id', $id)->first();
      return view('/post')->with("name",$query->name)->with("last_name",$query->last_name)
      ->with("user_image", $query->user_image)->with("affiliation",$query->affiliation);
    }


    public static function addUserPost(Request $request)
    {

          $id = session('id');
          $user = \App\User::find($id);
          $post = new \App\Post;
          $post->text = $request->input('testo');
          foreach ($request->input('visibility') as $vis) {
            if($vis == "publico")$visibility = 0;
            if($vis == "privato")$visibility = 1;
            if($vis == "solo io")$visibility = 2;
          }

          //$post->attac hments = 0; COLONNA ELIMINATA NELLA NUOVA VERSIONE
          $post->save();

          $post->users()->attach($id,['visibility' => $visibility]);

          //sezione per  salvare i tags
          $queryforid = DB::table('posts')->select('id')->orderBy('created_at', 'desc')->first();

          $tags =  explode(",",$request->input('tags'));
          foreach($tags as $tag){
          TagsPostsController::saveTags($tag, $queryforid->id);
          }
         //sezione per salvare i tags//

         $fileinpost = $request->file('fileUpload1');
         if(isset($fileinpost)){
            AttachmentController::addAttachment($queryforid->id, 1, $fileinpost);
           }


          $query = DB::table('users')->select('*')->where('id', $id)->first();
          return redirect('/userprofile?id='.$user->id)->with("name",$query->name)->with("last_name",$query->last_name)
          ->with("user_image", $user->user_image)->with("affiliation",$user->affiliation);
    }

    public static function modifyPostVisibility(Request $request)
    {
      $user_id = session('id');
      $post_id = $request->post_id;
      DB::table('users_posts')->where('user_id',$user_id)->where('posts_id',$post_id)
        ->update(array("visibility"=>$request->visibility));

      //
      // $post_id = $request->post_id;
      // $user_id = session('id');
      // $user = \App\User::find($user_id);
      // $post = $user->posts()->where('posts_id',$post_id)->get();
      // // $post->pivot->visibility = $request->visibility;
      // $post->updateExistingPivot($post_id,$request->visibility);
    return redirect('/tot_post?id='.$request->id);
    }


    public static function modifyPost(Request $request)
    {
      $iduser = session('id');
      $post_id = $request->input('postid');
      $post = \App\Post::find($post_id);

      $fileinpost =$request->file('fileUpload1');
      //Aggiunta allegato
      if(isset($fileinpost)){
        //Ritira l'id della Pubblicazione appena aggiunta al db
         AttachmentController::addAttachment($post_id, 0, $fileinpost);

        }


      if($request->input('tags')!=null)\DB::table('posts_tags')->where('posts_id', $post_id)
        ->update(array('value' =>$request->input('tags')));

        DB::table('posts')->where('id',$post_id)
        ->update(array('text'=>$request->input('testo')));

        // return redirect('/tot_post?id='. $iduser);
    }


    public static function addCondivison(Request $request,$group){
          $post_id = 1/*$request->input('post_id')*/;
          $post  = \App\Post::find($post_id);


          $condivision = new \App\Condivision;
          $condivision->user_id = 2 /*session('id')*/;
          if($group == 1){
            $condivision->group_boolean = true;
            $condivision->group_id = $request->input('group_id');
          } else{
            $condivision->group_boolean = false;
            //$condivision->group_id = NULL;
          }

          $post->condivisions()->save($condivision);
    }





}
