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

?> " style="width:56px;height:56px;"></p>
<p>{{$name}}</p>
<p>{{$last_name}}</p>
<p>{{$affiliation}}</p>
<br>
<p><a class="_t98z6" href="followers"> Follower: <span class="_fd86t" title="360">{{$user_follower}}</span></a></p>
<p><a class="_t98z6" href="follow"> Followed: <span class="_fd86t" title="360">{{$user_follow}}</span></a></p>
