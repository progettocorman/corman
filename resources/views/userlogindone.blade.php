
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User userlogindone</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="css/logged.css" type="text/css" />
</head>


  <body>
  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
    <button class="btn btn-primary" onClick="location.href='post'">Crea Post</button></br></br>
    <button class="btn btn-primary" onClick="location.href='pubblicazione'">Crea Pubblicazione</button></br></br>
      <p><a href="#">Lista dei gruppi a cui ti sei iscritto</a></p>
      <p><a href="#">-</a></p>
      <p><a href="#">-</a></p>
      <p><a href="#">-</a></p>
      <p><a href="#">-</a></p>
      <p><a href="#">-</a></p>
      <p><a href="#">...</a></p>
        <a href='group'>L'universo</a>
        <p><a href="#">-</a></p>
        <p><a href="#">-</a></p>
        <p><a href="#">...</a></p>

    </div>
    <div class="col-sm-8 text-left">

      <table width="50%" border="1">
      <tr>
        <td>
            <p>Nome e cognome del seguito </p>
        </td>
        </tr>
          <tr>
        <td>
        <p>Data</p>
        </td>
      </tr>
      <tr>
    <td>
    <p>Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui v Qui ci sarà il post del ricercatore che segui</p>
    </td>
  </tr>
  <tr>
<td>
<p>Commenti</p>
</td>
</tr>
      </table>

    </table>
      <table width="50%" border="1">
      <tr>
        <td>
            <p>Name Surname</p>
        </td>
        </tr>
          <tr>
        <td>
        <p>Data</p>
        </td>
      </tr>
      <tr>
    <td>
    <p>Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore</p>
    </td>
  </tr>
  <tr>
  <td>
  <p>Commenti</p>
  </td>
  </tr>
      </table>
    </div>    
    <div class="col-sm-2 sidenav">
      <div class="well">  
      {{URL::asset('/corman/storage/app/public/<?php echo ($user_image); ?>')}}
        <p><img src="{{URL::asset('/corman/storage/app/public/<?php echo ($user_image); ?>')}}" style="width:80px;height:80px;"></p>
        <p>{{$name}}</p>
        <p>{{$last_name}}</p>
        <p>{{$affiliation}}</p>
        <button type="button" onClick="location.href='userprofile'">profile</button>
      </div>
    </div>
  </div>
  </div>

  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
