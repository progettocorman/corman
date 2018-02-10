<!DOCTYPE html>
<html lang="en">

  @include('bootstrap')

<body>
  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      @include('group_bar')
    </div>
    <div class="col-sm-8 text-left">
      @include('information_group')
      <link rel="stylesheet" href="css/navbar_profile.css" type="text/css" />

      <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <div class="collapse navbar-collapse" id="navbarNav">
          <div  id="profilenavbar" class="navbar-nav">
              <a class="oneprofilenavbar"  href='tot_pubblicazioni'> Pubblicazioni </a>
              <a class="oneprofilenavbar" href='tot_post'> Post </a>
          </div>
        </div>
      </nav>

        <div class="riga">
          <hr>
          <h3></h3>
          <p></p>
          <p></p>
          <p></p>
          <p></p>
        </div>


      <table class="tables" width="50%" border="0">
      <tr>
        <td>
            <p>Name e cognome utente del gruppo</p>
        </td>
        </tr>
          <tr>
        <td>
        <p>Data</p>
        </td>
      </tr>
      <tr>
    <td>
    <p>Qui ci sarà la ricerca del partecipante al gruppo Qui ci sarà la ricerca del partecipante al gruppo v Qui ci sarà la ricerca del partecipante al gruppo Qui ci sarà la ricerca del partecipante al gruppo Qui ci sarà la ricerca del partecipante al gruppo Qui ci sarà la ricerca del partecipante al gruppo Qui ci sarà la ricerca del partecipante al gruppo</p>
    </td>
  </tr>
  <tr>
<td>
<input class="Commenti" placeholder="Commenta" id="comment">
</td>
</tr>
      </table>

      <table class="tables" width="50%" border="0">
      <tr>
        <td>
            <p>Name e cognome utente del gruppo</p>
        </td>
        </tr>
          <tr>
        <td>
        <p>Data</p>
        </td>
      </tr>
      <tr>
    <td>
    <p>Qui ci sarà la ricerca del partecipante al gruppo Qui ci sarà la ricerca del partecipante al gruppo v Qui ci sarà la ricerca del partecipante al gruppo Qui ci sarà la ricerca del partecipante al gruppo Qui ci sarà la ricerca del partecipante al gruppo Qui ci sarà la ricerca del partecipante al gruppo Qui ci sarà la ricerca del partecipante al gruppo</p>
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
        <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">Profile</button>
      </div>

    </div>
  </div>
  </div>
 </body>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</html>
