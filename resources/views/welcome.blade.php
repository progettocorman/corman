<head>
  <meta charset="UTF-8">
  <title>Homepage</title>

      <!-- Stiamo includendo lo stile di boodstrap dalla nostra cartella -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
</head>

<body>


  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Menù di destra a tendina -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Corman</a>
        <img src="corman.png">
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <!-- Cerca -->
        <form class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search researcher">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>



<form method="POST" action='login'>

  <div id="grigio">
   <form>
     <div class="form-group_input">
       <label for="exampleInputEmail1">Email address</label>
       <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
     </div>
     <div class="form-group_input">
       <label for="exampleInputPassword1">Password</label>
       <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
     </div>
     <div class="form-check">
       <input type="checkbox" class="form-check-input" id="exampleCheck1">
       <label class="form-check-label" for="exampleCheck1">Check me out</label>
     </div>
     <button type="submit" class="btn btn-primary">Submit</button>
   </form>

  </div>
</form>

<button type="button" onClick="location.href='formregister'">Signin</button>



<!-- Stiamo includendo la jquery di google è imoportante metterla prima altrimenti bootstrap non funziona -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Stiamo includendo i javascript di boodstrap dalla nostra cartella -->
<script src="js/bootstrap.min.js"></script>


</body>
</html>
