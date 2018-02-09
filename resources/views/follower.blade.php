<html>
    <head>
        <title>Follower </title>
    </head>
    <body>
      <h2 class="subheader">Follower</h2>
        @foreach($followers as $follower)
        <p>{{$follower->getFullName()}}</p>
        @endforeach
    <body>
</html>
