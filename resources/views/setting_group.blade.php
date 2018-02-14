<?php
  $group = \DB::table('groups')->where('id',$_GET['group_id'])->first();
  $group_id = $_GET['group_id'];
  $groupName =$group->group_name;
  $groupDescription =$group->group_description;
  $visibility = $group->group_public;
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
        <button class="btn btn-primary" onClick="location.href='post'">New Post</button></br></br>
        <button class="btn btn-primary" onClick="location.href='pubblicazione'">New Publication</button></br></br>
        @include('group_bar')

      </div>
      <div class="col-sm-8 text-left">
        <form method="POST" name ="setting_form" action="modifyGroup">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <table class="tables" width="100%" border="0">
          <input type="hidden" class="form-control" name="groupid" value="{{$group_id}}" required>
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
            <input type="text" class="form-control" name = "group_name" value = {{$groupName}} required >
         </td>
         <td>
          @if($visibility == 1)<input type="radio" name="visibility[]"  value='1' checked> Public<br>
           <input type="radio" name="visibility[]" value='0'> Private<br>
           @else <input type="radio" name="visibility[]"  value='1' > Public<br>
            <input type="radio" name="visibility[]" value='0' checked> Private<br> @endif
          </td>
       </tr>

        <tr>
          <td>
            <label>Description</label>
         </td>
        </tr>

        <tr>
          <td>
            <input type="text" class="form-control" name="description" value={{$groupDescription}}>
          </td>
        </tr>

         <tr>
         </tr>

           <tr>
            <td>

              <button class="btn btn-primary" type="submit" >Modify</button>

            </td>
           </tr>
    </table>

        </form>
        <br>
    <table>
      <tr>
        <td><label>Update image</label></td>
        <td><label>Delete group</label></td>
      </tr>
      <tr>
        <td>
          <form method="POST" action='update_group_profile' enctype="multipart/form-data">
            {{ csrf_field() }}
             <input type="file"  onchange="readURL(this);" name="group_image" multiple>
             <input type="hidden" name="g_Id" value="{{$group_id}}" required>
              <img id="blah2" src="http://placehold.it/180" alt="your image" width=100 height=50  name="image_group" />
              <button type="submit" class="btn btn-primary">Load</button>
            </form>
          </td>
          <td>
            <a href="delete_group?group_id={{$group_id}}" class="btn btn-primary">Delete group</button>
          </td>
        </tr>
    </table>
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
