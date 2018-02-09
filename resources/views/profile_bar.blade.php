<<<<<<< HEAD

<p><img src="/profile_images/
=======
>>>>>>> 1f2b88d0ad24418af0a6f8884c24e7b3e7186c98
<?php
    $id = session('id');
    $query = DB::table('users')->select('*')->where('id',$id)->first();
    $name = $query->name;
    $last_name = $query->last_name;
    $affiliation = $query->affiliation;
    $image =  $query->user_image;
    $user_follow = \App\Http\Controllers\UserController::getFollow($id);
    $user_follower = \App\Http\Controllers\UserController::getFollower($id);

?>
<p><img src="/profile_images/{{$image}}" style="width:56px;height:56px;"></p>
<p>{{$name}}</p>
<p>{{$last_name}}</p>
<p>{{$affiliation}}</p>
<br>
<!--
<p>
  <a class="_t98z6" href="javascript:;" onclick="window.open('/followers', 'titolo', 'width=400, height=200, resizable, status, scrollbars=1, location');">
        Follower: <span class="_fd86t" title="360">{{$user_follower}}</span>
  </a>
</p>
<p>
  <a class="_t98z6" href="javascript:;" onclick="window.open('/follows', 'titolo', 'width=400, height=200, resizable, status, scrollbars=1, location');">
        Followed: <span class="_fd86t" title="360">{{$user_follow}}</span>
  </a>
</p>
-->
<a href="followers" data-toggle="modal" data-target="#followerModal" >Follower:  <span class="_fd86t" title="360">{{$user_follower}}</span></a>
<br>
<a href="follows" data-toggle="modal" data-target="#followModal" >  Followed: <span class="_fd86t" title="360">{{$user_follow}}</span></a>
<br>

@include('followerModal')
@include('followModal')
