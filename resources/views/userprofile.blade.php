
<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <head>
    <meta charset="utf-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrapall.css" type="text/css" />
  </head>

<body>

    @include('navbar')

  <div class="container-fluid text-center">

    <div class="row content">
      <div class="col-sm-2 sidenav">
        <h1>siamo nel profilo utente</h1>
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
        <h1>Qui saranno pubblicati i post dell utente</h1>
        <p>|----------------------------------------------------------------------------------------------|</p>

      </div>
      <div class="col-sm-2 sidenav">
        <div class="well">
          <p>Qui sara presente il tuo profilo</p>
          <p>Nome e cognome</p>

            <button type="button" onClick="location.href= 'settingaccount'">impostazioni account</button>
        </div>
      </div>
    </div>
  </div>

  <footer class="container-fluidf text-center">
    <p>Copyright Team Corman</p>
  </footer>
 </body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</html>
