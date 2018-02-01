<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>

      <!-- Stiamo includendo lo stile di boodstrap dalla nostra cartella -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
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
<<<<<<< HEAD
        <a class="navbar-brand" href="#">Corman</a>
=======
        <img src="image/corman.png">
>>>>>>> 54c71261a67e8f926bbef5f8a4f3a7d72ef337e4
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
      </div>
    </div>
  </nav>


  <div class="container-fluid text-center">
    <div class="row content">
      <div class="col-sm-6 sidenav">
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
    <button type="button" onClick="location.href='formregister'">Signin</button>
  </form>
  </div>
  <div class="col-sm-6 text-left">
    <h1>Welcome</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <hr>
    <h3>Test</h3>
    <p>Lorem ipsum...</p>
  </div>

</div>
</div>

=======


  <form method="POST" action='login'>

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
>>>>>>> 54c71261a67e8f926bbef5f8a4f3a7d72ef337e4

  <button type="button" onClick="location.href='formregister'">Signin</button>

  </body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>


</body>
</html>
