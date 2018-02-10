<?php
  $id = session('id');
  $notifications = \App\Http\Controllers\Notification::notificationforUser();
  $user = \DB::table('users')->where('id',$id)->first();

  if(isset($user->second_name)){
    $user_name = $user->name.' '.$user->second_name.' '.$user->last_name;
  }
  else {
    $user_name = $user->name.' '.$user->last_name;
  }

  if(isset($_GET['acceptance']) && $_GET['acceptance']==1){
    $u = $_GET['u'];
    $o = $_GET['o'];
    $t = $_GET['t'];
    $s = $_GET['s'];
  \App\Http\Controllers\Notification::notificationAcceptance($u,$o,$t,$s,$user_name);
  }else if(isset($_GET['acceptance']) && $_GET['acceptance']==0){
    $u = $_GET['u'];
    $o = $_GET['o'];
    $t = $_GET['t'];
    \App\Http\Controllers\Notification::notificationRefusement($u,$o,$t);
    
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User userlogindone</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="css/notifications.css" type="text/css" />
 </head>

  <body>
  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      @include('group_bar')

      <button class="btn btn-primary" onClick="location.href='post'">Crea Post</button></br></br>
      <button class="btn btn-primary" onClick="location.href='pubblicazione'">Crea Pubblicazione</button></br></br>
    </div>
    <div class="col-sm-8 text-left">

      <table class="tables" width="50%" border="2">
        @foreach($notifications as $notification)
        <?php $sender = \DB::table('users')->where('id',$notification->sender_id)->first();  ?>

          <tr>
            <td>
              <p><a href="userprofile?id={{$sender->id}}">{{$sender->name}} {{$sender->second_name}} {{$sender->last_name}}</a> @switch($notification->type_id)
                                    @case(0)
                                        <?php $publication = \DB::table('publications')->where('id',$notification->object_id)->first();  ?>
                                        ha aggiunto la pubblicazione "{{$publication->title}}" di cui potresti essere coautore
                                        @break

                                    @case(1)
                                        <?php $group = \DB::table('groups')->where('id',$notification->object_id)->first();  ?>
                                        ha richiesto di partecipare al tuo gruppo "{{$group->group_name}}"
                                        @break

                                    @case(2)
                                        <?php $group = \DB::table('groups')->where('id',$notification->object_id)->first(); ?>
                                        ti ha invitato a partecipare al gruppo "{{$group->group_name}}"
                                        @break
                                    @case(3)
                                        ha richiesto di seguirti
                                @endswitch
                            </p>
            </td>

            <td>
              <td>
                <button class="pushA" onClick="location.href = 'notifications?acceptance=1&s={{$notification->sender_id}}&u={{$notification->user_id}}&o={{$notification->object_id}}&t={{$notification->type_id}}'" type=”submit”>  Accetta </button>
              </td>
              <td>
                <button class="pushR" onClick="location.href = 'notifications?acceptance=0&u={{$notification->user_id}}&o={{$notification->object_id}}&t={{$notification->type_id}}'" type=”submit”>  Rifiuta </button>
              </td>
            </td>
            </tr>
        @endforeach
      </table>

    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        @include('profile_bar')
        <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">Profile</button>
      </div>
    </div>
  </div>
  </div>

  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
