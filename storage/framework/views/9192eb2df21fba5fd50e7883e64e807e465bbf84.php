<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>

form { 
  margin:30px;
  margin-top: 8px;
  margin-left: 40px;
  margin-right: 40px;
  }

  header{
    padding: 1em;
    color: blue;
    background-color:white;
    clear: left;
    text-align: left;

  }
  p{
    font-size:42px
    }

</style>
<title>Login or sign in</title>

  <head>
    <meta charset="utf-8">
    <header>
      <p>Login<p>
    </header>
  </head>


<body>

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

<button type="button" onClick="location.href='formregister'">Signin</button>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>