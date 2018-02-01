
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
  /* Remove the navbar's default margin-bottom and rounded borders */
  .navbar {
    margin-bottom: 0;
    border-radius: 0;
  }

  /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
  .row.content {height: 450px}

  /* Set gray background color and 100% height */
  .sidenav {
    padding-top: 20px;
    background-color: #f1f1f1;
    height: 100%;
  }

  /* Set black background color, white text and some padding */
  footer {
    background-color: #555;
    color: white;
    padding: 15px;
  }
  .container-fluidf{
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #101010;
  overflow: visible!important;
  }

  /* On small screens, set height to 'auto' for sidenav and grid */
  @media screen and (max-width: 767px) {
    .sidenav {
      height: auto;
      padding: 15px;
    }
    .row.content {height:auto;}
  }
</style>

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
      <h1>Qui saranno pubblicati i post dei tuoi amici</h1>
      <p>|----------------------------------------------------------------------------------------------|</p>

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

<footer class="container-fluidf text-center">
  <p>Copyright Team Corman</p>
</footer>

</body>
</html>
