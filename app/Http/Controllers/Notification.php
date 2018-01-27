<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\UsersPublication;
class Notification extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function publicationAcceptance(Request $request, $object_id, $notification_type_id){
      $user_id = session()->get('id');
      \App\Notification::where('user_id',$userId)->where('object_id',$publication_id)
                                                ->where('type_id',$notification_type_id)
                                                ->delete();
      // Test:: acceptanceTest($request,147);//TESTING
      $user_publication = new UsersPublication;
      $user_publication->user_id = $user_id;
      $user_publication->publication_id = $object_id;
      // $user_publication->author_name = \DB::table('user')->select()...;
    }
}
