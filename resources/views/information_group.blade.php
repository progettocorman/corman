
<?php
    $user_follow = \App\Http\Controllers\UserController::getNumberFollow(session('id'));
    $user_follower = \App\Http\Controllers\UserController::getNumberFollower(session('id'));

?>

<link rel="stylesheet" href="css/information_group.css" type="text/css" />
<header class="_mainc">
<div class="_b0acm">
 <div class="_qdmzb">
   <div class="_62ai2">
<p><img src="group_images/{{$group_image}}" style="width:20%;height:20%; -moz-border-radius: 180px; -webkit-border-radius:180px; border-radius:180px; float:left; margin-right: 5%;"></p>
</div>
</div>
</div>

<section class="_o6mpc">
<div class="_ienqf">
<h1>{{$name}}</h1>
<div class"bla">
  @if($visibility==1)
      <h3>Pubblico</h3>
  @else
      <h3>Privato</h3>
  @endif
  <?php $group_id= $_GET['group_id']?>
  @if($is_amministrator)
    <label style="color: #277e2e;">Sei un amministratore</label>  <button class="btn btn-primary" type="button" onClick="location.href='setting_group?group_id={{$group_id}}'">Settings</button>
  @endif
  <h5>numero partecipanti : {{$partecipants}} </h5>
</div>
<h5>{{$description}}</h5>
</div>
<br>
<ul class="_h9luf">
  <div class="_bnq48">
    <a
    </a>
 </div>
  <div class="_bnq48">
    <a
    </a>
  </div>
</ul>
</section>
</header>
