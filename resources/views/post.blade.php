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
        <form method='post' action='publicPost' >
          {{ csrf_field() }}
        <table class="tables" width="100%" border="0">
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
              <input type="text" placeholder="Inserisci il tag"  name ="tags" data-role="tagsinput" />
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
        @include('profile_bar')
            <button type="button" onClick="location.href='userprofile'">Profilo Utente</button>
        </div>

      </div>
    </div>
    </div>
   </body>
  </html>
