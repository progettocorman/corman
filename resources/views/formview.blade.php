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
        <a class="navbar-brand">Corman</a>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
  <div class="row content">
  <div class="col-sm-6 sidenav">

    <form method="POST" action='insert_form'>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
         <input type="text" class="form-control" name="user_lastname" placeholder="surname" required>
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
         <label for="exampleFormControlSelect1">Lines of research</label>
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
            <label>Confirm email*</label>
        </td>

      </tr>

      <tr>
        <td>
          <input type="email" class="form-control" name="user_email" aria-describedby="emailHelp" placeholder="Enter email">
        </td>
        <td>
          <input type="email" class="form-control" name="user_email2" aria-describedby="emailHelp" placeholder="Enter email">
        </td>
      </tr>
      <tr>
        <td> <label>Password</label></td>
        <td><label>Confirm password</label></td>
      </tr>
      <tr>
        <td>
         <input type="password" class="form-control" name="user_password"  aria-describedby="emailHelp" placeholder="Password" required>
        </td>
        <td>
           <input type="password" class="form-control" name="user_password2"  aria-describedby="emailHelp" placeholder="Password" required>
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
  <div class="col-sm-6 text-left" >
    <div style="text-align: center;"><img src="image/logo.png"  width="30%"></div>
    <br><font color="#2e6da4" size="6" ><b>Welcome to Corman!</b></font>
    <p>Corman is a plattform well suited for researchers. It allows you to share your papers (every kind of!) with other reasearcher, it makes easier to find and preserve all your papers and supports the creation of collaborative groups to increase productivity.
      <br>Corman overcomes other scientific research engines, which only offer indexing, making reasearch life easier and agile!
      <br>Down there, you can join the community and improve your work!</br>
    </p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
      <button type="button" onClick="location.href='/'"class="btn btn-primary">Login</button>
    </br>
    </br>
    </br>
    </br>
    </br>
      @if (isset($error))  <div class="alert alert-warning">
          <strong>Warning!</strong><a href="#" class="alert-link">{{$error}}</a>.
        </div>@endif
    </div>
    </div>
    </div>
    <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
    </br>
      <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
  </nav>
</body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
