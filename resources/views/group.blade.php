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
      @include('navbar_group')
       <link rel="stylesheet" href="css/navbar_profile.css" type="text/css" />
        <div class="riga">
          <hr>
          <h3></h3>
          <p></p>
          <p></p>
          <p></p>
          <p></p>
        </div>
        <div class="box">
          <div class="box-inner">

<<<<<<< HEAD
     
=======
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

      </table>
>>>>>>> bd1b234e037c49ccdb534b0ab51f43ad5873e3f2
    </div>
   </div>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        @include('profile_bar')
        <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">Profile</button>
      </div>

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
