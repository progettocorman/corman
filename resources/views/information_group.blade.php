
<?php
    $user_follow = \App\Http\Controllers\UserController::getNumberFollow(session('id'));
    $user_follower = \App\Http\Controllers\UserController::getNumberFollower(session('id'));
    $group_id = $_GET['group_id'];
    $group = \DB::table('groups')->where('id',$group_id)->first();
    $partecipants = \DB::table('partecipations')->join("users","user_id","=","users.id")->where('group_id',$group_id)->get();

?>
<style>
input.form-controll{
  display:none;
   visibility:hidden;
}
</style>
<link rel="stylesheet" href="css/information_group.css" type="text/css" />
<header class="_mainc">
<div class="_b0acm">
 <div class="_qdmzb">
   <div class="_62ai2">
<p><img src="group_images/{{$group->group_image}}" style="width:20%;height:20%; -moz-border-radius: 180px; -webkit-border-radius:180px; border-radius:180px; float:left; margin-right: 5%;"></p>
</div>
</div>
</div>

<section class="_o6mpc">
<div class="_ienqf">
<h1>{{$name}} </h1>
@if($subscribed==1)
  @if($isadmin==0)
    <button type="button" onClick="location.href = 'removeUser?to_remove={{session("id")}}&from={{$group_id}}'" class="btn btn-primary active">Unsubscribe</button>
  @endif
@else
 <button type="button" onClick="location.href='joinGroup?groupTo={{$group_id}}' " class="btn btn-primary active">Subscribes</button>
@endif
<input type="text" class="form-controll" name="group_id">
<div class"bla">
  @if($visibility==1)
      <h3>Pubblico</h3>
  @else
      <h3>Privato</h3>
  @endif

<?php if(isset($_GET['group_id'])){ ?>
  @if($is_amministrator)

    <label style="color: #277e2e">Sei un amministratore</label>

    <?php $group_id = $_GET['group_id']; ?>
    <button class="btn btn-primary" type="button" onClick="location.href='setting_group?group_id={{$group_id}}'">Settings</button>
  @endif
<?php }?>
<ul class="_h9luf">
  <div class="_bnq48">
    <a class="_t98z6" href="javascript:;" onclick="window.open('/members?group_id={{$_GET['group_id']}}', 'titolo', 'width=400, height=200, resizable, status, scrollbars=1, location');">
          Partecipanti: <span class="_fd86t" title="360">@foreach($partecipants as $partecipant)<a href="userprofile?id={{$partecipant->id}}">{{$partecipant->name}} {{$partecipant->second_name}} {{$partecipant->last_name}} </a>@endforeach</span>
    </a>
  </div>
</ul>
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
