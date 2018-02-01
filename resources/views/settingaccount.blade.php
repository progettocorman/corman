
<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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


<style>

form {
  margin:30px;
  margin-top: 8px;
  margin-left: 40px;
  margin-right: 40px;
  }


  header{
    padding: 1em;
    color: blue;
    background-color:white;
    clear: left;
    text-align: left;
    }

    img{
  max-width:180px;
    }

input[type=file]{
padding:10px;
background:#2d2d2d;
}

</style>


<title>User settings</title>

  <head>
    <meta charset="utf-8">
    <header>
      <p>user settings<p>
    </header>
  </head>


<body>

<form method="POST" action='modify_user_settings'>
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label >Name*</label>
    <input type="text" class="form-control" name="user_name" value= {{$name}} required>
  </div>

  <div class="form-group">
    <label >Second Name</label>
    <input type="text" class="form-control" name="second_name" value= {{$second_name}}>
  </div>

  <div class="form-group">
    <label >Surname*</label>
    <input type="text" class="form-control" name="user_lastname" value= {{$last_name}} required >
  </div>
  
  <div class="form-group">
    <label >Date*</label>
    <input type="date" class="form-control" max ="1993-12-31" min = "1908-01-01" name="user_date" value = "{{ $birth_date }}" required>
  </div>

  <div class="custom-control custom-radio">
    <fieldset>
   <p><label>Gender</label></P>
   <input type="radio" name="gender[]"  value='M' checked> Male<br>
   <input type="radio" name="gender[]" value='F'> Female<br>
  </fieldset>
</div>




  <div class="form-group">
    <label >Affiliation*</label>
    <input type="text" class="form-control" name="user_affiliation" value= {{$affiliation}} required>
  </div>

<div class="form-group">
    <label for="exampleFormControlSelect1">Linee di ricerca</label>
    <select class="form-control" name="user_research" value= {{$research}} required>
      <option>Artificial Intelligent</option>
      <option>Security</option>
      <option>Semantic web</option>
      <option>Other</option>
      <option>Other two</option>
    </select>
  </div>
  <div class="form-group">
    <label>Email address*</label>
    <input type="email" class="form-control" name="user_email" aria-describedby="emailHelp" value = {{$email}}>


    <div class = "form-grup">
    <input type='file' onchange="readURL(this);" name = "user_image"/>
    <img id="blah" src="http://placehold.it/180" alt="your image" />
  </div>

  <div calss = "form grup"><button type="submit" class="btn btn-primary">modify</button></div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
