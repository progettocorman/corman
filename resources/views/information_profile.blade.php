<link rel="stylesheet" href="css/information_profile.css" type="text/css" />
<header class="_mainc">
<div class="_b0acm">
 <div class="_qdmzb">
   <div class="_62ai2">
<p><img src="/profile_images/
<?php
    $id = session('id');
    $query = DB::table('users')->select('*')->where('id',$id)->first();
    $name = $query->name;
    $last_name = $query->last_name;
    $affiliation = $query->affiliation;
    echo $query->user_image;
    $user_follow = \App\Http\Controllers\UserController::getNumberFollow($id);
    $user_follower = \App\Http\Controllers\UserController::getNumberFollower($id);

?> " style="width:20%;height:20%; -moz-border-radius: 180px; -webkit-border-radius:180px; border-radius:180px; float:left; margin-right: 5%;"></p>
</div>
</div>
</div>

<section class="_o6mpc">
<div class="_ienqf">
<h1>{{$name}} {{$last_name}} {{$affiliation}} <button class="btn btn-primary" type="button" onClick="location.href='settingaccount'">Settings</button> </h1>
</div>
<br>
<br>
<ul class="_h9luf">
  <div class="_bnq48">
    <a class="_t98z6" href="javascript:;" onclick="window.open('/followers', 'titolo', 'width=400, height=200, resizable, status, scrollbars=1, location');">
          Follower: <span class="_fd86t" title="360">{{$user_follower}}</span>
    </a>
 </div>
  <div class="_bnq48">
    <a class="_t98z6" href="javascript:;" onclick="window.open('/follows', 'titolo', 'width=400, height=200, resizable, status, scrollbars=1, location');">
          Followed: <span class="_fd86t" title="360">{{$user_follow}}</span>
    </a>
  </div>
</ul>
</section>
</header>
