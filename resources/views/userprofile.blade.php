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
