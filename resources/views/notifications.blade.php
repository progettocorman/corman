<?php
  $id = session('id');
  $notifications = \App\Http\Controllers\Notification::notificationforUser();

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

      <button class="btn btn-primary" onClick="location.href='post'">New Post</button></br></br>
      <button class="btn btn-primary" onClick="location.href='pubblicazione'"><font size="1px"> New Publication</font></button></br></br>
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
                                        added the publications "{{$publication->title}}" which you may be co-author
                                        @break

                                    @case(1)
                                        <?php $group = \DB::table('groups')->where('id',$notification->object_id)->first();  ?>
                                        requested to join you group "{{$group->group_name}}"
                                        @break

                                    @case(2)
                                        <?php $group = \DB::table('groups')->where('id',$notification->object_id)->first(); ?>
                                      invited you to the group "{{$group->group_name}}"
                                        @break
                                    @case(3)
                                        would like to follow you
                                @endswitch
                            </p>
            </td>

            <td>
              <td>
                <button class="pushA" onClick="location.href = 'notAcc?accept=1&s={{$notification->sender_id}}&u={{$notification->user_id}}&o={{$notification->object_id}}&t={{$notification->type_id}}'" type=”submit”>  Accept </button>
              </td>
              <td>
                <button class="pushR" onClick="location.href = 'notAcc?accept=0&u={{$notification->user_id}}&o={{$notification->object_id}}&t={{$notification->type_id}}'" type=”submit”>  Refuse </button>
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
  <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
  </br>
    <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
</nav>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
