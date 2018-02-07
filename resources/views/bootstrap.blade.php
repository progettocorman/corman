<head>
  <meta charset="utf-8">
  <title>Corman</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/post.css" type="text/css" />
  <!-Librerie tag->
  <link rel="stylesheet" href="/dist/bootstrap-tagsinput.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
  <script src="/dist/bootstrap-tagsinput.min.js"></script>
  <script src="/dist/bootstrap-tagsinput/bootstrap-tagsinput-angular.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.js"></script>
  <script src="/assets/app.js"></script>
  <script src="/assets/app_bs3.js"></script>
  <?php $id = session('id'); ?>
</head>

<?php
    $mioid = session('id');
    if($mioid==""){
      return redirect('welcome.blade.php');
    }
 ?>
