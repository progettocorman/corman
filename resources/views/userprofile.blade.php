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
  <div>


    </div>
      <div class="col-sm-8 text-left">
      @include('information_profile')
       @include('navbar_profile')

        <table class="tables" width="50%" border="0">
        <tr>
          <td>
              <p>Nome e cognome utente</p>
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
      <p>Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente</p>
      </td>
    </tr>
    <tr>
  <td>
  <input class="Commenti" placeholder="Commenta" id="comment">
  </td>
  </tr>
        </table>

      </table>
        <table class="tables" width="50%" border="0">
        <tr>
          <td>
              <p>Nome e cognome utente</p>
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
      <p>Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente Qui ci sarà la ricerca pubbicata dall utente</p>
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
        <button class="btn btn-primary" onClick="location.href='post'">Crea Post</button></br></br>
        <button class="btn btn-primary" onClick="location.href='pubblicazione'">Crea Pubblicazione</button></br></br>
        <div class="well">
        
        </div>

      </div>
    </div>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
   </html>
