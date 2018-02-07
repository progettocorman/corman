
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User userlogindone</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="css/logged.css" type="text/css" />
</head>
<style>
table {
  box-shadow: 10px 10px 5px #dedede;
  border-collapse: separate;
  margin-left:auto;
  margin-right:auto;
  margin-top: 5%;
  border: 0px;
}
</style>


  <body>
  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
    <button class="btn btn-primary" onClick="location.href='post'">Crea Post</button></br></br>
    <button class="btn btn-primary" onClick="location.href='pubblicazione'">Crea Pubblicazione</button></br></br>
      @include('group_bar')

    </div>
    <div class="col-sm-8 text-left">

      <table width="50%" border="0">
      <tr>
        <td>
            <p>Nome e cognome del seguito </p>
        </td>
        <td>
          <div class="btn-group">
           <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
           <span class="caret"></span>
          </button>
         <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Pubblico</a><br/>
          <a class="dropdown-item" href="#">Solo amici</a><br/>
          <a class="dropdown-item" href="#">Privato</a><br/>
         </div>
        </div>
        </td>
        </tr>
          <tr>
        <td>
        <p>Data</p>
        </td>
      </tr>
      <tr>
    <td>
    <p>Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui Qui ci sarà il post del ricercatore che segui v Qui ci sarà il post del ricercatore che segui</p>
    </td>
  </tr>
  <tr>
<td>
<textarea class="form-control" rows="5" id="comment"> Commenta...</textarea>
</td>
</tr>
      </table>

    </table>
      <table width="50%" border="0">
      <tr>
        <td>
            <p>Name Surname</p>
        </td>
        <td>
          <div class="btn-group">
           <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
           <span class="caret"></span>
          </button>
         <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Pubblico</a><br/>
          <a class="dropdown-item" href="#">Solo amici</a><br/>
          <a class="dropdown-item" href="#">Privato</a><br/>
         </div>
        </div>
        </td>
        </tr>
          <tr>
        <td>
        <p>Data</p>
        </td>
      </tr>
      <tr>
    <td>
    <p>Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore Qui ci sara il post del ricercatore</p>
    </td>
  </tr>
  <tr>
  <td>
  <textarea class="form-control" rows="5" id="comment"> Commenta...</textarea>
  </td>
  </tr>
  </table>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        @include('profile_bar')
        <button type="button" onClick="location.href='userprofile'">profile</button>
      </div>
    </div>
  </div>
  </div>

  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
