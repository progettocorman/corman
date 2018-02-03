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
                    $('#blah')
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
          <p><a href="#">Lista dei gruppi a cui ti sei iscritto</a></p>
          <p><a href="#">-</a></p>
          <p><a href="#">-</a></p>
          <p><a href="#">-</a></p>
          <p><a href="#">-</a></p>
          <p><a href="#">-</a></p>
          <p><a href="#">...</a></p>
            <a href='group'>L'universo</a>
            <p><a href="#">-</a></p>
            <p><a href="#">-</a></p>
            <p><a href="#">...</a></p>
            <button type="button" onClick="location.href='post'">crea post</button>
        </div>
        <div class="col-sm-8 text-left">
          <form method="POST" action='modify_user_settings'>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <table width="100%" border="0">
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
               <label for="exampleFormControlSelect1">Linee di ricerca</label>
            </td>
          </tr>

          <tr>
            <td>
              <input type="text" class="form-control" name="user_affiliation" value= {{$affiliation}} required>
            </td>
            <td>
              <select class="form-control" name="user_research" value= {{$research}} required>
                <option>Artificial Intelligent</option>
                <option>Security</option>
                <option>Semantic web</option>
                <option>Other</option>
                <option>Other two</option>
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
               <input type='file' onchange="readURL(this);" name = "user_image"/>
             </td>
            </tr>

            <tr>
             <td>
                <img id="blah" src="http://placehold.it/180" alt="your image" />
             </td>
            </tr>

             <tr>
              <td>
                <button type="submit" class="btn btn-primary">modify</button>
              </td>
             </tr>
      </table>
          </form>
        </div>
        <div class="col-sm-2 sidenav">
          <div class="well">
            <p>Qui sara presente il tuo profilo</p>
            <p>Nome e cognome</p>
            <p>Età e sesso</p>
            <p>ecc</p>
            <button type="button" onClick="location.href='userprofile'">vai al profilo utente</button>
          </div>

        </div>
      </div>
      </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
  </html>
