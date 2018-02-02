<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Friendship;

class Follow extends Controller
{
    //Manda richiesta
    public static function followRequest($my_id, $followed_id) {
        Notification::sendNotification(3, $followed_id,  0, $my_id);
    }
    //Accetta richiesta
    public static function followAccept($my_id, $follower_id){
      Notification::notificationAcceptance($follower_id, 0, 3, $my_id);
    }
    public static function addFriendship($follower_id, $my_id){
      $friendship = new Friendship;
      $friendship->user_id = $my_id;
      $friendship->user_follow = $follower_id;//Chi segue

      $friendship-> save();
    }

}
