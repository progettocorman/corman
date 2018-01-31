
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrapall.css" type="text/css" />


</head>


<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <img src="image/corman.png">
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search researcher">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </ul>
      </div>
    </div>
  </nav>

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
    </div>
    <div class="col-sm-8 text-left">
      <h1>Qui saranno pubblicati i post dei tuoi amici</h1>
      <p>|----------------------------------------------------------------------------------------------|</p>

    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>Qui sara presente il tuo profilo</p>
        <p>Nome e cognome</p>
        <p>Età e sesso</p>
        <p>ecc</p>
        <button type="button" onClick="location.href='userprofile'">vai al profilo utente</button>

      </div>
    </div>
  </div>
</div>

<footer class="container-fluidf text-center">
  <p>Copyright Team Corman</p>
</footer>

</body>
</html>
