<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\UsersPublication;
use DB;

class Notification extends Controller
{
    //Quando si rifiuta una notifica, questa viene cancellata dal db senza compiere nessun'altra azione
    public static function notificationRefusement($user_id, $object_id, $notification_type_id){
      \App\Notification::where('user_id',$user_id)->where('object_id',$object_id)
                                                ->where('type_id',$notification_type_id)
                                                ->delete();

    }

    //Quando si accetta una notifica, questa viene cancellata dal db, comportandosi a seconda del tipo di notifica
    public static function notificationAcceptance($user_id, $object_id, $notification_type_id, $sender_id, ...$other){
      \App\Notification::where('user_id',$user_id)->where('object_id',$object_id)
                                                ->where('type_id',$notification_type_id)
                                                ->where('sender_id',$sender_id)
                                                ->delete();
      //COMPORTAMENTO A SECONDA DEL TIPO DI NOTIFICA
      switch ($notification_type_id) {
          case 0://Notifica per gestione opere di coautori
              //$other[0] = Nome Autore
              Api::addPublicationToAuthor($request,$user_id, $publication_id,$other);
              break;
          case 1://Notifica per richiesta partecipazione ad un gruppo
              //$other[0] = NULL
              //Se la notifica viene accettata, aggiungi l'utente al gruppo
              Group::addUser($sender_id, $object_id, false);
              //Poché la notifica è stata accettata, rimuovi le notifiche inviate agli altri amministratori
              \App\Notification::where('object_id',$object_id)
                                 ->where('type_id',$notification_type_id)
                                 ->where('sender_id',$sender_id)
                                 ->delete();
              break;
          case 2://Notifica di invito a partecipare ad un gruppo
              Group::addUser($user_id,$object_id,false);
              break;
         case 3://Notifica di segui
              Follow::addFriendship($sender_id, $user_id);
              break;
      }


    }

    //Metodo per inviare una notifica di qualsiasi genere
    public static function sendNotification($notification_type, $receiver_id, $object_id, $sender_id){
      $notification = new \App\Notification;
      $notification->user_id = $receiver_id;
      $notification->object_id = $object_id;
      $notification->type_id = $notification_type;
      $notification->sender_id = $sender_id;

      $notification->save();
    }


    
    //Metodo per capire da chi l'utent riceve notifiche 
    public static function notificationforUser()
    {
         
        $id = session('id');
        $query = DB::table('notifications')->select('*')->where('user_id', $id)->get();
        $notifications_array = array();

        $i = 0;
        foreach($query as $notification){
            $notifications_array[$i] = $notification;
            $i = $i+1;
            }
            
        return ($notifications_array);
           
    }

}



