  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signin</title>

      <!-- Stiamo includendo lo stile di boodstrap dalla nostra cartella -->

      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
      <link rel="stylesheet" href="css/formview.css" type="text/css" />

<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Corman</a>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
  <div class="row content">
  <div class="col-sm-6 sidenav">
    <form method="POST" action='insert_form'>
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <div class="form-group">
    <table width="100%" border="0">

      <tr>
        <td>
          <label >Name*</label>
        </td>
        <td>
         <label >Surname*</label>
        </td>
      </tr>

      <tr>
        <td>
          <input type="text" class="form-control" name="user_name" placeholder="name" required>
        </td>
        <td>
         <input type="text" class="form-control" name="user_lastname" placeholder="cognome" required>
        </td>
      </tr>

      <tr>
        <td>
          <label >Second Name</label>
        </td>
        <td>
         <label >Date*</label>
        </td>
      </tr>

      <tr>
        <td>
          <input type="text" class="form-control" name="second_name" placeholder="name">
        </td>
        <td>
         <input type="date" class="form-control" max ="1993-12-31" min = "1908-01-01"  name="user_date" required>
        </td>
      </tr>

      <tr>
        <td>
          <label >Affiliation*</label>
        </td>
        <td>
         <label for="exampleFormControlSelect1">Linee di ricerca</label>
        </td>
      </tr>

      <tr>
        <td>
          <input type="text" class="form-control" name="user_affiliation" placeholder="affiliation" required>
        </td>
        <td>
          <select class="form-control" name="user_research" placeholder="Research">
            <option>Artificial Intelligence</option>
            <option>CyberSecurity</option>
            <option>Semantic Web</option>
            <option>Human Computer Interaction</option>
            <option>Other</option>
          </select>
        </td>
      </tr>

      <tr>
        <td>
          <label>Email address*</label>
        </td>
        <td>
         <label>Password*</label>
        </td>
      </tr>

      <tr>
        <td>
          <input type="email" class="form-control" name="user_email" aria-describedby="emailHelp" placeholder="Enter email">
        </td>
        <td>
         <input type="password" class="form-control" name="user_password"  aria-describedby="emailHelp" placeholder="Password" required>
        </td>
      </tr>

      <tr>
        <td>
  <button type="submit" class="btn btn-primary">Submit</button>
        </td>
      </tr>
</table>
  </div>
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
      <button type="button" onClick="location.href='/'"class="btn btn-primary">Login</button>
    </div>
    </div>
    </div>
</body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
