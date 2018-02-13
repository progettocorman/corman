
<?php
    $user_follow = \App\Http\Controllers\UserController::getNumberFollow(session('id'));
    $user_follower = \App\Http\Controllers\UserController::getNumberFollower(session('id'));

    $user = \DB::table('users')->where('id',$_GET['id'])->first();
?>

<link rel="stylesheet" href="css/information_profile.css" type="text/css" />
<header class="_mainc">
<div class="_b0acm">
 <div class="_qdmzb">
   <div class="_62ai2">
<p><img src="/profile_images/{{$user->user_image}}" style="width:15%;height:15%; -moz-border-radius: 180px; -webkit-border-radius:180px; border-radius:180px; float:left; margin-right: 5%;"></p>
</div>
</div>
</div>

<section class="_o6mpc">
<div class="_t98z6">
<h3>{{$user->name}} {{$user->last_name}} @if($id ==session('id'))<button class="btn btn-primary" type="button" onClick="location.href='settingaccount'">Settings</button> </h3>@endif
<h5>{{$user->affiliation}}</h5>
</div>
<br>
<ul class="_h9luf">
  <div class="_bnq48">
    <a class="_t98z6" href="javascript:;" onclick="window.open('/followers', 'titolo', 'width=400, height=200, resizable, status, scrollbars=1, location');">
          <font size="2px">Follower: </font><span class="_fd86t" title="360"><font size="2px">{{$user_follower}}</font></span>
    </a>
 </div>
  <div class="_bnq48">
    <a class="_t98z6" href="javascript:;" onclick="window.open('/follows', 'titolo', 'width=400, height=200, resizable, status, scrollbars=1, location');">
          <font size="2px">Followed:</font> <span class="_fd86t" title="360"><font size="2px">{{$user_follow}}</font></span>
    </a>
  </div>
</ul>
</section>
</header>
