

<!DOCTYPE html>
<html lang="en">

  @include('bootstrap')

<body>
  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      @include('group_bar')
    </div>
    <div class="col-sm-8 text-left">

      @foreach ($users as $user)
        <?php $userInfo = DB::table('users')->where('id',$user)->first() ?>
        <?php $followed = DB::table('friendships')->where('user_id',$user)->where('user_follow',session('id'))->first()?>
        <table class="tables" width="50%" border="0">
        <tr>
          <td>
              <p><img src="/profile_images/{{$userInfo->user_image}}" style="width:56px;height:56px;"></p>
              @if($followed == null && $user != session('id'))<button type="button" class="btn btn-primary active">Segui</button>
              @elseif($followed != null && $user != session('id'))<button type="button" class="btn btn-primary disabled">Segui già</button>@endif
          </td>
          <td>
              <p>{{$userInfo->name}} {{$userInfo->second_name}} {{$userInfo->last_name}}</p>
              <p>{{$userInfo->affiliation}}</p>
              <button class="btn btn-primary" onClick="location.href='userprofile?id={{$user}}'">User Profile</button></br></br>
          </td>
        </tr>
        </table>
      @endforeach
      <table class="tables" width="50%" border="0">
      <tr>
        <td>
            <p><img src="/profile_images" style="width:56px;height:56px;"></p>
            <button type="button" class="btn btn-primary active">Iscriviti</button>
            <button type="button" class="btn btn-primary disabled">Già iscritto</button>
        </td>
        <td>
            <p>Name group</p>
            <button class="btn btn-primary" onClick="location.href=''">Vai al gruppo</button></br></br>
        </td>
        </tr>
      </table>
      <table class="tables" width="50%" border="0">
        <tr>
          <td>
              <p><img src="/profile_images" style="width:56px;height:56px;"> Nome e cognome utente</p>
          </td>
          </tr>
      <tr>
        <td>
            <p>Titolo pubblicazione</p>
        </td>
        </tr>
            <tr>
        <td>
        <p>Data</p>
        </td>
      </tr>
      <tr>
    <td>
    <p>Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente</p>
    </td>
  </tr>
  <tr>
<td>
<input class="Commenti" placeholder="Commenta" id="comment">
</td>
</tr>
      </table>


    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        @include('profile_bar')
        <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">User profile</button>
      </div>

    </div>
  </div>
  </div>
 </body>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</html>
