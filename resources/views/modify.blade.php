
<!DOCTYPE html>
<html lang="en">
@include('bootstrap')

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

      <table class="tables" width="50%" border="0">
      <tr>
        <td>
            <p>Nome e cognome del seguito </p>
        </td>
        <td>
      </td>
        <td>
          <div class="btn-group">
           <button type="button" class="botn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
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
<input class="Commenti" placeholder="Commenta" id="comment">
</td>
</tr>
      </table>


    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        @include('profile_bar')
        <button class="btn btn-primary" onClick="location.href='userprofile'">profile</button>
      </div>
    </div>
  </div>
  </div>

  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
