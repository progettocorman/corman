<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use DB;


use \App\Partecipation;

class Group extends Controller
{
    //Crea un nuovo gruppo e setta l'utente come amministratore di tale gruppo
  public static function createGroup(Request $request){
      $group = new \App\Group;
      $group->group_name = $request->input('group_name');
      if($request->visibility[0] == "1")
            $group->group_public = true;
      else
            $group->group_public = false;

      $group->created_by = $request->session()->get('id');

      $group->group_image = 'defaultgroup.png';

      $group->group_description = $request->input('description');

      $group->save();

      $groupId = \DB::table('groups')->select('id')->orderBy('id','desc')->first();



      Group::addUser($group->created_by, $groupId->id, true);

      $number = 1/*\DB::table('partecipations')->select('*')->where('group_id',$groupId)->count()*/;
      return redirect('group?group_id='.$groupId->id)
              ->with('group_id',$groupId)
              ->with('name',$group->group_name)
              ->with('description',$group->group_description)
              ->with('group_image',$group->group_image)
              ->with('visibility',$group->group_public)
              ->with('partecipants',$number)
              ->with('is_amministrator',true);
    }





public function modifyGroup(Request $request){
    $group_id = $request->input("groupid");

    foreach ($request->input('visibility') as $vis) {
      $visibility = $vis;
    }
    $group_name = $request->input('group_name');
    $group_description = $request->input('description');

    DB::table('groups')->where('id',$group_id)
    ->update(array('group_name' =>$group_name,'group_description'=>$group_description,'group_public'=>$visibility));

  $group = \DB::table('groups')->where('id',$group_id)->first();
  $number =\DB::table('partecipations')->select('*')->where('group_id',$group_id)->count();
  $is_amministrator = \DB::table('partecipations')->select('*')->where('group_id',$group_id)->where('user_id',session('id'))->first();

  if(!isset($group->group_description))$group_description = "";
    return redirect('group?group_id='.$group->id)
          ->with('name',$group->group_name)
          ->with('description',$group_description)
          ->with('group_image',$group->group_image)
          ->with('visibility',$group->group_public)
          ->with('partecipants',$number)
          ->with('is_amministrator',$is_amministrator->is_amministrator);
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
      if($groupScope->group_public){
        Group::addUser($userId,$groupId,false);
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
      //  $user_id = session('id');

      $query = \DB::table('groups')->select('*')->where('id',$group_id)->first();
      $number =\DB::table('partecipations')->select('*')->where('group_id',$group_id)->count();
      $is_amministrator = \DB::table('partecipations')->select('*')->where('group_id',$group_id)->where('user_id',session('id'))->first();
      return view('group')
              ->with('id',$query->id)
              ->with('name',$query->group_name)
              ->with('description',$query->group_description)
              ->with('group_image',$query->group_image)
              ->with('visibility',$query->group_public)
              ->with('partecipants',$number)
              ->with('is_amministrator',$is_amministrator->is_amministrator);
    }

    public static function getGroup($group_id){


      $query = \DB::table('groups')->select('*')->where('id',$group_id)->first();
      $number =\DB::table('partecipations')->select('*')->where('group_id',$group_id)->count();
      $is_amministrator = \DB::table('partecipations')->select('*')->where('group_id',$group_id)->where('user_id',session('id'))->first();
      return view('group')
              ->with('id',$query->id)
              ->with('name',$query->group_name)
              ->with('description',$query->group_description)
              ->with('group_image',$query->group_image)
              ->with('visibility',$query->group_public)
              ->with('partecipants',$number)
              ->with('is_amministrator',$is_amministrator->is_amministrator);
    }

    public static function imageUpdate(Request $request){
      $id = session('id');
      $group_id = $request->input('g_Id');

      $fileinpost = $request->file('group_image');
      if ( $fileinpost != null) {
          $file =  $fileinpost->store('group_images');
          Storage::delete($file);
          $nomefiledacaricare = explode("/", $file);
          $filee = $fileinpost->move(public_path('group_images'),$group_id.".png");
          \DB::table('groups')->where('id',$group_id)->update(['group_image'=>$group_id.".png" ]);

      }else{
          \DB::table('users')->where('id',$group_id)->update(['group_image'=>"defaultgroup.png" ]);

      }

      $group = \DB::table('groups')->where('id',$group_id)->first();
      $number =\DB::table('partecipations')->select('*')->where('group_id',$group_id)->count();
      $is_amministrator = \DB::table('partecipations')->select('*')->where('group_id',$group_id)->where('user_id',session('id'))->first();

      if(!isset($group->group_description))$group_description = "";
      else $group_description = $group->group_description;
        return redirect('group?group_id='.$group->id)
              ->with('name',$group->group_name)
              ->with('description',$group_description)
              ->with('group_image',$group->group_image)
              ->with('visibility',$group->group_public)
              ->with('partecipants',$number)
              ->with('is_amministrator',$is_amministrator->is_amministrator);
    }

    public static function inviteManager(Request $request){
      $data = explode("_",$request->groups);
      // echo $data[0];
      // echo $data[1];
      Group::inviteUser($data[1],$data[0],session('id'));
      return redirect('/home');
    }

    public static function joinManager(Request $request){
      $user_id = session('id');
      $group_id = $request->groupTo;

      Group::joinGroup($user_id,$group_id);
      return redirect('/home');
    }

    public static function getMembers(){
      $group_id = $_GET['group_id'];
      $group = \App\Group::find($group_id);

      $members = $group->members;

      return view('members')->with(['members' => $members]);
    }
}
