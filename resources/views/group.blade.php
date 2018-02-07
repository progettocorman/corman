<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
  <title>User Group</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="css/logged.css" type="text/css" />
</head>
<body>
  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      @include('group_bar')
    </div>
    <div class="col-sm-8 text-left">
      <table width="50%" border="1">
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

    </table>
      <table width="50%" border="1">
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
        <button type="button" onClick="location.href='userprofile'">vai al profilo utente</button>
      </div>

    </div>
  </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
