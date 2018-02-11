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

     
    </div>
   </div>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        @include('profile_bar')
        <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">Profile</button>
      </div>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    <p>@Copyright Team Corman</p>
    </div>
  </div>
  </div>
 </body>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</html>
