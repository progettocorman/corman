<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Post</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/post.css" type="text/css" />
  </head>

<body>
  @include('navbar')
  <div class="container-fluid text-center">
  <div class="row content">
  <div class="col-sm-2 sidenav">
        <p><a href="#">Lista dei gruppi a cui ti sei iscritto</a></p>
        <p><a href="#">-</a></p>
        <p><a href="#">-</a></p>
        <p><a href="#">-</a></p>
        <p><a href="#">-</a></p>
        <p><a href="#">-</a></p>
        <p><a href="#">...</a></p>
          <a href='group'>L'universo</a>
  </div>
      <div class="col-sm-8 text-left">
        <table width="100%" border="0">
            <tr>
              <td>
                <label >Inserisci il tuo post </label>
              </td>
            </tr>
            <tr>
              <td>
                <textarea name="testo" style="width: 100%; height: 100px;"></textarea>
              </td>
            </tr>
            <tr>
              <td>
                <input type="file" name="fileUpload1" multiple>
              </td>
            </tr>
             <tr>
              <td>
                <button type="submit" class="btn btn-primary">Pubblica</button>
              </td>
             </tr>
        </table>

      </div>
      <div class="col-sm-2 sidenav">
        <div class="well">
          <p>Qui sara presente il tuo profilo</p>
          <p>Nome e cognome</p>
          <p>Età e sesso</p>
          <p>ecc</p>
            <button type="button" onClick="location.href='userprofile'">Profilo Utente</button>
        </div>

      </div>
    </div>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </html>
