<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Corman-Welcome</title>

      <!-- Stiamo includendo lo stile di boodstrap dalla nostra cartella -->

      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
      <link rel="stylesheet" href="css/welcome.css" type="text/css" />


</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" >Corman</a>
      </div>
    </div>
  </nav>

  <div class="container-fluid text-center">
  <div class="row content">
  <div class="col-sm-6 sidenav">
    <form method="POST" action='login'>

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <table width="40%" border="0">
        <tr>
          <td>
            <label for="imputEmail" class="col-sm-2 col-form-label">Email</label>
          </td>
          <td>
            <input type="email" class="form-control" name="user_email" aria-describedby="emailHelp" placeholder="Enter email">
          </td>
          </tr>
            <tr>
          <td>
          <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
          </td>
          <td>
             <input type="password" class="form-control" name="user_password" placeholder="Password">
          </td>
      </tr>
</table>
<div class="alert alert-warning">
  <strong>Warning!</strong><a href="#" class="alert-link">Password o email errata</a>.
</div>
    <button type="submit" class="btn btn-primary">SignIn</button>
  </form>
  </div>
  <div class="col-sm-6 text-left">
    <h1>Welcome</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <hr>
    <h3></h3>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
      <button type="button" onClick="location.href='formregister'"class="btn btn-primary">SignUp</button>
  </div>
  </div>
</div>

</body>
</html>
