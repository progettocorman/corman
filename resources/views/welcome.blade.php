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
    <font color="#2e6da4" size="6"><b> Login </b></font>
    <form method="POST" action='login' width="40%" style=" padding: 20px; border-radius: 20px;">

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
@if(isset($error))
<div class="alert alert-warning">
  <strong>Warning!</strong><a href="#" class="alert-link">{{$error}}</a>.
</div>
@endif
    <button type="submit" class="btn btn-primary">SignIn</button>
  </form>
  </div>
  <div class="col-sm-6 text-left" >
    <div style="text-align: center;"><img src="image/logo.png"  width="30%"></div>
    <br><font color="#2e6da4" size="6" ><b>Welcome to Corman!</b></font>
    <p>Corman is a plattform well suited for researchers. It allows you to share your papers (every kind of!) with other reasearcher, it makes easier to find and preserve all your papers and supports the creation of collaborative groups to increase productivity.
      <br>Corman overcomes other scientific research engines, which only offer indexing, making reasearch life easier and agile!
      <br>Down there, you can join the community and improve your work!</br>
    </p>
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
<nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
</br>
  <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
</nav>
</body>
</html>
