<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User settings</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/settingaccount.css" type="text/css" />
</head>

<body>
  @include('navbar')
  <div class="container-fluid text-center">
    <div class="row content">
      <div class="col-sm-2 sidenav">
        <button class="btn btn-primary" onClick="location.href='post'">Crea Post</button></br></br>
        <button class="btn btn-primary" onClick="location.href='pubblicazione'">Crea Pubblicazione</button></br></br>
        @include('group_bar')

      </div>
      <div class="col-sm-8 text-left">
        <form method="POST" action='modify_user_settings'>
        {{csrf_field()}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <table class="tables" width="100%" border="0">
        <tr>
          <td>
            <label >Name*</label>
          </td>
          <td>
            <label >Visibilità</label>
          </td>
        </tr>

       <tr>
         <td>
            <input type="text" class="form-control" name="group_name" >
         </td>
         <td>
           <input type="radio" name="gender[]"  value='M' checked> Pubblico<br>
           <input type="radio" name="gender[]" value='F'> Privato<br>
          </td>
       </tr>

        <tr>
          <td>
            <label>Descrizione</label>
         </td>
        </tr>

        <tr>
          <td>
            <input type="email" class="form-control" name="description" aria-describedby="description">
          </td>
        </tr>

         <tr>
         </tr>

           <tr>
            <td>
              <button type="submit" class="btn btn-primary">Crea</button>
            </td>
           </tr>
    </table>

        </form>
        <br>
        <td>
          <form method="POST"action='update_image_profile'  enctype="multipart/form-data">
            {{ csrf_field() }}
             <input type="file"  onchange="readURL(this);" name="user_image" multiple>
              <img id="blah2" src="http://placehold.it/180" alt="your image" width=100 height=50  name="image_group" />
              <button type="submit" class="btn btn-primary">Load</button>
            </form>
          </td>
      </div>
      <div class="col-sm-2 sidenav">
        <div class="well">
          @include('profile_bar')
          <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">Profile</button>
        </div>

      </div>
    </div>
    </div>

   </div>

</div>



</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
