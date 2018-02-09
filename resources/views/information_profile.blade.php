
<?php
    $user_follow = \App\Http\Controllers\UserController::getNumberFollow(session('id'));
    $user_follower = \App\Http\Controllers\UserController::getNumberFollower(session('id'));

?>

<link rel="stylesheet" href="css/information_profile.css" type="text/css" />
<header class="_mainc">
<div class="_b0acm">
 <div class="_qdmzb">
   <div class="_62ai2">
<p><img src="/profile_images/{{$user_image}}" style="width:20%;height:20%; -moz-border-radius: 180px; -webkit-border-radius:180px; border-radius:180px; float:left; margin-right: 5%;"></p>
</div>
</div>
</div>

<section class="_o6mpc">
<div class="_ienqf">
<h1>{{$name}} {{$last_name}} {{$affiliation}}  @if($id ==session('id'))<button class="btn btn-primary" type="button" onClick="location.href='settingaccount'">Settings</button> </h1>@endif
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
