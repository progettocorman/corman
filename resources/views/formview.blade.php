<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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
  p{
    font-size:42px
    }

</style>
<title>Form</title>

  <head>
    <meta charset="utf-8">
    <header>
      <p>Sign in<p>
    </header>
  </head>


<body>

<form method="POST" action='insert_form'>
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label >Name*</label>
    <input type="text" class="form-control" name="user_name" placeholder="name" required>
  </div>

  <div class="form-group">
    <label >Second Name</label>
    <input type="text" class="form-control" name="second_name" placeholder="name">
  </div>

  <div class="form-group">
    <label >Surname*</label>
    <input type="text" class="form-control" name="user_lastname" placeholder="cognome" required>
  </div>

  <div class="form-group">
    <label >Date</label>
    <input type="date" class="form-control" name="user_date">
  </div>

  <div class="form-group">
    <label >Affiliation*</label>
    <input type="text" class="form-control" name="user_affiliation" placeholder="affiliation" required>
  </div>

<div class="form-group">
    <label for="exampleFormControlSelect1">Linee di ricerca</label>
    <select class="form-control" name="user_research" placeholder="Research">
      <option>Artificial Intelligent</option>
      <option>Security</option>
      <option>Semantic web</option>
      <option>Other</option>
      <option>Other two</option>
    </select>
  </div>
  <div class="form-group">
    <label>Email address*</label>
    <input type="email" class="form-control" name="user_email" aria-describedby="emailHelp" placeholder="Enter email">
   
  </div>
  <div class="form-group">
    <label>Password*</label>
    <input type="password" class="form-control" name="user_password"  aria-describedby="emailHelp" placeholder="Password" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>