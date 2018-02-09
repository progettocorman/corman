<html>
    <head>
        <title>Follow </title>
    </head>
    <body>
      <h2 class="subheader">Follow</h2>
      @foreach($follows as $follow)
      <p> {{$follow->getFullName()}}</p>
      @endforeach
    <body>
</html>
