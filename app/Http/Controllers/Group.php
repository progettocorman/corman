<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session;

use \App\Partecipation;

class Group extends Controller
{
    //Crea un nuovo gruppo e setta l'utente come amministratore di tale gruppo
  public static function createGroup(Request $request/*, $groupName, $scope, $groupDescription, $groupImage*/){
      $group = new \App\Group;
      $group->group_name = $request->input('group_name');
      if($request->visibility[0] == "1")
            $group->group_public = true;
      else
            $group->group_public = false;

      $group->created_by = $request->session()->get('id');

      if(isset($groupImage)) $group->group_image = $groupImage;
      if(isset($groupDescription)) $group->group_description = $request->input('description');

      // $group->searchable();
      $group->save();

      $groupId = \DB::table('groups')->select('id')->orderBy('id','desc')->first();



      Group::addUser($group->created_by, $groupId->id, true);

      $number = 1/*\DB::table('partecipations')->select('*')->where('group_id',$groupId)->count()*/;
      return view('group')
              ->with('id',$groupId)
              ->with('name',$group->group_name)
              ->with('description',$group->group_description)
              ->with('image',$group->group_image)
              ->with('visibility',$group->group_public)
              ->with('partecipants',$number);
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

    public static function getViewGroup(Request $request){

        $group_id = $request->group_id;


      $query = \DB::table('groups')->select('*')->where('id',$group_id)->first();
      $number =\DB::table('partecipations')->select('*')->where('group_id',$group_id)->count();
      return view('group')
              ->with('id',$query->id)
              ->with('name',$query->group_name)
              ->with('description',$query->group_description)
              ->with('image',$query->group_image)
              ->with('visibility',$query->group_public)
              ->with('partecipants',$number);
    }

    public static function imageUpdate(Request $request){
      $id = session('id');
      $fileinpost = $request->file('user_image');
      if ( $fileinpost != null) {
          $file =  $fileinpost->store('profile_images');
          Storage::delete($file);
          $nomefiledacaricare = explode("/", $file);
          $filee = $fileinpost->move(public_path('profile_images'),$id.".png");
          DB::table('users')->where('id',$id)->update(['user_image'=>$id.".png" ]);
          $query = DB::table('users')->select('*')->where('id',$id)->first();
      }else{
          DB::table('users')->where('id',$id)->update(['user_image'=>"defaultprofile.png" ]);
          $query = DB::table('users')->select('*')->where('id',$id)->first();
      }
      
    }



}
