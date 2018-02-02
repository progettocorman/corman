<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Partecipation;

class Group extends Controller
{
    //Crea un nuovo gruppo e setta l'utente come amministratore di tale gruppo
    public static function createGroup(Request $request, $groupName, $scope, $groupDescription, $groupImage){
      $group = new \App\Group;
      $group->group_name = $groupName;
      $group->group_public = $scope;
      $group->created_by = $request->session()->get('id');

      if(isset($groupImage)) $group->group_image = $groupImage;
      if(isset($groupDescription)) $group->group_description = $groupDescription;

      $group->searchable();
      $group->save();

      $groupId = \DB::table('groups')->select('id')->orderBy('id','desc')->first();

      Group::addUser($group->created_by, $groupId->id, true);
    }

    //Elimina un gruppo
    public static function deleteGroup($groupId){
      // Elimina Tutte le Partecipazioni al gruppo
      \App\Partecipation::where('group_id',$groupId)->delete();
      //Elimina il gruppo
      \App\Group::where('id',$groupId)->delete();
      //todo Notifiche a tutti i partecipanti, che il gruppo è stato rimosso
    }

    //Aggiunge un utente ad un gruppo, con la possibilità di settarlo come amministratore di quel gruppo
    public static function addUser ($userId, $groupId, $amministrator){
      $partecipation = new Partecipation;
      $partecipation->user_id = $userId;
      $partecipation->group_id= $groupId;
      $partecipation->is_amministrator = $amministrator;

      $partecipation->save();
    }

    //Elimina un utente da un gruppo
    public static function removeUser($userId, $groupId){
      \App\Partecipation::where('user_id',$userId)->where('group_id',$groupId)->delete();
      //todo Notifica all'utente che è stato eliminato
    }

    //Imposta un utente come amministratore
    public static function setAdmin($userId,$groupId){
      $result = \DB::table('partecipations')->where('user_id', $userId)->where('group_id',$groupId)->update(['is_amministrator' => true]);
      // if($result == NULL) return "Nessuna Modifica";
    }
    //Rimuovi un utente dal ruolo di amministratore
    public static function unsetAdmin($userId,$groupId){
      $result = \DB::table('partecipations')->where('user_id', $userId)->where('group_id',$groupId)->update(['is_amministrator' => false]);
      // if($result == NULL) return "Nessuna Modifica";
    }

    //Richiede di partecipare ad un gruppo-> Se è pubblico, aggiunge l'utente al gruppo, altrimenti invia una notifica all'amministratore
    public static function joinGroup($userId, $groupId){
      $groupScope = \DB::table('groups')->select('group_public')->where('id',$groupId)->first();
      //SE IL GRUPPO È PUBBLICO, AGGIUNGI L'UTENTE AL GRUPPO
      if($groupScope){
        Test::addUser($userId,$groupId,false);
      }
      //ALTRIMENTI INVIA UNA NOTIFICA AD OGNI AMMINISTRATORE DEL GRUPPO
      else{
        $admins = \DB::table("partecipations")->select('user_id')->where('group_id',$groupId)->where('is_amministrator',true)->get();

        foreach ($admins as $admin) {
          Notification::sendNotification(1,$admin->user_id,$groupId,$userId);
        }

      }
    }
    public static function addDescription($groupDescription,$groupId){
        \DB::table('groups')->where('id', $groupId)->update(['group_description' => $groupDescription]);
    }

    public static function addImage($groupImage,$groupId){
        \DB::table('groups')->where('id', $groupId)->update(['group_image' => $groupImage]);
    }

    public static function inviteUser($groupId, $userId, $senderId){
      Notification::sendNotification(2,$userId,$groupId,$senderId);
    }

}
