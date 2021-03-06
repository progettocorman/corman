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

<script>
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
                    $('#blah2')
                    .attr('src', e.target.result);
                    };
          reader.readAsDataURL(input.files[0]);
          }
      }
</script>

  <body>
    @include('navbar')
    <div class="container-fluid text-center">
      <div class="row content">
        <div class="col-sm-2 sidenav">
          <button class="btn btn-primary" onClick="location.href='post'">New Post</button></br></br>
          <button class="btn btn-primary" onClick="location.href='pubblicazione'"><font size="1px"> New Publication</font></button></br></br>
          @include('group_bar')

        </div>
        <div class="col-sm-8 text-left">
          @if (isset($error))<div class="alert alert-warning">
            <strong>Warning!</strong><a href="#" class="alert-link">{{$error}}</a>.
          </div>@endif
          <form method="POST" action='modify_user_settings'>
          {{csrf_field()}}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <table class="tables" width="100%" border="0">
          <tr>
            <td>
              <label >Name*</label>
            </td>
            <td>
              <label >Surname*</label>
            </td>
            <td>
               <p><label>Gender</label></P>
            </td>
          </tr>

         <tr>
           <td>
              <input type="text" class="form-control" name="user_name" value= {{$name}} required>
           </td>
           <td>
              <input type="text" class="form-control" name="user_lastname" value= {{$last_name}} required >
           </td>
            <td>
              <input type="radio" name="gender[]"  value='M' checked> Male<br>
              <input type="radio" name="gender[]" value='F'> Female<br>
            </td>
         </tr>

          <tr>
            <td>
               <label >Second Name</label>
            </td>
            <td>
                <label >Date*</label>
            </td>
          </tr>

          <tr>
            <td>
              <input type="text" class="form-control" name="second_name" value= {{$second_name}}>
            </td>
            <td>
              <input type="date" class="form-control" max ="1993-12-31" min = "1908-01-01" name="user_date" value = "{{ $birth_date }}" required>
            </td>

          </tr>

          <tr>
            <td>
              <label >Affiliation*</label>
            </td>
            <td>
               <label for="exampleFormControlSelect1">Lines of research</label>
            </td>
          </tr>

          <tr>
            <td>
              <input type="text" class="form-control" name="user_affiliation" value= {{$affiliation}} required>
            </td>
            <td>
              <select class="form-control" name="user_research" value= {{$research}} required>
                <option>Artificial Intelligence</option>
                <option>Security</option>
                <option>Semantic web</option>
                <option>Interaction Paradigms</option>
                <option>Others</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <label>Email address*</label>
           </td>
          </tr>

          <tr>
            <td>
              <input type="email" class="form-control" name="user_email" aria-describedby="emailHelp" value = {{$email}}>
            </td>
          </tr>

           <tr>
           </tr>

             <tr>
              <td>
                <button type="submit" class="btn btn-primary">Modify</button>
              </td>
             </tr>
      </table>
          </form>
        </br></br>
            <form method="POST"action='update_image_profile'  enctype="multipart/form-data">
              {{ csrf_field() }}
              <table>
                <tr>
                  <td>
                    <label> Update Image</label>
                  </td>
                  <td>
                  <label>Load Publications from dblp</label>
                  </td>
                </tr>
                <tr>
              <td> <input type="file"  onchange="readURL(this);" name="user_image" multiple>
                <img id="blah2" src="http://placehold.it/180" alt="your image" width=100 height=50  name="image_profile" />
                <button type="submit" class="btn btn-primary">Load</button>
              </td>
              <td>
                  <a href='apiCall' type="submit" class="btn btn-primary">dblp Api</a>
              </td>
              <tr>
              </table>
              </form>

              </br></br></br>




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

  <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
  </br>
    <p>@Copyright Team Corman || Contact us: progettocorman@gmail.com</p>
</nav>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
  </html>
