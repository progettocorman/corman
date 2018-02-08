<p><img src="/profile_images/
<?php
    $id = session('id');
    $query = DB::table('users')->select('*')->where('id',$id)->first();
    $name = $query->name;
    $last_name = $query->last_name;
    $affiliation = $query->affiliation;
    echo $query->user_image;
    $user_follow = \App\Http\Controllers\UserController::getFollow($id);
    $user_follower = \App\Http\Controllers\UserController::getFollower($id);

?> " style="width:48px;height:48px;"></p>
<p>{{$name}}</p>
<p>{{$last_name}}</p>
<p>{{$affiliation}}</p>
<br>
<p>
  <a class="_t98z6" href="javascript:;" onclick="window.open('followers', 'titolo', 'width=400, height=200, resizable, status, scrollbars=1, location');">
        Follower: <span class="_fd86t" title="360">{{$user_follower}}</span>
  </a>
</p>
<p>
  <a class="_t98z6" href="javascript:;" onclick="window.open('follows', 'titolo', 'width=400, height=200, resizable, status, scrollbars=1, location');">
        Followed: <span class="_fd86t" title="360">{{$user_follow}}</span>
  </a>
</p>
