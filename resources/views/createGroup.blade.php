<?php



 ?>


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
        <form method="POST" name ="group_form" action="create_Group">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <table class="tables" width="100%" border="0">

        <tr>
          <td>
            <label >Name*</label>
          </td>
          <td>
            <label >Visibility</label>
          </td>
        </tr>

       <tr>
         <td>
            <input type="text" class="form-control" name = "group_name" placeholder="Group Name" required >
         </td>
         <td>
        <input type="radio" name="visibility[]"  value='1' checked> Public<br>
           <input type="radio" name="visibility[]" value='0'> Private<br>
          </td>
       </tr>

        <tr>
          <td>
            <label>Description</label>
         </td>
        </tr>

        <tr>
          <td>
            <input type="text" class="form-control" name="description" placeholder="Group Description">
          </td>
        </tr>

         <tr>
         </tr>

           <tr>
            <td>

              <button class="btn btn-primary" type="submit" >Create</button>

            </td>
           </tr>
    </table>

        </form>
        <br>
        <td>
          </td>
      </div>
      <div class="col-sm-2 sidenav">
        <div class="well">
          @include('profile_bar')
          <button class="btn btn-primary" onClick="location.href='userprofile?id={{session('id')}}'">Profile</button>
        </div>
        <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
        </br>
          <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
      </nav>
      </div>
    </div>
    </div>

   </div>

</div>



</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
