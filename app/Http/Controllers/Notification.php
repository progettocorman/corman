<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\UsersPublication;
class Notification extends Controller
{
    //Quando si rifiuta una notifica, questa viene cancellata dal db senza compiere nessun'altra azione
    public static function notificationRefusement(Request $request, $object_id, $notification_type_id){
      $user_id = session()->get('id');
      \App\Notification::where('user_id',$userId)->where('object_id',$object_id)
                                                ->where('type_id',$notification_type_id)
                                                ->delete();

    }

    //Quando si accetta una notifica, questa viene cancellata dal db, comportandosi a seconda del tipo di notifica
    public static function notificationAcceptance(Request $request, $object_id, $notification_type_id, ...$other){
      $user_id = $request->session()->get('id');
      \App\Notification::where('user_id',$userId)->where('object_id',$object_id)
                                                ->where('type_id',$notification_type_id)
                                                ->delete();
      //COMPORTAMENTO A SECONDA DEL TIPO DI NOTIFICA
      switch ($notification_type_id) {
          case 0://Notifica per gestione opere di coautori
              Api::addPublicationToAuthor($request,$user_id, $publication_id,$other);
              break;
          case 1:
              //todo
              break;
          case 2:
              //todo
              break;
      }


    }

    //Metodo per inviare una notifica di qualsiasi genere
    public static function notifieTo(Request $request, $notification_type, $receiver_id, $object_id){
      $notification = new Notification;
      $notification->user_id = $receiver_id;
      $notification->object_id = $object_id;
      $notification->type_id = $notification_type;
      $notification->save();
    }
}
