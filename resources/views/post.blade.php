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
      @include('group_bar')
  </div>
      <div class="col-sm-8 text-left">
        <form method='post' action='publicPost' >
          {{ csrf_field() }}
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
                <label >Tag </label>
              </td>
            </tr>
            <tr>
              <td>
                <textarea class="form-control" rows="5" id="comment">Scrivi tag</textarea>
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
      </form>
      </div>
      <div class="col-sm-2 sidenav">
        <div class="well">
        <p><img src="/corman/storage/app/{{$user_image}}" style="width:48px;height:48px;"></p>
          <p>{{$name}}</p>
          <p>{{$last_name}}</p>
          <p>{{$affiliation}}</p>
            <button type="button" onClick="location.href='userprofile'">Profilo Utente</button>
        </div>

      </div>
    </div>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </html>
