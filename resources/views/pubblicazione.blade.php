<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Pubblicazione</title>
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
        @include('group_bar')
  </div>

      <div class="col-sm-8 text-left">
        <!----------------------------------------FORM ----------------------------------->
        <form action="addPublication" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
        <table width="100%" border="0">
            <tr>
              <td>
                <label >Titolo</label>
              </td>
              <td>
                <label >Rivista</label>
              </td>
            </tr>

           <tr>
             <td>
                <input type="text" class="form-control" name="title" required>
             </td>
             <td>
                <input type="text" class="form-control" name="venue" required >
             </td>
           </tr>

            <tr>
              <td>
                 <label >Volume</label>
              </td>
              <td>
                  <label >Numero</label>
              </td>
            </tr>

            <tr>
              <td>
                <input type="text" class="form-control" name="volume">
              </td>
              <td>
                <input type="text" class="form-control" name="number">

              </td>
            </tr>

            <tr>
              <td>
                <label>Pagine</label>
              </td>
              <td>
                 <label>Anno di pubblicazione</label>
              </td>
            </tr>

            <tr>
              <td>
                <input type="text" class="form-control" name="pages"required>
              </td>
              <td>
                <input type="text" class="form-control" name="year" required>
              </td>
            </tr>


              <tr>
                <td>
                  <label>Tipologia</label>
                </td>
                <td>
                  <label>Tag</label>
                </td>
              </tr>

              <tr>
                <td>
                  <input type="text" class="form-control" name="type"required>
                </td>
                <td>
                    <textarea class="form-control" name="publications_tags" rows="5" id="comment">Scrivi tag</textarea>
                </td>
              </tr>
            <tr>
              <td>
                <label>Allegati</label>
             </td>
            </tr>

            <tr>
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
        </form>

        <!----------------------------------------FORM ----------------------------------->
      </div>
      <div class="col-sm-2 sidenav">
        <div class="well">
           @include('profile_bar')
            <button type="button" onClick="location.href='userprofile'">Profilo Utente</button>
        </div>

      </div>
    </div>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </html>
