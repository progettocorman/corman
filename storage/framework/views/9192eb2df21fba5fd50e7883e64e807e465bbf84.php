<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>

      <!-- Stiamo includendo lo stile di boodstrap dalla nostra cartella -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
=======
<head>
  <meta charset="UTF-8">
  <title>Homepage</title>

      <!-- Stiamo includendo lo stile di boodstrap dalla nostra cartella -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
>>>>>>> a32e1cda5e4fda32996357de8a78d50b050ef1f3
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
<<<<<<< HEAD
        <img src="image/corman.png">
=======
        <a class="navbar-brand" href="#">Corman</a>
        <img src="corman.png">
>>>>>>> a32e1cda5e4fda32996357de8a78d50b050ef1f3
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<<<<<<< HEAD

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


=======

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
>>>>>>> a32e1cda5e4fda32996357de8a78d50b050ef1f3



  <form method="POST" action='login'>

<<<<<<< HEAD
  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="form-group row">
      <label for="imputEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="user_email" aria-describedby="emailHelp" placeholder="Enter email">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="user_password" placeholder="Password">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
=======
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
>>>>>>> a32e1cda5e4fda32996357de8a78d50b050ef1f3

  <button type="button" onClick="location.href='formregister'">Signin</button>

<<<<<<< HEAD
  </body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
=======


<!-- Stiamo includendo la jquery di google è imoportante metterla prima altrimenti bootstrap non funziona -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Stiamo includendo i javascript di boodstrap dalla nostra cartella -->
<script src="js/bootstrap.min.js"></script>
>>>>>>> a32e1cda5e4fda32996357de8a78d50b050ef1f3


</body>
</html>
