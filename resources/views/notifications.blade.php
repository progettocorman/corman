
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User userlogindone</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="css/notifications.css" type="text/css" />
 </head>

  <body>
  @include('navbar')
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      @include('group_bar')

      <button class="btn btn-primary" onClick="location.href='post'">Crea Post</button></br></br>
      <button class="btn btn-primary" onClick="location.href='pubblicazione'">Crea Pubblicazione</button></br></br>
    </div>
    <div class="col-sm-8 text-left">

      <table class="tables" width="50%" border="2">
      <tr>
        <td>
          <p> Nicola vuole seguirti </p>
        </td>

        <td>
          <td>
            <button class="pushA" type=”submit”>  Accetta </button>
          </td>
          <td>
            <button class="pushR" type=”submit”>  Rifiuta </button>
          </td>
        </td>
        </tr>

        <tr>
          <td>
            <p> Antonio vuole seguirti </p>
          </td>

          <td>
            <td>
              <button class="pushA" type=”submit”>  Accetta </button>
            </td>
            <td>
              <button class="pushR" type=”submit”>  Rifiuta </button>
            </td>
          </td>
          </tr>

          <tr>
            <td>
              <p> Riccardo vuole seguirti </p>
            </td>

            <td>
              <td>
                <button class="pushA" type=”submit”>  Accetta </button>
              </td>
              <td>
                <button class="pushR" type=”submit”>  Rifiuta </button>
              </td>
            </td>
            </tr>

            <tr>
              <td>
                <p> Giovanni vuole seguirti </p>
              </td>

              <td>
                <td>
                  <button class="pushA" type=”submit”>  Accetta </button>
                </td>
                <td>
                  <button class="pushR" type=”submit”>  Rifiuta </button>
                </td>
              </td>
              </tr>

              <tr>
                <td>
                  <p> Enrico vuole seguirti </p>
                </td>

                <td>
                  <td>
                    <button class="pushA" type=”submit”>  Accetta </button>
                  </td>
                  <td>
                    <button class="pushR" type=”submit”>  Rifiuta </button>
                  </td>
                </td>
                </tr>
      </table>

      <table class="tables" width="50%" border="2">
      <tr>
        <td>
          <p> Christian vuole seguirti </p>
        </td>

        <td>
          <td>
            <button class="pushA" type=”submit”>  Accetta </button>
          </td>
          <td>
            <button class="pushR" type=”submit”>  Rifiuta </button>
          </td>
        </td>
        </tr>

        <tr>
          <td>
            <p> Nicola vuole seguirti </p>
          </td>

          <td>
            <td>
              <button class="pushA" type=”submit”>  Accetta </button>
            </td>
            <td>
              <button class="pushR" type=”submit”>  Rifiuta </button>
            </td>
          </td>
          </tr>

          <tr>
            <td>
              <p> Giovanni vuole seguirti </p>
            </td>

            <td>
              <td>
                <button class="pushA" type=”submit”>  Accetta </button>
              </td>
              <td>
                <button class="pushR" type=”submit”>  Rifiuta </button>
              </td>
            </td>
            </tr>

            <tr>
              <td>
                <p> Enrico vuole seguirti </p>
              </td>

              <td>
                <td>
                  <button class="pushA" type=”submit”>  Accetta </button>
                </td>
                <td>
                  <button class="pushR" type=”submit”>  Rifiuta </button>
                </td>
              </td>
              </tr>

              <tr>
                <td>
                  <p> Antonio vuole seguirti </p>
                </td>

                <td>
                  <td>
                    <button class="pushA" type=”submit”>  Accetta </button>
                  </td>
                  <td>
                    <button class="pushR" type=”submit”>  Rifiuta </button>
                  </td>
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
