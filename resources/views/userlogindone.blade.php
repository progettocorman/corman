
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/userlogindone.css" type="text/css" />
</head>
  <body>
  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Lista dei gruppi a cui ti sei iscritto</a></p>
      <p><a href="#">-</a></p>
      <p><a href="#">-</a></p>
      <p><a href="#">-</a></p>
      <p><a href="#">-</a></p>
      <p><a href="#">-</a></p>
      <p><a href="#">...</a></p>
        <a href='group'>L'universo</a>
    </div>
    <div class="col-sm-8 text-left">
    <p>Qui ci saranno i post </p>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>{{$name}}</p>
        <p>{{$last_name}}</p>
        <p>{{$affiliation}}</p>
        <button type="button" onClick="location.href='userprofile'">vai al profilo utente</button>
      </div>
    </div>
  </div>
  </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
